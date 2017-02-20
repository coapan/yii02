<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\ReportCommentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '举报信息列表';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="report-comment-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('评论列表', Yii::$app->urlManager->createUrl("comment"), ['class' => 'btn btn-success']) ?>
        可在评论列表搜索“评论ID”来管理评论。如果恶意举报请将“ID地址”添加至黑名单
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'label' => '评论ID',
                'attribute' => 'comment_id',
            ],
            [
                'label' => '举报理由',
                'attribute' => 'reason',
            ],
            //'status',
            [
                'label' => 'IP地址',
                'attribute' => 'ip_address',
            ],
            [
                'label' => '评论IP',
                'attribute' => 'cate_id',
                'value' => 'comment.ip_address',
            ],
            [
                'label' => '评论内容',
                'attribute' => 'cate_id',
                'value' => 'comment.content',
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
