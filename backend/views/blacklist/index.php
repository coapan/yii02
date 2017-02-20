<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\BlacklistSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '黑名单列表';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="blacklist-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('添加黑名单', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'label'=>'IP地址',
                'attribute'=>'ip_address',
            ],
            [
                'label'=>'结束时间',
                'attribute'=>'time',
            ],
            [
                'label'=>'用户名',
                'attribute'=>'user_name',
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
