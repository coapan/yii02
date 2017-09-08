<?php
/**
 * Created by PhpStorm.
 * User: PanChaoZhi
 * Date: 2017/1/29
 * Time: 13:55
 * 所有文章列表
 */
/** @var $data \frontend\widgets\post\PostWidget */
/** @var $model \frontend\widgets\post\PostWidget */
//zhi($model);
?>
<!--<div class="panel">
    <div class="panel-title box-title">
        <span><b><? /*= $data['title'] */ ?></b></span>
        <?php /*if ($this->context->more): */ ?>
            <span class="pull-right"><a href="<? /*= $data['more'] */ ?>" class="font-12">更多>></a> </span>
        <?php /*endif; */ ?>
    </div>

    <div class="new-list">
        <?php /*foreach ($data['body'] as $list): */ ?>
            <div class="panel-body border-bottom">
                <div class="row">
                    <div class="col-lg-4 label-img-size">
                        <a href="#" class="post-label">
                            <img
                                src="<? /*= ($list['label_img'] ? $list['label_img'] : \Yii::$app->params['default_label_img']) */ ?>"
                                alt="<? /*= $list['title'] */ ?>">
                        </a>
                    </div>

                    <div class="col-lg-8 btn-group">
                        <h1>
                            <a href="<? /*= \yii\helpers\Url::to(['post/view', 'id' => $list['id']]) */ ?>"><? /*= $list['title'] */ ?></a>
                        </h1>
                        <span class="post-tags">
                        <span class="glyphicon glyphicon-user"></span>
                        <a href="<? /*= \yii\helpers\Url::to(['member/info', 'id' => $list['user_id']]) */ ?>"><? /*= $list['user_name'] */ ?></a>&nbsp;
                        <span class="glyphicon glyphicon-time"></span>
                            <? /*= date('Y-m-d', $list['created_at']) */ ?>&nbsp;
                        <span class="glyphicon glyphicon-eye-open"></span>
                            <? /*= \common\Yii02::getBrowser($list['id']) */ ?>次&nbsp;
                        <span class="glyphicon glyphicon-comment"></span>
                            <? /*= \common\Yii02::getComment($list['id']) */ ?>次
                        <a href="javascript:;" class="collect"><span class="glyphicon glyphicon-heart-empty"></span><em>收藏</em><i style="display: none;"><? /*= $list['id']*/ ?></i> </a>
                    </span>

                        <p class="post_content"><? /*= $list['summary'] */ ?></p>
                        <a href="<? /*= \yii\helpers\Url::to(['post/view', 'id' => $list['id']]) */ ?>">
                            <button class="btn btn-warning no-radius btn-sm pull-right">阅读全文</button>
                        </a>
                    </div>
                </div>

                <div class="tags">
                    <?php /*if (!empty($list['tags'])): */ ?>
                        <span class="fa fa-tags"></span>
                        <?php /*foreach ($list['tags'] as $tag): */ ?>
                            <a href="#"><? /*= $tag */ ?></a>
                        <?php /*endforeach; */ ?>
                    <?php /*endif; */ ?>
                </div>
            </div>
        <?php /*endforeach; */ ?>
    </div>
    <?php /*if ($this->context->page): */ ?>
        <div class="page">
            <? /*= \yii\widgets\LinkPager::widget([
                'pagination' => $data['page'],
            ]); */ ?>
        </div>
    <?php /*endif; */ ?>
</div>-->

<div class="content-wrap">
    <div class="panel">
        <div class="content">

            <?php foreach ($data['body'] as $list):
                //zhi($list);exit;
                $cate_id = $list['cate_id'];
                ?>

                <article class="excerpt">
                    <header><a class="label label-important" href="<?= Yii::$app->urlManager->createUrl(['post/index', 'cid' => $cate_id]) ?>">
                            <?php $res = (\common\models\Category::findOne(['id' => $cate_id]));
                            echo $res['name']; ?>
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
                                    href="<?= Yii::$app->urlManager->createUrl(['post/view', 'id' => $list['id']])?>#comment"><?= \common\Yii02::getComment($list['id']) ?>
                                评论</a></span><span
                                class="muted">
<a href="javascript:;" data-action="ding" data-id="62" id="Addlike" class="action"><i class="fa fa-heart-o"></i><span
            class="count">0</span>个赞</a></span></p>
                </article>

            <?php endforeach; ?>
            <?php if ($this->context->page): ?>
                <div class="page">
                    <?= \yii\widgets\LinkPager::widget([
                        'pagination' => $data['page'],
                        'prevPageLabel' => '上一页',
                        'nextPageLabel' => '下一页',
                        'firstPageLabel' => '首页',
                        'lastPageLabel' => '尾页',
                        'hideOnSinglePage' => true,
                        'maxButtonCount' => 10,
                    ]); ?>
                </div>
            <?php endif; ?>

        </div>
    </div>
