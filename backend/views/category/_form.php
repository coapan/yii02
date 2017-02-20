<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\CategoryGroup;
use kartik\select2\Select2;


/* @var $this yii\web\View */
/* @var $model common\models\Category */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="category-form">

    <?php $form = ActiveForm::begin([
        'options' => [
            'enctype' => 'multipart/form-data',
        ],
    ]); ?>

    <?= $form->field($model, 'cate_group_id')->widget(Select2::className(), [
        'data' => ArrayHelper::map(CategoryGroup::find()->all(), 'id', 'name'),
        'language' => 'en',
        'options' => ['placeholder' => '请选择分组(必选)'],
        'pluginOptions' => [
            'allowClear' => true,
        ]
    ])->label("分类组") ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => 20])->label("分类名") ?>

    <?= $form->field($model, 'sort')->textInput()->label("排序") ?>

    <?= $form->field($model, 'keywords')->textInput(['maxlength' => true])->label("关键词") ?>

    <?= $form->field($model, 'status')->radioList(['0' => '禁用', '1' => '启用'])->label("状态") ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
