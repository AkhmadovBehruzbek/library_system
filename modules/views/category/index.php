<?php

use yii\grid\SerialColumn;
use app\models\Category;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Kategoriyalar bo\'limi';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Yangi kategoriya qo\'shish', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => SerialColumn::class],
            'title',
            [
                'attribute' => 'status',
                'format' => 'raw',
                'value' => static function ($model) {
                    if ($model->status === Category::STATUS_ACTIVE)
                        return '<span class="badge badge-pill badge-success">Aktiv</span>';

                    return '<span class="badge badge-pill badge-danger">Aktiv emas</span>';
                }
            ],
            'created_date',
            'updated_date',
            [
                'class' => ActionColumn::className(),
                'template' => '{view} {update} {delete} {restore}',
                'visibleButtons' => [
                    'view' => static function ($model) {
                        return $model->status === Category::STATUS_ACTIVE;
                    },
                    'update' => static function ($model) {
                        return $model->status === Category::STATUS_ACTIVE;
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
                        $iconClass = $data->status === Category::STATUS_ACTIVE ? Yii::$app->params['delete_icon'] : Yii::$app->params['restore_icon'];

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
