<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => '管理后台',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    $menuItems1 = [];
    $menuItems2 = [];
    $menuItems1[] = ['label' => '文章管理', 'url' => ['/post']];
    $menuItems1[] = ['label' => '评论管理', 'url' => ['/comment']];
    $menuItems1[] = ['label' => '黑名单', 'url' => ['/blacklist']];
    $menuItems1[] = ['label' => '单页管理', 'url' => ['/page']];
    $menuItems1[] = ['label' => '分类管理', 'url' => ['/category']];
    $menuItems1[] = ['label' => '用户管理', 'url' => ['/user']];
    $menuItems1[] = ['label' => '字段设置', 'url' => ['/setting']];

    if (Yii::$app->user->can("manage_permissions")) {
        $menuItems1[] = ['label' => '权限管理', 'url' => ['/admin']];
    }
    if (!Yii::$app->user->isGuest) {
        $menuItems2[] = ['label' => '网站首页', 'url' => 'index.php'];
        $menuItems2[] = [
            'label' => 'Logout(' . Yii::$app->user->identity->username . ')',
            'url' => ['/site/logout'],
            'linkOptions' => ['data-method' => 'post'],
        ];
    }
    $menuItems = [
        ['label' => 'Home', 'url' => ['/site/index']],
    ];
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
    } else {
        $menuItems[] = '<li>'
            . Html::beginForm(['/site/logout'], 'post')
            . Html::submitButton(
                'Logout (' . Yii::$app->user->identity->username . ')',
                ['class' => 'btn btn-link']
            )
            . Html::endForm()
            . '</li>';
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-left'],
        'items' => $menuItems1,
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems2,
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>

        <!--<div class="row">
            <div class="col-md-2">
                <div class="list-group">
                    <a href="#" class="list-group-item">主页</a>
                    <a href="#nav1" class="list-group-item collapsed" data-toggle="collapse">权限管理<b class="caret"></b> </a>
                    <div id="nav1" class="submenu panel-collapse collapse">
                        <a class="list-group-item" href="#">添加节点</a>
                        <a class="list-group-item" href="#">添加用户组</a>
                        <a class="list-group-item" href="#">添加用户</a>
                        <a class="list-group-item" href="#">编辑用户</a>
                    </div>
                    <a href="#" class="list-group-item">分类管理</a>
                    <a href="#" class="list-group-item">文章管理</a>
                    <a href="#" class="list-group-item">用户管理</a>
                    <a href="#" class="list-group-item">系统管理</a>
                </div>
            </div>
        </div>-->
        <?//= Alert::widget() ?>
        <div class="col-md-12">
            <?= $content ?>
        </div>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

        <p class="pull-right">Powered By <a href="https://www.phpzhi.com" target="_blank">PHPZHI.COM</a></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
