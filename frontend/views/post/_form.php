<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Post */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="post-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cate_id')->dropDownList([1, 2, 3]) ?>

    <?= $form->field($model, 'label_img')->widget('common\widgets\file_upload\FileUpload', [
        'config' => [

        ],
    ]) ?>

    <?= $form->field($model, 'content')->widget('common\widgets\ueditor\Ueditor', [
        'options' => [
            'initialFrameHeight' => 350,
            'toolbars' => [
                ['insertcode', 'undo', 'forecolor', 'justifyleft', 'justifycenter', 'justifyright', 'indent', 'simpleupload', 'fullscreen'],
            ]
        ]
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '创建' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
