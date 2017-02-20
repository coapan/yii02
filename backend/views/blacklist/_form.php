<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model common\models\Blacklist */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="blacklist-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'ip_address')->textInput(['maxlength' => 50])->label("评论IP") ?>

    <?= $form->field($model, 'user_name')->textInput(['maxlength' => 255])->label("文章用户名") ?>

    <?= $form->field($model, 'time')->widget(DatePicker::className())->label("封禁时间") ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
