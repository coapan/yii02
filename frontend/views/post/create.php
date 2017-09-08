<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Post */
/* @var $cate[] common\models\Category */

$this->title = '文章创建';
$this->params['breadcrumbs'][] = ['label' => '文章', 'url' => ['index1']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="content-wrap">
    <div class="col-lg-9">
        <div class="panel-title">
            <span>创建文章</span>
        </div>

        <div class="panel-body">
            <?php $form = \yii\widgets\ActiveForm::begin(); ?>

            <?= $form->field($model, 'title')->textInput(['maxLength' => true]) ?>

            <?= $form->field($model, 'cate_id')->dropDownList($cate) ?>

            <?= $form->field($model, 'label_img')->widget('common\widgets\file_upload\FileUpload', [
                'options' => [
                    //
                ]
            ]) ?>
            <?= $form->field($model, 'content')->widget('common\widgets\ueditor\Ueditor', [
                'options' => [
                    'initialFrameHeight' => 350,
                    'toolbars' => [
                        ['insertcode', 'undo', 'forecolor', 'justifyleft', 'justifycenter', 'justifyright', 'indent', 'simpleupload', 'fullscreen'],
                    ]
                ]
            ]) ?>

            <?= $form->field($model, 'tags')->widget('common\widgets\tags\TagWidget', [
                'options' => [

                ]
            ])?>
            <div class="form-group nomargin">
                <p class="help-block">提示:输入标签文字后回车即可</p>
            </div>

            <div class="form-group">
                <?= Html::submitButton('发布', ['class' => 'btn btn-primary']) ?>
            </div>

            <?php \yii\widgets\ActiveForm::end() ?>
        </div>

    </div>

    <div class="col-lg-3">
        <div class="panel-title box-title">
            <span>注意事项</span>
        </div>

        <div class="panel-body">
            <p>1. 不能发表带恐怖，色情的文章。</p>
            <p>2. 不能发表那只那啥那啥那啥。</p>
            <p>3. 注意形象！</p>
        </div>
    </div>
</div>
