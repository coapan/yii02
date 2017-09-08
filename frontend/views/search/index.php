<?php
/**
 * Created by PhpStorm.
 * User: PanChaoZhi
 * Date: 2017/2/2
 * Time: 14:15
 */
/** @var $model \frontend\controllers\SearchController */
/** @var $q */
/** @var $pages */
/** @var $count */
use common\Yii02;
use yii\bootstrap\Alert;
use yii\widgets\LinkPager;

?>
<?php //zhi($model);exit;?>
<?php if (!$model): ?>
    <div class="main pd20">
        <?php
        Alert::begin([
            'options' => [
                'class' => 'alert-warning',
            ],
        ]);

        echo "没有找到你的关键词...请尝试其他关键词";

        Alert::end();
        ?>
    </div>
<?php else: ?>


    <div class="content-wrap">
        <div class="content">
            <header class="archive-header">
                <h1>有关【<?= $q; ?>】的内容</h1>
            </header>
            <?php foreach ($model as $list):
                //zhi($list);exit;
                //$cate_id = $list['cate_id'];
                ?>

                <article class="excerpt">
                    <header><a class="label label-important"
                               href="<?= Yii::$app->urlManager->createUrl(['post/index', 'cid' => $list['cate']['id']]) ?>">
                            <?= $list['cate']['name'] ?>
                            <i class="label-arrow"></i></a>
                        <h2>
                            <a href="<?= \yii\helpers\Url::to(['post/view', 'id' => $list['id']]) ?>"><?= $list['title'] ?></a>
                        </h2>
                    </header>
                    <div class="focus">
                        <img class="thumb"
                             src="<?= ($list['label_img'] ? $list['label_img'] : \Yii::$app->params['default_label_img']) ?>"
                             alt="<?= $list['title'] ?>" style="width: 200px;height: 123px;"
                        </a></div>
                    <span class="note"><?= \common\Yii02::cutStr($list['content'], 150) ?>……<a
                                href="<?= \yii\helpers\Url::to(['post/view', 'id' => $list['id']]) ?>" rel="nofollow"
                                class="more-link">继续阅读 &raquo;</a></span>
                    <p class="auth-span">
                    <span class="muted"><i class="fa fa-user"></i> <a
                                href="<?= \yii\helpers\Url::to(['member/info', 'id' => $list['user_id']]) ?>"><?= $list['user_name'] ?></a>&nbsp;</span>
                        <span class="muted"><i class="fa fa-clock-o"></i> <?= date('Y-m-d', $list['created_at']) ?>
                            &nbsp;</span> <span class="muted"><i
                                    class="fa fa-eye"></i> <?= \common\Yii02::getBrowser($list['id']) ?>浏览</span> <span
                                class="muted"><i class="fa fa-comments-o"></i> <a
                                    target="_blank"
                                    href="<?= Yii::$app->urlManager->createUrl(['post/view', 'id' => $list['id']]) ?>#comment"><?= \common\Yii02::getComment($list['id']) ?>
                                评论</a></span><span
                                class="muted">
<a href="javascript:;" data-action="ding" data-id="62" id="Addlike" class="action"><i class="fa fa-heart-o"></i><span
            class="count">0</span>个赞</a></span></p>
                </article>

            <?php endforeach; ?>
            <!--        --><?php //if ($this->pages): ?>
            <div class="page">
                <?= \yii\widgets\LinkPager::widget([
                    'pagination' => $pages,
                    'prevPageLabel' => '上一页',
                    'nextPageLabel' => '下一页',
                    'firstPageLabel' => '首页',
                    'lastPageLabel' => '尾页',
                    'hideOnSinglePage' => true,
                    'maxButtonCount' => 10,
                ]); ?>
            </div>
            <!--        --><?php //endif; ?>
        </div>
    </div>
<?php endif; ?>