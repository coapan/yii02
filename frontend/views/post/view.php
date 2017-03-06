<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yidashi\markdown\Markdown;

/* @var $this yii\web\View */
/*   @var $model common\models\Post */
/*  @var $data \frontend\controllers\PostController */
/* @var $browser \frontend\controllers\PostController */
/* @var $comment \common\models\Comment */
/* @var $uid \frontend\controllers\PostController */

$this->title = $data['title'];
$this->params['breadcrumbs'][] = ['label' => '文章', 'url' => ['post/index1']];
$this->params['breadcrumbs'][] = '详情';

$this->registerMetaTag(["name" => "keywords", "content" => "{$data['keywords']}"]);
$this->registerMetaTag(["name" => "description", "content" => "{$data['content']}"]);
?>

<?php //zhi($data);exit;?>

<section class="container">
    <div class="content-wrap">
        <div class="content">
            <header class="article-header">
                <h1 class="article-title"><?= $data['title'] ?></h1>
                <div class="meta">
                    <span id="mute-category" class="muted"><i class="fa fa-list-alt"></i><a
                                href="<?= Yii::$app->urlManager->createUrl(['post/index', 'cid' => $data['cate']['id']]) ?>"> <?= $data['cate']['name'] ?></a></span> <span
                            class="muted"><i
                                class="fa fa-user"></i> <a
                                href="<?= Yii::$app->urlManager->createUrl(['member/info', 'id' => $data['user']['id']]) ?>"><?= $data['user_name'] ?></a></span>


                    <time class="muted"><i class="fa fa-clock-o"></i> <?= date('Y-m-d H:i:s', $data['created_at']) ?>
                    </time>
                    <span class="muted"><i class="fa fa-eye"></i> <?= \common\Yii02::getBrowser($data['id']) ?>
                        次浏览</span>
                    <span class="muted"><i class="fa fa-comments-o"></i> <a
                                href="<?= Yii::$app->urlManager->createUrl(['post/view', 'id' => $data['id']])?>#comment"><?= \common\Yii02::getComment($data['id']) ?>
                            个评论</a></span>
                </div>
            </header>
            <article class="article-content">

                <?= $data['content'] ?>

                <hr/>

                <div align="center" class="open-message"><i class="fa fa-bullhorn"></i>本站文章均为原创，如有转载，请注明出处 <a
                            href="<?= Yii::$app->urlManager->baseUrl;?>" target="_blank" title="<?= $data['title']?>"><?= Yii::$app->urlManager->baseUrl.$data['id'].'.'.'html';?></a>！
                </div>


                <!--<div class="article-social">
                    <a href="javascript:;" data-action="ding" data-id="62" id="Addlike" class="action"><i
                                class="fa fa-heart-o"></i>喜欢 (<span class="count">0</span>)</a><span class="or">
                        <style>.article-social .weixin:hover {
                                background: #fff;
                            }
                        </style>
                        <a class="weixin" style="border-bottom:0px;font-size:15pt;cursor:pointer;">赏<div
                                    class="weixin-popover">
                                <div class="popover bottom in">
                                    <div class="arrow"></div>
                                    <div class="popover-title"><center>支付宝[]</center></div>
                                    <div class="popover-content">
                                        <img width="200px" height="200px" src=""></div>
                                </div>
                            </div>
                        </a>
                    </span>
                    <span class="action action-share bdsharebuttonbox"><i class="fa fa-share-alt"></i>分享 (<span class="bds_count" data-cmd="count" title="累计分享0次">0</span>)<div class="action-popover">
                            <div class="popover top in">
                                <div class="arrow"></div>
                                <div class="popover-content">
                                    <a href="#" class="sinaweibo fa fa-weibo" data-cmd="tsina" title="分享到新浪微博"></a>
                                    <a href="#" class="bds_qzone fa fa-star" data-cmd="qzone" title="分享到QQ空间"></a>
                                    <a href="#" class="tencentweibo fa fa-tencent-weibo" data-cmd="tqq" title="分享到腾讯微博"></a>
                                    <a href="#" class="qq fa fa-qq" data-cmd="sqq" title="分享到QQ好友"></a>
                                    <a href="#" class="bds_renren fa fa-renren" data-cmd="renren" title="分享到人人网"></a>
                                    <a href="#" class="bds_weixin fa fa-weixin" data-cmd="weixin" title="分享到微信"></a>
                                    <a href="#" class="bds_more fa fa-ellipsis-h" data-cmd="more"></a>
                                </div>
                            </div>
                        </div>
                    </span>
                </div>-->
            </article>

            <footer class="article-footer">

                <div class="article-tags">
                    <i class="fa fa-tags"></i>
                    <?php foreach ($data['tags'] as $tag): ?>
                        <a href="<?= Yii::$app->urlManager->createUrl(['post/index1', 'PostSearch[tag]' => $tag]) ?>"
                           rel="tag"><?= $tag; ?></a>
                    <?php endforeach; ?>
                </div>
            </footer>


            <div id="donatecoffee" style="overflow:auto;display:none;"><img width="400px" height="400px" src=""></div>


            <!--<div class="related_top">
                <div class="related_posts">
                    <ul class="related_img">
                        <li class="related_box">
                            <a href="http://www.phpzhi.com/29.html" title="推荐一款非常不错的编辑器——SublimeText3" target="_blank">
                                <img width="185px" height="110px"
                                     src="http://www.phpzhi.com/wp-content/themes/Git-master/timthumb.php?src=http://www.phpzhi.com/wp-content/uploads/2016/12/2016121113262074.png&h=110&w=185&q=90&zc=1&ct=1"
                                     alt="推荐一款非常不错的编辑器——SublimeText3"/>
                                <br>
                                <span class="r_title">推荐一款非常不错的编辑器——SublimeText3</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>-->
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

        <div class="widget git_tag">
            <div class="title"><h2>热门标签</h2></div>

            <div class="git_tags">
                <?php $tags_list = \common\Yii02::getHotTag();
                foreach ($tags_list as $tag): ?>
                    <a title="" target="_blank"
                       href="<?= Yii::$app->urlManager->createUrl(['post/index1', 'tag' => $tag['tag_name']]) ?>">
                        <?= $tag['tag_name'] ?>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
    </aside>

    <?php if (Yii::$app->user->isGuest): ?>
    <div class="col-lg-12">
        <div class="panel">
            <div class="tab-content">
                <div id="comment-content">
                    <div class="main">
                        <?php \yii\bootstrap\Alert::begin([
                            'options' => [
                                'class' => 'alert-warning',
                            ],
                        ]);
                        echo "<center><h1>登录才能评论哦~</h1></center>";

                        \yii\bootstrap\Alert::end();
                        ?>
                    </div>
                </div>
            </div>
            <?php else: ?>
                <div class="col-lg-12">
                    <div class="panel">
                        <div class="tab-content">
                            <div id="comment-content" style="width: 770px">
                                <div class="main">
                                    <?php if (!empty($comment)): ?>
                                        <h5>共<?= \common\models\Post::getCommentCount($data['id']) . '条评论'; ?></h5>
                                        <?php //zhi($comment)*/?>
                                        <?= \common\Yii02::traverseArray($comment, $uid);
                                        ?>
                                    <?php else: ?>
                                        <?php \yii\bootstrap\Alert::begin([
                                            'options' => [
                                                'class' => 'alert-warning',
                                            ],
                                        ]);
                                        echo "<center><h1>暂无评论~</h1></center>";

                                        \yii\bootstrap\Alert::end();
                                        ?>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="panel">
                                <a href="javascript:;" name="comment"></a>
                                <?php $form = \yii\widgets\ActiveForm::begin([
                                    'id' => 'comment-form',
                                    'options' => ['width' => '770px'],
                                ]) ?>
                                <script id="container" name="CommentForm[content]"></script>
                                <?= $form->field(new \frontend\models\CommentForm(), 'post_id')->hiddenInput(['value' => $data['id']])->label(false) ?>
                                <div class="form-group" style="width: 770px">
                                    <div class="row">
                                        <div class="col-xs-2 col-xs-offset-10">
                                            <?= Html::button("提交", ['class' => 'btn btn-success btn-block', 'id' => 'comment-btn']) ?>
                                        </div>

                                    </div>
                                </div>
                                <?php \yii\widgets\ActiveForm::end() ?>
                            </div>

                        </div>
                    </div>
                </div>
            <?php endif;
            ?>

        </div>
    </div>
</section>

<?php $this->registerJsFile("@web/ueditor/ueditor.config.js"); ?>
<?php $this->registerJsFile("@web/ueditor/ueditor.all.min.js"); ?>
<?php
$script = <<<UM
jQuery(document).ready(function($) {
    var ue = UE.getEditor('container', {
        toolbars: [
            ['fullscreen', 'bold','italic','forecolor','underline','strikethrough','justifyleft','justifyright','justifycenter','insertunorderedlist','insertorderedlist', 'spechars', 'emotion','insertimage','insertvideo','music','insertcode','fontfamily', ]
        ],
        initialFrameHeight:150,
        initialFrameWidth:760
    });
    ue.ready(function() {
        //设置编辑器的内容
      //  ue.setContent('请输入评论内容');
    });
});
UM;
$this->registerJs($script);
?>
