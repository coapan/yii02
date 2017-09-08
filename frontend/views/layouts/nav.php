<?php
/**
 * Created by PhpStorm.
 * User: PanChaoZhi
 * Date: 2017/1/31
 * Time: 9:56
 */

use common\Yii02;

?>
<div class="container">
    <div class="navbar-header">
        <div class="row">

            <div class="col-md-9">

                <div class="pull-right" style="margin-top: 21px;">
                    <form method="get"
                          onsubmit="location.href='<?= Yii::$app->urlManager->createUrl(['search/index', 'q' => '']); ?>' + encodeURIComponent(this.s.value).replace(/%20/g, '+'); return false;"
                          action="/">
                        <div class="form-group">
                            <input type="text" class="form-control search-input1" name="s"
                                   onblur="if(this.value=='')this.value='搜索链接、帖子或图片';"
                                   onfocus="if(this.value=='搜索链接、帖子或图片')this.value='';" value="搜索链接、帖子或图片">
                            <button type="submit" class="btn btn-default pull-left"><i
                                    class="glyphicon glyphicon-search"> </i></button>
                        </div>
                    </form>
                    <form class="form-inline" action="<?= Yii::$app->urlManager->createUrl(['post/index']);?>" id="w0" method="get">
                        <div class="form-group">
                            <input type="text" class="form-control" name="PostSearch[title]" id="w0input" placeholder="按标题">
                        </div>
                        <button type="submit" class="btn btn-default">搜索</button>
                    </form>
                </div>
            </div>
        </div>

        <?php if(Yii::$app->user->isGuest):?>
        <div class="col-md-3">

            <a class=" pull-right" href="" data-toggle="modal" data-target="#myModal" style="margin: 5px;">登录/注册</a>

            <div class="clearfix"></div>
            <div class="pull-right">
                <img id="cirphoto" class="portrait" src="<?=Yii::$app->urlManager->baseUrl?>/img/wm.jpg" />
            </div>
            <div class="pull-right userinfos">
                <p  style="margin:0;font-size:15px;font-weight:bold" class="text-right" style="margin-top:5px;font-size:16px;font-weight: bold;">无名</p  ><div class="clearfix"></div>
                <p   style="margin:0;color:#888" class="text-right"> 认真你就赢了</p>
            </div>

        </div>
        <?php endif;?>
        <?php if(!Yii::$app->user->isGuest):?>
            <div class="col-md-3">
                <div class="pull-right" >
                    <a href="<?=Yii::$app->urlManager->createUrl("member/info")?>">
                        <img id="cirphoto" class="portrait" src="<?=Yii::$app->urlManager->baseUrl.'/'.Yii02::getUserInfo("img")?>" />
                    </a>
                </div>
                <div class="pull-right userinfos">
                    <p  style="margin:0;font-size:15px;font-weight:bold" class="text-right" style="margin-top:5px;font-size:16px;font-weight: bold;"><?=Yii02::getUserInfo("nickname")?></p  ><div class="clearfix"></div>
                    <p   style="margin:0;color:#888" class="text-right"> <?=Yii02::getUserInfo("signature")?></p>
                </div>
                <div class="clearfix"></div>
                <a href="<?=Yii::$app->urlManager->createUrl("site/logout")?>" class="pull-right btn btn-primary btn-xs" style="margin-right:5px;margin-top:10px">退出登陆</a>
            </div>

        <?php endif; ?>

        <div class="container">
            <div class="navbar navbar-inverse">

                <div class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        <li class="glyphicon-home"><a
                                href="<?= Yii::$app->urlManager->createUrl(['site/index']) ?>">首页</a></li>
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
                        <li><a href="<?= Yii::$app->urlManager->createUrl(['list/index']) ?>">更多>></a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
