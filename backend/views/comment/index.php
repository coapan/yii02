<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\CommentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Comments';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="comment-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('举报评论', Yii::$app->urlManager->createUrl("report-comment"), ['class' => 'btn btn-success']) ?>
        注意：删除评论的话会删除当前评论及其回复。如果评论违规，如非必要，请不要删除评论，只需将评论状态编辑为违规即可。
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
//            'pid',
//            'content:ntext',
//            'user_id',
//            'post_id',
        [
            'label'=>'用户',
            'attribute'=>'user_name',
        ],
            // 'user_name',
            // 'status',
            // 'signature',
            // 'time:datetime',
            // 'zan',
            // 'cai',
            // 'img',
             'ip_address',
            // 'reply_to',
            // 'msgstatus',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
