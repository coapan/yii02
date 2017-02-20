<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\PostSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '文章管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('创建文章', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('举报信息', Yii::$app->urlManager->createUrl("report"), ['class' => 'btn btn-primary']) ?>
        删除的文章在“回收站”中，回收站中的文章不会在前台显示。
        如果文章违规，可将文章直接删除并在黑名单中添加“用户名”或者“IP”来限制用户
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            //'label_img',
            //'summary',
            //'content:ntext',
            [
                'label'=>'分类名',
                'attribute'=>'cate_id',
                'value'=>'cate.name',
            ],
            [
                'label'=>'作者',
                'attribute'=>'user_id',
                'value'=>'user.username',
            ],
            // 'cate_id',
            // 'user_id',
            // 'user_name',
            [
                'label'=>'状态',
                'attribute'=>'is_valid',
                'format'=>'raw',
                'value'=> function ($model) {
                    if ($model->is_valid == 1) {
                        return Html::a("正常", "", ['class'=>'label label-info']);
                    } else if ($model->is_valid == 0) {
                        return Html::a("侍审核","",['class'=>'label label-success']);
                    } else if ($model->is_valid == -1) {
                        return Html::a("回收站","",['class'=>'label label-primary']);
                    } else if ($model->is_valid == 2) {
                        return Html::a("首页置顶","",['class'=>'label label-primary']);
                    } else if ($model->is_valid == 3) {
                        return Html::a("同时置顶","",['class'=>'label label-primary']);
                    }
                },
            ],
            // 'is_valid',
            // 'browser',
            // 'created_at',
            // 'updated_at',
            // 'zan',
            // 'cai',
            [
                'label'=>'IP地址',
                'attribute'=>'ip_address',
            ],
            // 'ip_address',
            // 'keywords',
            // 'last_comment',
            // 'signature',
            // 'nickname',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
