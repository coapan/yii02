<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Post */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => '文章列表', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('更新', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('删除', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            'label_img',
            'summary',
            'content:ntext',
            //'cate_id',
            //可以这么用
            [
                'attribute' => 'cate_id',
                'value' => $model->cate->name,
            ],
            //也可以这么用
            //'cate.name',
            'user_id',
            'user_name',
            //'is_valid',
            [
                'label' => '文章状态',
                'attribute' => 'is_valid',
                'value' => function ($model) {
                    return $model->is_valid == 1 ? "已发布" : "未发布";
                },
                'filter' => ['0' => '未发布', '1' => '已发布'],
            ],
            'browser'=>[
                    'attribute'=>'browser',
                    'value'=>$model->browser.'次',
            ],
            //'created_at',
            [
                'label' => '创建时间',
                'attribute' => 'created_at',
                'value' => date("Y-m-d H:i:s"),
            ],
            //'updated_at',
            [
                'label' => '创建时间',
                'attribute' => 'updated_at',
                'value' => date("Y-m-d H:i:s"),
            ],
            'zan',
            'cai',
            'ip_address',
            'keywords',
            //'last_comment',
            [
                'label' => '创建时间',
                'attribute' => 'last_comment',
                'value' => date("Y-m-d H:i:s"),
            ],
            'signature',
            'nickname',
        ],
        'options' => [
            'class' => 'table table-striped table-bordered detail-view'
        ],
        'template' => '<tr><th style="width: 120px">{label}</th><td>{value}</td></tr>',
    ]) ?>

</div>