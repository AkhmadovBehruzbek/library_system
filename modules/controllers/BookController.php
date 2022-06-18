<?php

namespace app\modules\controllers;

use app\models\Book;
use app\models\BookAuthor;
use app\models\BookFile;
use app\models\BookSearch;
use phpDocumentor\Reflection\DocBlock\Tags\Author;
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
class BookController extends Controller
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
            $fileRoot = Yii::getAlias("@app/web/");
            $filePath = 'document/' . date('Y-m') . '/';
            $imagePath = 'images/book/';

            if ($pdf_file !== null) {
                $fileName = date('d_m_Y') . '_' . Yii::$app->security->generateRandomString(32) . '.' . $pdf_file->extension;
                if (!is_dir($fileRoot . $filePath)) {
                    FileHelper::createDirectory($fileRoot . $filePath);
                }
                $pdf_file->saveAs($fileRoot . $filePath . $fileName);

                $imageName = date('d_m_Y') . '_' . Yii::$app->security->generateRandomString(32) . '.' . $image_file->extension;
                if (!is_dir($fileRoot . $imagePath)) {
                    FileHelper::createDirectory($fileRoot . $imagePath);
                }
                $image_file->saveAs($fileRoot . $imagePath . $imageName);

                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    $model->status = Book::STATUS_ACTIVE;
                    $model->image = $imageName;
                    if (!$model->save()) {
                        throw new NotFoundHttpException($model->errors);
                    }

                    $book_author->book_id = $model->id;
                    if (!$book_author->save()) {
                        throw new NotFoundHttpException($book_author->errors);
                    }

                    $book_file->book_id = $model->id;
                    $book_file->file_name = $fileName;
                    $book_file->file_path = $filePath;
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
            }
        } else {
            $model->loadDefaultValues();
        }
        return $this->render('create', [
            'model' => $model,
            'book_file' => $book_file,
            'book_author' => $book_author
        ]);
    }

    /**
     * Updates an existing Book model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate(int $id)
    {
        $model = $this->findModel($id);
        $author = BookAuthor::findOne(['book_id' => $model->id]);
        $file = BookFile::findOne(['book_id' => $model->id]);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'book_author' => $author,
            'book_file' => $file
        ]);
    }

    /**
     * Deletes an existing Book model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Book model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Book the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Book::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
