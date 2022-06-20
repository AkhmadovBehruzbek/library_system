<?php

use app\models\Category;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Category */

$this->title = $model['title'];
$this->params['breadcrumbs'][] = ['label' => 'Kategoriyalar', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="category-view">
    <div class="section-body">
        <div class="card">
            <div class="row card-body">
                <div class="col-md-6">
                    <h3><?= Html::encode($this->title) ?></h3>
                </div>
                <p class="col-md-6 text-right">
                    <?= Html::a('Tahrirlash', ['update', 'id' => $model['id']], ['class' => 'btn btn-primary']) ?>
                    <?= Html::a('O\'chirish', ['delete', 'id' => $model['id']], [
                        'class' => 'btn btn-danger',
                        'data' => [
                            'confirm' => 'Haqiqatdan ham ushbu kategoriyani o\'chirmoqchimisiz?',
                            'method' => 'post',
                        ],
                    ]) ?>
                </p>

                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        'title',
                        [
                            'label' => 'Kategoriyadagi kitoblar soni',
                            'value' => $model['book_count']
                        ],
                        [
                            'attribute' => 'status',
                            'format' => 'raw',
                            'value' => static function ($model) {
                                if ($model['status'] === Category::STATUS_ACTIVE) {
                                    return '<span class="badge badge-pill badge-success">Aktiv</span>';
                                }

                                return '<span class="badge badge-pill badge-danger">Aktiv emas</span>';
                            }
                        ],
                        [
                            'attribute' => 'created_date',
                            'value' => static function ($model) {
                                return date('d.m.Y H:i', strtotime($model['created_date']));
                            }
                        ],
                        [
                            'attribute' => 'updated_date',
                            'value' => static function ($model) {
                                return date('d.m.Y H:i', strtotime($model['updated_date']));
                            }
                        ],
                    ],
                ]) ?>

            </div>
        </div>
    </div>
</div>