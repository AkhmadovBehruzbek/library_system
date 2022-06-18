<?php

use yii\grid\SerialColumn;
use app\models\Book;
use yii\helpers\Html;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\BookSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Books';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="book-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Book', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => SerialColumn::class],

            'id',
            'category_id',
            'name',
            'description',
            'pages_count',
            //'published_date',
            //'image',
            //'status',
            //'created_date',
            //'updated_date',
            [
                'class' => ActionColumn::className(),
                'template' => '{view} {update} {delete} {restore}',
                'visibleButtons' => [
                    'view' => static function ($model) {
                        return $model->status === Book::STATUS_ACTIVE;
                    },
                    'update' => static function ($model) {
                        return $model->status === Book::STATUS_ACTIVE;
                    },
                ],
                'buttons' => [
                    'view' => static function ($url, $model) {
                        return Html::a(
                            Yii::$app->params['view_icon'],
                            $url, [
                            'class' => 'btn btn-outline-info btn-sm',
                            'title' => 'Kategoriya haqida batafsil'
                        ]);
                    },
                    'update' => static function ($url, $model) {
                        return Html::a(
                            Yii::$app->params['edit_icon'],
                            $url, [
                            'class' => 'btn btn-sm btn-outline-warning',
                            'title' => 'Kategoriya ma\'lumotlarini o\'zgartirish'
                        ]);
                    },
                    'delete' => static function ($url, $data) {
                        $iconClass = $data->status === Book::STATUS_ACTIVE ? Yii::$app->params['delete_icon'] : Yii::$app->params['restore_icon'];

                        $btn = $data->status === 1 ? 'btn btn-outline-danger btn-sm' : 'btn btn-outline-dark btn-sm';
                        return Html::a(
                            $iconClass,
                            $url, [
                            'class' => $btn,
                            'data' => [
                                'confirm' => Yii::t('app', 'Ishonchingiz komilmi?'),
                                'method' => 'post',
                            ],
                        ]);
                    },
                ],
            ],
        ],
    ]); ?>


</div>
