<?php

use yii\grid\SerialColumn;
use app\models\Book;
use yii\helpers\Html;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\BookSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Kitoblar bo\'limi';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="book-index">
    <div class="card">
        <div class="card-body">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h3 class="section-title my-0"><?= Html::encode($this->title) ?></h3>
                </div>
                <div class="col-md-6 text-right">
                    <?= Html::a('<i class="fas fa-plus"></i> ' . Yii::t('app', 'Kitob qo\'shish'), ['create'],
                        ['class' => 'btn btn-icon icon-left btn-success']) ?>
                </div>
            </div>
            <br>
            <div class="table-responsive">
                <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'columns' => [
                        ['class' => SerialColumn::class],
                        [
                            'attribute' => 'image',
                            'format' => 'raw',
                            'value' => static function ($model) {
                                return Html::img(Yii::getAlias('@web') . '/images/book/' . $model->image, ['width' => '120px']);
                            },
                        ],
                        [
                            'attribute' => 'category_id',
                            'value' => 'category.title'
                        ],
                        'name',
                        [
                            'attribute' => 'created_date',
                            'value' => static function ($model) {
                                return date('d.m.Y', strtotime($model->created_date));
                            }
                        ],
                        [
                            'attribute' => 'bookAuthors.full_name',
                            'format' => 'text',
                            'value' => 'bookAuthors.full_name'
                        ],
                        [
                            'label' => 'Holati',
                            'format' => 'raw',
                            'value' => static function ($model) {
                                if ($model->status === Book::STATUS_ACTIVE) {
                                    return '<span class="badge badge-pill badge-success">Aktiv</span>';
                                }

                                return '<span class="badge badge-pill badge-danger">Aktiv emas</span>';
                            }
                        ],
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
                ]) ?>
            </div>
        </div>
    </div>
</div>