</div>


<aside class="sidebar">
    <div class="widget widget_recent_entries">
        <div class="title"><h2>近期文章</h2></div>
        <?php
        $post_list = \common\Yii02::getNewPostList();
        //zhi($post_list);
        foreach ($post_list as $ps):
            ?>
            <ul>
                <li>
                    <a href="<?= Yii::$app->urlManager->createUrl(['post/view', 'id' => $ps['id']]) ?>"><?= $ps['title']; ?>
                    </a>
                </li>
            </ul>
        <?php endforeach; ?>
    </div>

    <div class="widget widget_recent_entries">
        <div class="title"><h2>热门文章</h2></div>
        <?php
        $hot_post = \common\Yii02::getHotPost();
        //zhi($post_list);
        foreach ($hot_post as $hp):
            ?>
            <ul>
                <li>
                    <div class="pull-left media-left">
                        <i class="glyphicon glyphicon-eye-open"><em><?= $hp['browser'] ?></em></a></i>
                    </div>
                    <div class="media-right">
                        <a href="<?= Yii::$app->urlManager->createUrl(['post/view', 'id' => $hp['id']]) ?>"><?= $hp['title']; ?>
                        </a>
                    </div>
                </li>
            </ul>
        <?php endforeach; ?>
    </div>
    <!--<div class="widget widget_archive">
        <div class="title"><h2>文章归档</h2></div>
        <ul>
            <li><a href='http://www.phpzhi.com/date/2017/02'>2017年二月</a></li>
            <li><a href='http://www.phpzhi.com/date/2016/12'>2016年十二月</a></li>
        </ul>
    </div>-->

    <div class="widget git_tag">
        <div class="title"><h2>热门标签</h2></div>

        <div class="git_tags">
            <?php $tags_list = \common\Yii02::getHotTag();
            foreach ($tags_list as $tag): ?>
                <a title="" target="_blank"
                   href="<?= Yii::$app->urlManager->createUrl(['post/index', 'tag' => $tag['tag_name']]) ?>">
                    <?= $tag['tag_name'] ?>
                </a>
            <?php endforeach; ?>
        </div>

        <!--<div class="widget git_social">
            <div class="widget widget_text">
                <div class="textwidget">
                    <div class="social">
                        <a href="http://weibo.com/panchaozhi" rel="external nofollow" title="新浪微博" target="_blank"><i class="sinaweibo fa fa-weibo"></i></a>
                        <a href="https://github.com/panchaozhigithub" rel="external nofollow" title="Git/Github" target="_blank"><i class="git fa fa-git"></i></a>
                        <a href="tencent://message/?uin=1099958338&Site=&Menu=yes " rel="external nofollow" title="联系QQ" target="_blank"><i class="qq fa fa-qq"></i></a>
                        <a href="http://www.phpzhi.com/feed/" rel="external nofollow" target="_blank" title="订阅本站"><i class="rss fa fa-rss"></i></a>
                    </div>
                </div>
            </div>
    </div>-->
        <div class="widget git_tongji">
            <div class="title"><h2>网站统计</h2></div>
            <div class="tongji">
                <ul>
                    <li>文章总数：<?= \common\models\Post::find()->count() ?> 篇</li>
                    <li>评论数目：<?= \common\models\Comment::find()->count() ?> 条</li>
                    <?php $update = \common\models\Post::find()->orderBy(['id' => SORT_ASC])->one(); ?>
                    <li>建站日期：<?= date("Y-m-d", $update['created_at']) ?></li>
                    <li>运行天数：93 天</li>
                    <li>标签总数：<?= \common\models\Tag::find()->count() ?> 个</li>
                    <li>草稿数目：0 篇</li>
                    <li>页面总数：0 个</li>
                    <li>分类总数：<?= \common\models\Category::find()->count() ?> 个</li>
                    <li>友链总数：0 个</li>
                    <li>用户总数：<?= \common\models\User::find()->count() ?> 个</li>
                    <?php $update = \common\models\Post::find()->orderBy(['id' => SORT_DESC])->one(); ?>
                    <li>最后更新：<?= date("Y-m-d", $update['updated_at']) ?></li>
                </ul>
            </div>
        </div>
</aside>