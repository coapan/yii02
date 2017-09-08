<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use common\models\User;

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
    <script>
        var comment_url = "<?= Yii::$app->urlManager->createUrl("comment/comment") ?>";
        var comment_report_url = "<?= Yii::$app->urlManager->createUrl("comment/report") ?>";
        var replay_url = "<?= Yii::$app->urlManager->createUrl("comment/replay") ?>";
        var signin_url = "<?= Yii::$app->urlManager->createUrl("ajax/signin") ?>";
        var collect_url = "<?= Yii::$app->urlManager->createUrl("ajax/collect") ?>";
        var read_url = "<?= Yii::$app->urlManager->createUrl("ajax/read") ?>";
    </script>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">

    <?php //$this->beginContent('@app/views/layouts/nav.php');?>
    <?php //$this->endContent();?>

    <?php
    NavBar::begin([
        'brandLabel' => 'PhpZhi',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    $leftMenus = [
        //
    ];
    ?>
    <ul class="nav navbar-nav navbar-left">
        <li class="active">
            <a href="<?= Yii::$app->homeUrl ?>"><i class="fa fa-home"></i> 首页</a></li>
        <li><span class="separator">|</span></li>
        <?php $cate = \common\models\CategoryGroup::find()->joinWith('categories')->where('category_group.sort >:threshold', [':threshold' => 99])->orderBy(['category_group.sort' => SORT_DESC])->asArray()->all(); ?>
        <?php foreach ($cate as $v): ?>
            <li class="dropdown">
                <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown"
                   aria-expanded="false"><?= $v['name'] ?><b class="caret"></b></a>
                <ul class="dropdown-menu">
                    <?php foreach ($v['categories'] as $vv): ?>
                        <li>
                            <a href="<?= Yii::$app->urlManager->createUrl(['post/index', 'cid' => $vv['id']]) ?>"><?= $vv['name'] ?></a>
                        </li>
                    <?php endforeach ?>
                </ul>
            </li>

        <?php endforeach ?>
        <!-- <li><a href="<?= Yii::$app->urlManager->createUrl(['list/index']) ?>">更多>></a></li> -->

        <div class="navbar-nav navbar-right">
            <?php
/*            $form = \yii\widgets\ActiveForm::begin([
                'method' => 'get',
                'action' => ['search/index', 'q'=>''],
                'options' => [
                    'class' => 'navbar-form navbar-right',
                    'role' => "search"
                ]
            ]); */?><!--
            <input type="text" class="form-control" id="navbar-search-input"
                   value="<?/*= isset($this->params['keyword']) ? $this->params['keyword'] : '' */?>" placeholder="输入关键字搜索"
                   name="keyword"/>
            <!--<span class="input-group-btn"><button type="submit" class="btn btn-default"><span class="fa fa-search"></span></button></span>-->

            <?php /*\yii\widgets\ActiveForm::end(); */?>

            <div class="navbar-form navbar-right-form">
            <form method="get" onsubmit="location.href='<?=Yii::$app->urlManager->createUrl(['search/index','q'=>'']);?>' + encodeURIComponent(this.s.value).replace(/%20/g, '+'); return false;" action="/">
                <div class="form-group">
                    <input   type="text" class="form-control" name="s" onblur="if(this.value=='')this.value='搜索文章 按回车提交';" onfocus="if(this.value=='搜索文章 按回车提交')this.value='';" value="搜索文章 按回车提交">
                </div>
            </form>
            </div>
        </div>
    </ul>

    <?php
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-left'],
        'items' => $leftMenus,
    ]);

    if (Yii::$app->user->isGuest) {
        /*$rightMenus[] = ['label' => '注册', 'url' => ['/site/signup']];
        $rightMenus[] = ['label' => '登录', 'url' => ['/site/login']];*/
        ?>
        &nbsp;
        &nbsp;
        <a class="navbar-right" href="" data-toggle="modal" data-target="#myModal" style="margin: 14px;">登录/注册</a>
        <div class="clearfix"></div>
        <?php
    } else {
        $user = User::findOne(Yii::$app->user->id);
        $rightMenus[] = [
            'label' => '<img src="' . Yii::$app->urlManager->baseUrl . '/' . $user->avatar . '" alt="' . Yii::$app->user->identity->username . '">',
            'linkOptions' => ['class' => 'avatar'],
            'items' => [
                ['label' => '<i class="fa fa-user"></i> 个人中心', 'url' => ['/member/info'], 'linkOptions' => ['data-method' => 'post']],
                ['label' => '<i class="fa fa-star"></i> 我的收藏', 'url' => ['/member/collect'], 'linkOptions' => ['data-method' => 'post']],
                ['label' => '<i class="fa fa-sign-out"></i> 退出登录', 'url' => ['/site/logout'], 'linkOptions' => ['data-method' => 'post']],
            ]
        ];

        echo Nav::widget([
            'options' => ['class' => 'navbar-nav navbar-right'],
            //关掉编码，否则会造成只是显示代码，并不会显示出你想要的效果
            'encodeLabels' => false,
            'items' => $rightMenus,
        ]);
    }
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<!-- footer begin-->
<?php $this->beginContent('@app/views/layouts/footer.php'); ?>
<?php $this->endContent(); ?>
<!-- footer end-->

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
