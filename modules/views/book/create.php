<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Book */
/* @var $book_file app\models\BookFile */
/* @var $book_author app\models\BookAuthor */
/* @var $category_list app\models\Category */

$this->title = 'Yangi kitob qo\'shish';
$this->params['breadcrumbs'][] = ['label' => 'Kitoblar', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="book-create">

    <div class="section-body">
        <div class="container">
            <div class="card">
                <div class="card-body">
                    <h3><?= Html::encode($this->title) ?></h3>

                    <?= $this->render('_form', [
                        'model' => $model,
                        'book_file' => $book_file,
                        'book_author' => $book_author,
                        'category_list' => $category_list
                    ]) ?>

                </div>
            </div>
        </div>
    </div>
</div>
