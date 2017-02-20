<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\CategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '分类列表';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('创建分类', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('分组管理', Yii::$app->urlManager->createUrl('category-group'), ['class' => 'btn btn-info']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'label' => '所属组',
                'attribute' => 'cate_group_id',
                'value' => 'cateGroup.name',
            ],
            'name',
            'sort',
            //'keywords',
            // 'created_at',
            [
                'label' => '创始人',
                'attribute' => 'create_by',
                'value' => 'createBy.username',
            ],
            [
                'label' => '状态',
                'attribute' => 'status',
                'format' => 'raw',
                'value' => function ($model) {
                    return $model->status == 1 ? Html::a("正常", "", ['class' => 'label label-info']) : Html::a("禁用", "", ['class' => 'label label-warning']);
                },
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
