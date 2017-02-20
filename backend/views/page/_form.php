<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Page */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="page-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true])->label("单页别名（不要用中文和特殊符号") ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => 100])->label("单页标题") ?>

    <script id="container" name="Page[content]"><?= $model['content'] ?></script>

    <?= $form->field($model, 'keywords')->textInput(['maxlength' => true])->label("关键词") ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true])->label("描述信息") ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php $this->registerJsFile("@web/ueditor/ueditor.config.js");?>
<?php $this->registerJsFile("@web/ueditor/ueditor.all.min.js");?>
<?php
$script=<<<UM
    jQuery(document).ready(function($){
        var ue=UE.getEditor('container',{
            initialFrameHeight:400
        });
        ue.ready(function(){
            //设置编辑器的内容
            //ue.setContent('请输入页面内容');
        });
        ue2.ready(function(){
            //设置编辑器的内容
            //ue2.setContent('请输入页面内容');
        });
    });
UM;
$this->registerJs($script);
?>
