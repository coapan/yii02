<?php
/**
 * Created by PhpStorm.
 * User: PanChaoZhi
 * Date: 2017/2/9
 * Time: 8:18
 */
/** @var $model \common\models\Page */
$this->title = $model['title'];
$this->registerMetaTag(['name' => 'keywords', 'content' => "{$model['keywords']}"]);
$this->registerMetaTag(['name' => 'description', 'content' => "{$model['description']}"]);
?>

<div class="main pd20">
    <div class="media-body">
        <div class="row">
            <div class="col-xs-3">
                <div class="list-group">
                    <a href="#" class="list-group-item disabled"><h4><span
                                class="glyphicon glyphicon-map-marker"></span> 使用者注意</h4></a>
                    <a href="<?= Yii::$app->urlManager->createUrl(['page/index', 'name' => 'about']) ?>"
                       class="list-group-item <?php if ($name == "about"): ?>active <?php endif; ?>">关于博客</a>
                    <a href="<?= Yii::$app->urlManager->createUrl(['page/index', 'name' => 'guide']) ?>"
                       class="list-group-item <?php if ($name == "guide"): ?>active <?php endif; ?>">使用指南</a>
                    <a href="<?= Yii::$app->urlManager->createUrl(['page/index', 'name' => 'policy']) ?>"
                       class="list-group-item <?php if ($name == "policy"): ?>active <?php endif; ?>">隐私措施</a>
                    <a href="<?= Yii::$app->urlManager->createUrl(['page/index', 'name' => 'statement']) ?>"
                       class="list-group-item <?php if ($name == "statement"): ?>active <?php endif; ?>">免责声明</a>
                    <a href="<?= Yii::$app->urlManager->createUrl(['page/index', 'name' => 'advice']) ?>"
                       class="list-group-item <?php if ($name == "advice"): ?>active <?php endif; ?>">建议反馈</a>
                    <a href="<?= Yii::$app->urlManager->createUrl(['page/index', 'name' => 'contact']) ?>"
                       class="list-group-item <?php if ($name == "contact"): ?>active <?php endif; ?>">联系我们</a>
                </div>
            </div>

            <div class="col-xs-9">
                <h4><?= $model['title']; ?></h4>
                <div class="text-justify">
                    <?= $model['content']; ?>
                </div>
            </div>
        </div>
    </div>
</div>
