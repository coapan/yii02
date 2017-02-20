<?php
/**
 * Created by PhpStorm.
 * User: PanChaoZhi
 * Date: 2017/1/31
 * Time: 17:13
 */

/** @var $cate \frontend\widgets\topbar\TopBarWidget */
?>
<div class="container">
    <div class="navbar navbar-inverse">
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li class="glyphicon-home"><a href="<?= Yii::$app->urlManager->createUrl(['site/index']) ?>">首页</a> </li>
                <li><span class="separator">|</span> </li>
                <?php foreach ($cate as $value):?>
                <li class="dropdown">
                    <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><?= $value['name']?><b class="caret"></b> </a>
                    <ul class="dropdown-menu">
                        <?php foreach ($value['categories'] as $v):?>
                        <li>
                            <a href="<?= Yii::$app->urlManager->createUrl(['post/index', 'cid' => $v['id']]) ?>"><?= $v['name'] ?></a>
                        </li>
                        <?php endforeach;?>
                    </ul>
                </li>

                <?php endforeach;?>
                <li><a href="<?= Yii::$app->urlManager->createUrl(['list/index']) ?>">更多>></a> </li>
            </ul>
        </div>
    </div>
</div>
<div class="clearfix"></div>