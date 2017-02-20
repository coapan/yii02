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
<div class="panel">
    <div class="panel-title box-title">
        <span><b><?= $data['title'] ?></b></span>
        <?php if ($this->context->more): ?>
            <span class="pull-right"><a href="<?= $data['more'] ?>" class="font-12">更多>></a> </span>
        <?php endif; ?>
    </div>

    <div class="new-list">
        <?php foreach ($data['body'] as $list): ?>
            <div class="panel-body border-bottom">
                <div class="row">
                    <div class="col-lg-4 label-img-size">
                        <a href="#" class="post-label">
                            <img
                                src="<?= ($list['label_img'] ? $list['label_img'] : \Yii::$app->params['default_label_img']) ?>"
                                alt="<?= $list['title'] ?>">
                        </a>
                    </div>

                    <div class="col-lg-8 btn-group">
                        <h1>
                            <a href="<?= \yii\helpers\Url::to(['post/view', 'id' => $list['id']]) ?>"><?= $list['title'] ?></a>
                        </h1>
                        <span class="post-tags">
                        <span class="glyphicon glyphicon-user"></span>
                        <a href="<?= \yii\helpers\Url::to(['member/info', 'id' => $list['user_id']]) ?>"><?= $list['user_name'] ?></a>&nbsp;
                        <span class="glyphicon glyphicon-time"></span>
                            <?= date('Y-m-d', $list['created_at']) ?>&nbsp;
                        <span class="glyphicon glyphicon-eye-open"></span>
                            <?= \common\Yii02::getBrowser($list['id']) ?>次&nbsp;
                        <span class="glyphicon glyphicon-comment"></span>
                            <?= \common\Yii02::getComment($list['id']) ?>次
                        <a href="javascript:;" class="collect"><span class="glyphicon glyphicon-heart-empty"></span><em>收藏</em><i style="display: none;"><?= $list['id']?></i> </a>
                    </span>

                        <p class="post_content"><?= $list['summary'] ?></p>
                        <a href="<?= \yii\helpers\Url::to(['post/view', 'id' => $list['id']]) ?>">
                            <button class="btn btn-warning no-radius btn-sm pull-right">阅读全文</button>
                        </a>
                    </div>
                </div>

                <div class="tags">
                    <?php if (!empty($list['tags'])): ?>
                        <span class="fa fa-tags"></span>
                        <?php foreach ($list['tags'] as $tag): ?>
                            <a href="#"><?= $tag ?></a>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <?php if ($this->context->page): ?>
        <div class="page">
            <?= \yii\widgets\LinkPager::widget([
                'pagination' => $data['page'],
            ]); ?>
        </div>
    <?php endif; ?>
</div>