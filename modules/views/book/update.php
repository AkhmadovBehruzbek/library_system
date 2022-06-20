<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Book */
/* @var $book_author app\models\BookFile */
/* @var $book_file app\models\BookAuthor */
/* @var $book_file app\models\Category */

$this->title = 'Kitob ma\'lumotlarini o\'zgartirish: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Books', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Tahrirlash';
?>
<div class="book-update">
    <div class="section-body">
        <div class="container">
            <div class="card">
                <div class="card-body">

                    <h3><?= Html::encode($this->title) ?></h3>

                    <?= $this->render('_form', [
                        'model' => $model,
                        'book_author' => $book_author,
                        'book_file' => $book_file,
                        'category_list' => $category_list
                    ]) ?>

                </div>
            </div>
        </div>
    </div>
</div>
