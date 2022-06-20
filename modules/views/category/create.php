<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Category */

$this->title = 'Yangi kategoriya qo\'shish';
$this->params['breadcrumbs'][] = ['label' => 'Kategoriyalar', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-create">
    <div class="section-body">
        <div class="container">
            <div class="card">
                <div class="card-body">

                    <h3><?= Html::encode($this->title) ?></h3>

                    <?= $this->render('_form', [
                        'model' => $model,
                    ]) ?>

                </div>
            </div>
        </div>
    </div>
</div>
