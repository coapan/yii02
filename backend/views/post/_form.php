<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\widgets\ueditor;

/* @var $this yii\web\View */
/* @var $model common\models\Post */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="post-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => 100])->label("标题") ?>


    <?= $form->field($model, 'cate_id')->widget(\kartik\select2\Select2::className(), [
        'data' => \yii\helpers\ArrayHelper::map(\common\models\Category::find()->all(), 'id', 'name'),
        'language' => 'en',
        'options' => [
            'placeholder' => '选择父分类（可选）',
        ],
        'pluginOptions' => [
            'allowClear' => true,
        ]
    ])->label("所属分类") ?>

    <?= $form->field($model, 'label_img')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'content')->widget('common\widgets\ueditor\Ueditor', [
        'options' => [
            //
        ],
    ])->label("文章内容"); ?>

    <?= $form->field($model, 'is_valid')->radioList(['0' => '侍审核', '1' => '正常', '-1' => '回收站', '2' => '首页置顶'])->label("状态") ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '创建' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
