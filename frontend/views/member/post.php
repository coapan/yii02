<?php
/**
 * Created by PhpStorm.
 * User: PanChaoZhi
 * Date: 2017/2/1
 * Time: 20:21
 */
/** @var $model \frontend\controllers\MemberController */
/** @var $pages \frontend\controllers\MemberController */
$this->title = "我发布的文章";

use yii\data\Pagination;

?>
<div class="main mb20">
    <div role="tabpanel" style="position: relative;">
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation"><a
                    href="<?= Yii::$app->urlManager->createUrl('member/info') ?>">个人资料</a></li>
            <li role="presentation"><a href="<?= Yii::$app->urlManager->createUrl('member/collect') ?>">我的收藏</a></li>
            <li role="presentation"><a href="<?= Yii::$app->urlManager->createUrl('member/comment') ?>">我的评论</a></li>
            <li role="presentation" class="active"><a
                    href="<?= Yii::$app->urlManager->createUrl('member/post') ?>">我发表的</a></li>
            <li role="presentation"><a href="<?= Yii::$app->urlManager->createUrl('member/message') ?>">我的消息</a></li>
        </ul>

        <div class="tab-content pd20">
            <!-- 筛选分类的文章 -->
            <!--<div role="tabpanel" class="tab-pane active" id="three">
                <span style="font-size: 16px;float: left;">?????????</span>
                <div class="btn-group">
                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false" style="float: right">筛选<span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="<? /*= Yii::$app->urlManager->createUrl(['member/post']) */ ?>">我发表的文章</a> </li>
                    </ul>
                </div>
            </div>-->

            <div class="row">
                <div class="col-xs-12">
                    <ul class="list-unstyled">
                        <?php foreach ($model as $value): ?>
                            <li class="sidebar_list wmhot">
                                <a href="<?= Yii::$app->urlManager->createUrl(['post/index', 'cid' => $value['cate']['id']]) ?>"
                                   class="" title="<?= $value['cate']['name'] ?>"><span class="text-primary">【<?= $value['cate']['name'] ?>】</span></a>
                                <a href="<?= Yii::$app->urlManager->createUrl(['post/view', 'id' => $value['id']]) ?>"
                                   class="" title="<?= $value['title'] ?>"><span><?= $value['title'] ?></span></a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                    <hr>
                    <?= \yii\widgets\LinkPager::widget([
                        'pagination' => $pages,
                    ]); ?>
                </div>
            </div>
        </div>
    </div>
</div>