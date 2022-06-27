<?php

use app\models\Book;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Book */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Kitoblar', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="book-view">
    <div class="section-body">
        <div class="card">
            <div class="row card-body">
                <div class="col-md-6">
                    <h3><?= Html::encode($this->title) ?></h3>
                </div>

                <p class="col-md-6 text-right">
                    <?= Html::a('Tahrirlash', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                    <?= Html::a('O\'chirish', ['delete', 'id' => $model->id], [
                        'class' => 'btn btn-danger',
                        'data' => [
                            'confirm' => 'Are you sure you want to delete this item?',
                            'method' => 'post',
                        ],
                    ]) ?>
                </p>

                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        [
                            'attribute' => 'category_id',
                            'value' => $model->category->title
                        ],
                        [
                            'label' => 'Muallif',
                            'value' => static function ($model) {
                                $authors =  \app\models\BookAuthor::findAll(['book_id' => $model->id]);
                                $author = '';
                                foreach ($authors as $item) {
                                    $author .= $item['full_name'] . ', ';
                                }
                                return $author;
                            }
                        ],
                        [
                            'label' => 'Ko\'rishlar soni',
                            'value' => static function ($model) {
                                $views_count = $model->views;
                                if (!empty($views_count !== null)) {
                                    return $views_count->number;
                                }
                                return 0;
                            }
                        ],
                        [
                            'label' => 'Ko\'chirishlar soni',
                            'value' => static function ($model) {
                                $downloads_count = $model->downloads;
                                if (!empty($downloads_count !== null)) {
                                    return $downloads_count->number;
                                }
                                return 0;
                            }
                        ],
                        [
                            'label' => 'Fayl hajmi',
                            'value' => Yii::$app->formatsize->formatSizeUnits($model->bookFile->file_size)
                        ],
                        'name',
                        'pages_count',
                        'published_date',
                        [
                            'attribute' => 'image',
                            'format' => 'raw',
                            'value' => static function ($model) {
                                $image = $model->image;
                                if (!empty($image)) {
                                    return Html::img(Yii::getAlias('@web') . '/images/book/' . $image, ['width' => '120px']);
                                }
                                return '<span class="badge badge-pill badge-warning">Rasm mavjud emas</span>';
                            },
                        ],
                        [
                            'attribute' => 'status',
                            'format' => 'raw',
                            'value' => static function ($model) {
                                if ($model->status === Book::STATUS_ACTIVE) {
                                    return '<span class="badge badge-pill badge-success">Aktiv</span>';
                                }

                                return '<span class="badge badge-pill badge-danger">Aktiv emas</span>';
                            }
                        ],
                        'description',
                        [
                            'attribute' => 'created_date',
                            'value' => static function ($model) {
                                return date('d.m.Y H:i', strtotime($model->created_date));
                            }
                        ],
                        [
                            'attribute' => 'updated_date',
                            'value' => static function ($model) {
                                return date('d.m.Y H:i', strtotime($model->updated_date));
                            }
                        ],
                    ],
                ]) ?>

            </div>
        </div>
    </div>
</div>
