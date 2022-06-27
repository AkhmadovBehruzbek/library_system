<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <div class="row" style="margin-top: 70px">

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Aktiv kitoblar soni
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $book_count ?></div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Aktiv Kategoriyalar soni
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $category_count ?></div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <!--            <div class="col-xl-3 col-md-6 mb-4">-->
            <!--                <div class="card border-left-info shadow h-100 py-2">-->
            <!--                    <div class="card-body">-->
            <!--                        <div class="row no-gutters align-items-center">-->
            <!--                            <div class="col mr-2">-->
            <!--                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Tasks-->
            <!--                                </div>-->
            <!--                                <div class="row no-gutters align-items-center">-->
            <!--                                    <div class="col-auto">-->
            <!--                                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">50%</div>-->
            <!--                                    </div>-->
            <!--                                    <div class="col">-->
            <!--                                        <div class="progress progress-sm mr-2">-->
            <!--                                            <div class="progress-bar bg-info" role="progressbar" style="width: 50%"-->
            <!--                                                 aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>-->
            <!--                                        </div>-->
            <!--                                    </div>-->
            <!--                                </div>-->
            <!--                            </div>-->
            <!--                            <div class="col-auto">-->
            <!--                                <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>-->
            <!--                            </div>-->
            <!--                        </div>-->
            <!--                    </div>-->
            <!--                </div>-->
            <!--            </div>-->

            <!-- Pending Requests Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    Yangi habarlar soni
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $message_count ?></div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-comments fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php

use yii\grid\SerialColumn;
use app\models\Contact;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Fikrlar';
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
                        [
                            'label' => 'Kitob nomi',
                            'value' => 'book.name'
                        ],
                        'full_name',
                        'email:email',
                        'description:ntext',
                        [
                            'attribute' => 'status',
                            'format' => 'raw',
                            'value' => static function ($model) {
                                if ($model->status === \app\models\Comment::STATUS_ACTIVE) {
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
