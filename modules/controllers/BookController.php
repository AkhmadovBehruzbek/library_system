<?php

namespace app\modules\controllers;

use app\models\Book;
use app\models\BookAuthor;
use app\models\BookFile;
use app\models\BookSearch;
use Yii;
use yii\base\Exception;
use yii\helpers\FileHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\web\UploadedFile;

/**
 * BookController implements the CRUD actions for Book model.
 */
class BookController extends RoleController
{
    /**
     * @inheritDoc
     */
    public function behaviors(): array
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Book models.
     *
     * @return string
     */
    public function actionIndex(): string
    {
        $searchModel = new BookSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Book model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView(int $id): string
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Book model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|Response
     * @throws Exception
     */
    public function actionCreate()
    {
        $model = new Book();
        $book_file = new BookFile();
        $book_author = new BookAuthor();

        if ($this->request->isPost) {
            $model->load($this->request->post());
            $book_file->load($this->request->post());
            $book_author->load($this->request->post());

            $pdf_file = UploadedFile::getInstance($book_file, 'file_name');
            $image_file = UploadedFile::getInstance($model, 'image');
            $pdf_path = 'document/' . date('Y-m') . '/';
            $file_path = $this->filePath($pdf_path);
            $image_path = $this->filePath('images/book/');

            /** files uploads start */
            if ($image_file !== null) {
                $image_name = $this->randomFileName($image_file);

                if (!is_dir($image_path)) {
                    FileHelper::createDirectory($image_path);
                }
                $image_file->saveAs($image_path . $image_name);
            }

            if ($pdf_file !== null) {
                $file_name = $this->randomFileName($pdf_file);

                if (!is_dir($file_path)) {
                    FileHelper::createDirectory($file_path);
                }
                $pdf_file->saveAs($file_path . $file_name);
            }

            $transaction = \Yii::$app->db->beginTransaction();
            try {
                /** db start */
                $model->status = Book::STATUS_ACTIVE;
                $model->image = $image_name;

                if (!$model->save()) {
                    throw new NotFoundHttpException($model->errors);
                }

                foreach (explode(',', $book_author->full_name) as $author) {
                    $new_author = new BookAuthor();
                    $new_author->book_id = $model->id;
                    $new_author->full_name = $author;
                    $new_author->save();
                }

                $book_file->book_id = $model->id;
                $book_file->file_name = $file_name;
                $book_file->file_path = $pdf_path;
                $book_file->file_size = $pdf_file->size;
                if (!$book_file->save()) {
                    throw new NotFoundHttpException($book_file->errors);
                }

                \Yii::$app->session->setFlash('success', 'Kitob qo\'shildi');
                $transaction->commit();
                return $this->redirect('index');

            } catch (\Exception $e) {
                \Yii::$app->session->setFlash('error', $e->getMessage());
                $transaction->rollBack();
                return $this->redirect('index');
            }
        } else {
            $model->loadDefaultValues();
        }
        return $this->render('create', [
            'model' => $model,
            'book_file' => $book_file,
            'book_author' => $book_author,
            'category_list' => $this->findCategoryList()
        ]);
    }

    /**
     * Updates an existing Book model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|Response
     * @throws NotFoundHttpException if the model cannot be found
     * @throws Exception
     */
    public function actionUpdate(int $id)
    {

        $model = $this->findModel($id);
        $book_author = BookAuthor::findOne(['book_id' => $model->id]);
        $book_authors = BookAuthor::find()->asArray()->where(['book_id' => $model->id])->all();
        $string_author = '';
        foreach ($book_authors as $author) {
            $string_author .= $author['full_name'] . ',';
        }
        $book_author->full_name = $string_author;
        $book_file = BookFile::findOne(['book_id' => $model->id]);
        $old_file_name = $book_file->file_name;
        $old_file_size = $book_file->file_size;
        $old_file_path = $book_file->file_path;
        $old_image_name = $model->image;

        if ($this->request->isPost) {
            $model->load($this->request->post());
            $book_file->load($this->request->post());
            $book_author->load($this->request->post());

            $pdf_file = UploadedFile::getInstance($book_file, 'file_name');
            $image_file = UploadedFile::getInstance($model, 'image');
            $pdf_path = 'document/' . date('Y-m') . '/';
            $file_path = $this->filePath($pdf_path);
            $image_path = $this->filePath('images/book/');
            $model->image = $old_image_name;
            $book_file->file_name = $old_file_name;
            $book_file->file_path = $old_file_path;
            $book_file->file_size = $old_file_size;


            /** files uploads start */
            if ($image_file !== null) {
                $image_name = $this->randomFileName($image_file);

                if (!is_dir($image_path)) {
                    FileHelper::createDirectory($image_path);
                }
                $image_file->saveAs($image_path . $image_name);
                $model->image = $image_name;
            }

            if ($pdf_file !== null) {
                $file_name = $this->randomFileName($pdf_file);

                if (!is_dir($file_path)) {
                    FileHelper::createDirectory($file_path);
                }
                $pdf_file->saveAs($file_path . $file_name);
                $book_file->file_name = $file_name;
                $book_file->file_path = $pdf_path;
                $book_file->file_size = $pdf_file->size;
            }

            $transaction = \Yii::$app->db->beginTransaction();
            try {
                /** db start */
                $model->status = Book::STATUS_ACTIVE;

                if (!$model->save()) {
                    throw new NotFoundHttpException($model->errors);
                }
                BookAuthor::deleteAll(['book_id' => $model->id]);
                foreach (explode(',', $book_author->full_name) as $author) {
                    $new_author = new BookAuthor();
                    $new_author->book_id = $model->id;
                    $new_author->full_name = $author;
                    $new_author->save();
                }

                $book_file->book_id = $model->id;
                if (!$book_file->save()) {
                    throw new NotFoundHttpException($book_file->errors);
                }

                \Yii::$app->session->setFlash('success', 'Kitob ma\'lumotlari o\'zgartirildi');
                $transaction->commit();
                return $this->redirect('index');

            } catch (\Exception $e) {
                \Yii::$app->session->setFlash('error', $e->getMessage());
                $transaction->rollBack();
                return $this->redirect('index');
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('update', [
            'model' => $model,
            'book_author' => $book_author,
            'book_file' => $book_file,
            'category_list' => $this->findCategoryList()
        ]);
    }

    /**
     * Deletes an existing Book model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete(int $id): Response
    {
        $model = $this->findModel($id);
        $model->status = $model->status === Book::STATUS_ACTIVE ? Book::STATUS_INACTIVE : Book::STATUS_ACTIVE;
        if ($model->save()) {
            $alert_message = $model->status === Book::STATUS_INACTIVE ? 'Kitob o\'chirildi' : 'Kitob qayta tiklandi';
            Yii::$app->session->setFlash('success', $alert_message);
        }
        return $this->redirect(['index']);
    }

    /**
     * Finds the Book model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Book the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel(int $id): Book
    {
        if (($model = Book::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function findCategoryList(): array
    {
        $categories = \app\models\Category::find()->where('status = :status', [
            ':status' => true
        ])->all();
        return \yii\helpers\ArrayHelper::map($categories, 'id', 'title');
    }

    public function filePath($file_path): string
    {
        $file_root = Yii::getAlias("@app/web/");
        return $file_root . $file_path;
    }

    /**
     * @throws Exception
     */
    public function randomFileName($file): string
    {
        return date('d_m_Y') . '_' . Yii::$app->security->generateRandomString(32) . '.' . $file->extension;
    }
}
