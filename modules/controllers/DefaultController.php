<?php

namespace app\modules\controllers;

use app\models\Book;
use app\models\Category;
use app\models\Comment;
use yii\data\ActiveDataProvider;

/**
 * Default controller for the `admin` module
 */
class DefaultController extends RoleController
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex(): string
    {
        $query = Comment::find()->orderBy('created_date DESC');
        $dataProvider = new ActiveDataProvider(['query' => $query]);
        $book_count = Book::find()->where(['status' => Book::STATUS_ACTIVE])->count();
        $category_count = Category::find()->where(['status' => Book::STATUS_ACTIVE])->count();
        return $this->render('index', [
            'book_count' => $book_count,
            'category_count' => $category_count,
            'message_count' => 1,
            'dataProvider' => $dataProvider,
        ]);
    }
}
