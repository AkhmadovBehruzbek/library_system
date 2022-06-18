<?php

use faryshta\widgets\JqueryTagsInput;
use kartik\file\FileInput;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\MaskedInput;

/* @var $this yii\web\View */
/* @var $model app\models\Book */
/* @var $book_file app\models\BookFile */
/* @var $book_author app\models\BookAuthor */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="book-form">
    <div class="container">

        <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
        <?php Yii::$app->params['bsVersion'] = '4.x' ?>
        <div class="row">
            <div class="col-md-4">
                <?= $form->field($model, 'category_id')->textInput() ?>

            </div>
            <div class="col-md-4">
                <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

            </div>

            <div class="col-md-4">
                <?= $form->field($model, 'pages_count')->textInput(['type' => 'number', 'maxlength' => 5]) ?>

            </div>
            <div class="col-md-4">
                <?= $form->field($model, 'published_date', [
                ])->widget(MaskedInput::className(), [
                    'mask' => '9999',
                    'options' => [
                        'class' => 'form-control',
                    ],
                    'clientOptions' => [
                        'clearIncomplete' => true
                    ]
                ]) ?>
            </div>

            <div class="col-md-4">
                <?= $form->field($model, 'image')->widget(FileInput::classname(), [
                    'options' => [
                        'accept' => 'image/*',
                        'placeholder' => '...',
                    ],
                    'pluginOptions' => [
                        'showCaption' => true,
                        'removeClass' => 'btn btn-danger',
                        'theme' => 'fa',
                        'showRemove' => false,
                        'showUpload' => false,
                        'browseClass' => 'btn btn-primary',
                        'browseLabel' => Yii::t('app', 'Yuklash'),
                        'fileActionSettings' => [
                            'zoomClass' => 'btn btn-info',
                            'removeClass' => false,
                            'showDrag' => false,
                        ],
                        'initialPreview' => [
                            $model->image !== null ? "/web/images/book/" . $model->image : "",
                        ],
                        'initialPreviewShowDelete' => false,
                        'initialPreviewAsData' => true,
                        'overwriteInitial' => true,
                    ]
                ]) ?>
            </div>

            <div class="col-md-4">
                <?= $form->field($book_file, 'file_name')->fileInput() ?>
            </div>

            <div class="col-md-4">
                <label class="control-label" for="book-published_date">Kitob muallifi</label>
                <?= JqueryTagsInput::widget([
                    'model' => $book_author,
                    'attribute' => 'full_name',
                    'clientOptions' => [
                        'defaultText' => 'Muallif..',
                    ],
                ]);
                ?>
            </div>
            <div class="col-md-8">
                <?= $form->field($model, 'description')->textarea(['maxlength' => true, 'rows' => '12']) ?>
            </div>
        </div>


        <div class="form-group">
            <?= Html::submitButton('Saqlash', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>

</div>
