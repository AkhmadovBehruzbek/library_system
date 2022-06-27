<?php

use yii\grid\SerialColumn;
use app\models\Contact;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Xabarlar';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contact-index">
    <div class="section-body">
        <div class="card">
            <div class="card-body">

                <h3><?= Html::encode($this->title) ?></h3>

                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'columns' => [
                        ['class' => SerialColumn::class],
                        'full_name',
                        'email:email',
                        'description:ntext',
                        [
                            'attribute' => 'status',
                            'format' => 'raw',
                            'value' => static function ($model) {
                                if ($model->status === Contact::STATUS_ACTIVE) {
                                    return '<span class="badge badge-pill badge-success">Aktiv</span>';
                                }

                                return '<span class="badge badge-pill badge-danger">Aktiv emas</span>';
                            }
                        ],
                        [
                            'attribute' => 'created_date',
                            'value' => static function ($model) {
                                return date('d.m.Y H:i', strtotime($model->created_date));
                            }
                        ],
                    ],
                ]) ?>


            </div>
        </div>
    </div>
</div>
