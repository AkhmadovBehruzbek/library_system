<?php

namespace app\controllers;

use app\models\Book;
use app\models\BookAuthor;
use app\models\BookFile;
use app\models\Category;
use Yii;
use yii\data\Pagination;
use yii\db\Exception;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use yii\web\ErrorAction;
use yii\captcha\CaptchaAction;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors(): array
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions(): array
    {
        return [
            'error' => [
                'class' => ErrorAction::class,
            ],
            'captcha' => [
                'class' => CaptchaAction::class,
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     * @throws Exception
     */
    public function actionIndex(): string
    {
        $query = Book::find()
            ->select(['id', 'name', 'image'])
            ->where(['status' => 1])
            ->asArray()
            ->orderBy(['id' => SORT_DESC]);


        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(), 'defaultPageSize' => 15]);
        $books = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        return $this->render('index', [
            'categories' => $this->findCategory(),
            'books' => $books,
            'pages' => $pages,
            'authors' => $this->findAuthor()
        ]);
    }

    /**
     * Displays about page.
     *
     * @param $id
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionBook($id): string
    {
        $book = $this->findBook($id);
        $book_file = BookFile::findOne(['book_id' => $book['id']]);
        $book_author = BookAuthor::findAll(['book_id' => $book['id']]);
        $categories = Category::find()
            ->where(['status' => Category::STATUS_ACTIVE])
            ->asArray()
            ->all();
        $books = Book::find()
            ->select(['id', 'image', 'name'])
            ->asArray()
            ->where(['status' => Book::STATUS_ACTIVE, 'category_id' => $book['category_id']])
            ->limit(10)
            ->all();
        return $this->render('about', [
            'book' => $book,
            'book_file' => $book_file,
            'book_author' => $book_author,
            'categories' => $categories,
            'books' => $books
        ]);
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        $this->layout = 'login';
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout(): Response
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * @throws NotFoundHttpException
     */
    protected function findBook($id, $select = ['book.*']): array
    {
        $model = Book::find()
            ->select($select)
            ->where('id = :id', [
                ':id' => $id
            ])->asArray()
            ->one();

        if ($model !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

    /**
     * @throws Exception
     */
    public function actionSearch(): string
    {
        $q = trim($this->request->get('q'));
        $query = Book::find()->where(['like', 'name', $q]);
        $pages = new Pagination(['totalCount' => $query->count(), 'PageSize' => 15]);
        $books = $query->offset($pages->offset)->limit($pages->limit)->all();
        if (!$q) {
            return $this->render('search', [
                'categories' => $this->findCategory(),
                'authors' => $this->findAuthor(),
                'pages' => $pages,
                'books' => ''
            ]);
        }
        return $this->render('index', [
            'categories' => $this->findCategory(),
            'books' => $books,
            'pages' => $pages,
            'authors' => $this->findAuthor()
        ]);
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    public function actionDownload($id)
    {
        $data = BookFile::find()
            ->asArray()
            ->one();
        try {

            $data['file_path'] = Yii::getAlias('@webroot') . '/' . $data['file_path'] . $data['file_name'];
//            $path = Yii::getAlias('@webroot').'/bukti/'.$download->bukti;
            $data['file_name'] = 'download1.pdf';

//            if (file_exists($data['file_path'])) {
            return Yii::$app->response->sendFile($data['file_path'], $data['file_name']);
//            }
        } catch (\Exception $e) {
            print_r($e->getMessage());
        }
//        if (!empty($data['file_path']) && !empty($data['file_name'])) {
//            header('Content-Type:' . pathinfo($data['file_path'], PATHINFO_EXTENSION));
//            header('Content-Disposition: attachment; filename = ' . $data['file_name']);
//            return readfile($data['file_path']);
//        }
//        return $this->redirect('error');
    }

    /**
     * @throws Exception
     */
    private function findCategory()
    {
        $sql = 'SELECT [[category.id]], [[category.title]], (SELECT COUNT(*) FROM {{book}} WHERE [[category.id]] = [[book.category_id]]) AS book_count FROM {{category}} WHERE status = :status';
        $query = Yii::$app->db->createCommand($sql);
        $query->bindValue(':status', Category::STATUS_ACTIVE);
        return $query->queryAll();
    }

    private function findAuthorTags(int $id): array
    {
        return BookAuthor::find()
            ->asArray()
            ->where(['book_id' => $id])
            ->all();

    }

    public function findAuthor(): array
    {
        $book_authors = BookAuthor::find()->asArray()->limit(30)->all();
        $author_arr = [];
        foreach ($book_authors as $author) {
            if (!in_array($author['full_name'], $author_arr, true)) {
                $author_arr[] = $author['full_name'];
            }
        }

        return $author_arr;
    }


}
