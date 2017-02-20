<?php
/**
 * Created by PhpStorm.
 * User: PanChaoZhi
 * Date: 2017/2/1
 * Time: 21:31
 */
/** @var $model \frontend\controllers\MemberController */
/** @var $pages \frontend\controllers\MemberController */
$this->title = "我发布的文章";

use yii\widgets\LinkPager;

?>
<div class="main mb20">
    <div role="tabpanel" style="position: relative;">
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation"><a
                    href="<?= Yii::$app->urlManager->createUrl('member/info') ?>">个人资料</a></li>
            <li role="presentation"><a href="<?= Yii::$app->urlManager->createUrl('member/collect') ?>">我的收藏</a></li>
            <li role="presentation" class="active"><a href="<?= Yii::$app->urlManager->createUrl('member/comment') ?>">我的评论</a>
            </li>
            <li role="presentation"><a
                    href="<?= Yii::$app->urlManager->createUrl('member/post') ?>">我发表的</a></li>
            <li role="presentation"><a href="<?= Yii::$app->urlManager->createUrl('member/message') ?>">我的消息</a></li>
        </ul>

        <div class="tab-content pd20">
            <div role="tabpanel" class="tab-pane active" id="two">
                <ul class="list-unstyled">
                    <?php foreach ($model as $value): ?>
                        <li class="sidebar_list wmhot">
                            在<a href="<?= Yii::$app->urlManager->createUrl(['post/view', 'id' => $value['post_id']]) ?>"><span class="text-primary">【<?= \common\Yii02::getPostTitle($value['id']) ?>】</span></a>中发表评论：
                            <a href="<?= Yii::$app->urlManager->createUrl(['post/view', 'id' => $value['post_id']]) ?>#comment<?= $value['id'] ?>"><span><?= \common\Yii02::getSummary($value['content'], 0, 30) ?></span></a>
                        </li>
                    <?php endforeach; ?>
                </ul>
                <hr>
                <?= LinkPager::widget([
                    'pagination' => $pages,
                ]); ?>
            </div>
        </div>
    </div>
</div>
