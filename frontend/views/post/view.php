<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yidashi\markdown\Markdown;

/* @var $this yii\web\View */
/* @var $model common\models\Post */
/* @var $data \frontend\controllers\PostController */
/* @var $browser \frontend\controllers\PostController */
/* @var $comment \common\models\Comment */
/* @var $uid \frontend\controllers\PostController */

$this->title = $data['title'];
$this->params['breadcrumbs'][] = ['label' => '文章', 'url' => ['post/index1']];
$this->params['breadcrumbs'][] = '详情';

$this->registerMetaTag(["name" => "keywords", "content" => "{$data['keywords']}"]);
$this->registerMetaTag(["name" => "description", "content" => "{$data['content']}"]);
?>
    <div class="row">
        <div class="col-lg-9">
            <div class="page-title">
                <h1><?= $data['title'] ?></h1>
                <span class="post-tags">
                <span>分类：<?= $data['cate']['name'] ?></span>
                <span>作者：<?= $data['user_name'] ?></span>
                <span>发布于：<?= date('Y-m-d H:i:s', $data['created_at']) ?></span>
                <span>浏览：<?= \common\Yii02::getBrowser($data['id']) ?></span>
                <a href="javascript:;" class="collect"><span
                        class="glyphicon glyphicon-heart-empty"></span><em>收藏</em><i
                        style="display: none;"><?= $data['id'] ?></i> </a>
                </span>
            </div>

            <div class="page-content">
                <?= $data['content'] ?>
            </div>

            <div class="tags">
                标签：
                <?php if (is_array($data['tags'])): ?>
                    <?php foreach ($data['tags'] as $tag): ?>
                        <span><a href="#"><?= $tag ?></a> </span>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>

        <div class="col-lg-3">
            <div class="panel">
                <?php if (!Yii::$app->user->isGuest): ?>
                    <a class="btn btn-success btn-block btn-post"
                       href="<?= \yii\helpers\Url::to(['post/create']) ?>"><i class="glyphicon glyphicon-pencil"></i>
                        创建文章</a>
                    <?php if (\Yii::$app->user->identity->id == $data['user_id']): ?>
                        <a class="btn btn-info btn-block btn-post"
                           href="<?= \yii\helpers\Url::to(['post/update', 'id' => $data['id']]) ?>">编辑文章</a>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        </div>

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

                            \yii\bootstrap\Alert::end(); ?>
                        </div>
                    </div>
                </div>
                <?php else: ?>
                    <div class="col-lg-12">
                        <div class="panel">
                            <div class="tab-content">
                                <div id="comment-content">
                                    <div class="main">
                                        <?php if (!empty($comment)): ?>
                                            <? //php zhi($comment)?>
                                            <?= \common\Yii02::traverseArray($comment, $uid); ?>
                                        <?php else: ?>
                                            <?php \yii\bootstrap\Alert::begin([
                                                'options' => [
                                                    'class' => 'alert-warning',
                                                ],
                                            ]);
                                            echo "<center><h1>暂无评论~</h1></center>";

                                            \yii\bootstrap\Alert::end();; ?>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="panel">
                                    <a href="javascript:;" name="comment"></a>
                                    <?php $form = \yii\widgets\ActiveForm::begin([
                                        'id' => 'comment-form',
                                    ]) ?>
                                    <script id="container" name="CommentForm[content]"></script>
                                    <?= $form->field(new \frontend\models\CommentForm(), 'post_id')->hiddenInput(['value' => $data['id']])->label(false) ?>
                                    <div class="form-group">
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
                <?php endif; ?>

            </div>
        </div>
    </div>

<?php $this->registerJsFile("@web/ueditor/ueditor.config.js"); ?>
<?php $this->registerJsFile("@web/ueditor/ueditor.all.min.js"); ?>
<?php
$script = <<<UM
jQuery(document).ready(function($) {
    var ue = UE.getEditor('container', {
        toolbars: [
            ['fullscreen', 'bold','italic','forecolor','underline','strikethrough','justifyleft','justifyright','justifycenter','insertunorderedlist','insertorderedlist', 'spechars', 'emotion','insertimage','insertvideo','music','insertcode','fontfamily', ]
        ],
        initialFrameHeight:150
    });
    ue.ready(function() {
        //设置编辑器的内容
      //  ue.setContent('请输入评论内容');
    });
});

UM;
$this->registerJs($script);
?>