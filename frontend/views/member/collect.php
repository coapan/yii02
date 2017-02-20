<?php
/**
 * Created by PhpStorm.
 * User: PanChaoZhi
 * Date: 2017/2/2
 * Time: 9:49
 */
/** @var $model \frontend\controllers\MemberController */
/** @var $pages \frontend\controllers\MemberController */
$this->title = "我的收藏";

use yii\widgets\LinkPager;
use common\Yii02;

?>
<div class="main mb20">

    <!-- Nav tabs -->
    <div role="tabpanel" style="position:relative;">

        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation"><a href="<?= Yii::$app->urlManager->createUrl('member/info') ?>">个人资料</a></li>
            <li role="presentation" class="active"><a href="<?= Yii::$app->urlManager->createUrl('member/collect') ?>">收藏</a>
            </li>
            <li role="presentation"><a href="<?= Yii::$app->urlManager->createUrl('member/comment') ?>">评论</a></li>
            <li role="presentation"><a href="<?= Yii::$app->urlManager->createUrl('member/post') ?>">我发表的</a></li>
            <li role="presentation"><a href="<?= Yii::$app->urlManager->createUrl('member/message') ?>">消息</a></li>
        </ul>


        <!-- Tab panes -->
        <div class="tab-content pd20">

            <div role="tabpanel" class="tab-pane active" id="two">
                <ul class="list-unstyled">
                    <?php foreach ($model as $v): ?>
                        <li class="sidebar_list wmhot">
                            <a href="<?= Yii::$app->urlManager->createUrl(['post/index', 'cid' => $v['cate']['id']]) ?>"
                               class="" title="<?= $v['cate']['name'] ?>"><span
                                    class="text-primary">【<?= $v['cate']['name'] ?>】</span> </a>
                            <a href="<?= Yii::$app->urlManager->createUrl(['post/view', 'id' => $v['id']]) ?>" class=""
                               title="<?= $v['title'] ?>"><span><?= $v['title'] ?></span></a>
                        </li>
                    <?php endforeach; ?>
                </ul>
                <hr/>
                <?= LinkPager::widget([
                    'pagination' => $pages,
                ]); ?>
            </div>
        </div>
    </div>
</div>
