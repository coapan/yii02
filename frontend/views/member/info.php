<?php
/**
 * Created by PhpStorm.
 * User: PanChaoZhi
 * Date: 2017/2/1
 * Time: 18:15
 */
/** @var $model \frontend\controllers\MemberController */
/** @var $upload \frontend\models\UploadForm */
/** @var $info \frontend\models\UserInfoForm */
/** @var $user \frontend\controllers\MemberController */
/** @var $model \frontend\controllers\MemberController */
$this->title = "个人中心";
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use common\Yii02;

?>

<div class="main mb20">
    <div role="tabpanel" style="position: relative;">
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a
                    href="<?= Yii::$app->urlManager->createUrl('member/info') ?>">个人资料</a></li>
            <li role="presentation"><a href="<?= Yii::$app->urlManager->createUrl('member/collect') ?>">我的收藏</a></li>
            <li role="presentation"><a href="<?= Yii::$app->urlManager->createUrl('member/comment') ?>">我的评论</a></li>
            <li role="presentation"><a href="<?= Yii::$app->urlManager->createUrl('member/post') ?>">我发表的</a></li>
            <li role="presentation"><a href="<?= Yii::$app->urlManager->createUrl('member/message') ?>">我的消息</a></li>
        </ul>

        <!-- Tab panes-->
        <div class="tab-content pd20">
            <div role="tabpanel" class="tab-pane active" id="four">
                <div class="row">

                    <div class="col-xs-9">
                        <?php $form = ActiveForm::begin([
                            'id' => 'form-signup',
                            'options' => ['class' => 'form-horizontal'],
                            'fieldConfig' => [
                                'template' => "<div class=\"col-xs-3\">{label}</div><div class=\"col-xs-8\">{input}</div>\n{error}",
                            ],
                        ]); ?>
                        <hr>
                        <?= $form->field($info, 'nickname')->textInput(['value' => $model->nickname])->label("昵称") ?>
                        <?= $form->field($info, 'signature')->textInput(['value' => $model->signature])->label("签名") ?>
                        <?= $form->field($info, 'username')->textInput(['value' => $model->username, 'readOnly' => 'readOnly'])->label("用户名") ?>
                        <?= $form->field($info, 'email')->textInput(['value' => $model->email, 'readOnly' => 'readOnly'])->label("邮箱") ?>
                        <?= $form->field($info, 'password')->passwordInput(['placeholder' => '不填则使用原密码'])->label("密码") ?>
                        <?= $form->field($info, 'rePassword')->passwordInput(['placeholder' => '重复密码不一样依旧使用原密码'])->label("重复密码") ?>

                        <div class="form-group">
                            <div class="col-xs-8 col-xs-offset-3">
                                <?= Html::submitButton('更新', ['class' => 'btn btn-block btn-primary']) ?>
                            </div>
                        </div>
                        <?php ActiveForm::end() ?>
                    </div>

                    <div class="col-xs-12">
                        <center><img id="cirphoto" src="<?= Yii::$app->urlManager->baseUrl . '/' . $user['avatar'] ?>"
                                     alt="<?= $user['username'] ?>" width="200" height="200"></center>
                        <hr>
                        <?php $form = ActiveForm::begin([
                            'options' => [
                                'enctype' => 'multipart/form-data',
                            ],
                        ]) ?>
                        <div class="form-group">
                            <p class="help-block">图片大小建议200px*200px.</p>
                        </div>
                        <?= $form->field($upload, 'file')->fileInput()->label(false) ?>
                        <div class="form-group">
                            <div class="col-xs-8">
                                <?= Html::submitButton("上传", ['class' => 'btn btn-primary btn-block']) ?>
                            </div>
                        </div>
                        <?php ActiveForm::end(); ?>
                    </div>

                    <div class="col-xs-3">
                        <div id="floatbox">


                            <?php if (Yii::$app->user->id) : ?>
                                <div class="sidebar pd20 mb20 sideb">

                                    <ul class="list-unstyled mt20">
                                        <li><span class="glyphicon glyphicon-gift"></span> 收藏 <a
                                                href="<?= Yii::$app->urlManager->createUrl("member/collect") ?>"><?= Yii02::getCollectPostNum(Yii::$app->user->id) ?></a>
                                        </li>
                                        <li><span class="glyphicon glyphicon-bell"></span> 帖子：<a
                                                href="<?= Yii::$app->urlManager->createUrl("member/topic") ?>"><?= Yii02::getUserPostNum(Yii::$app->user->id) ?></a>
                                        </li>
                                        <li><span class="glyphicon glyphicon-comment"></span>
                                            评论：<a
                                                href="<?= Yii::$app->urlManager->createUrl("member/comment") ?>"> <?= Yii02::getUserComments(Yii::$app->user->id) ?></a>
                                        </li>
                                        <li>
                                            <span class="glyphicon glyphicon-calendar"></span>
                                            总签到：<?= Yii02::getUserInfo('total_signin') ?>
                                            次
                                            <ul>
                                                <li>最大连续签到：<?= Yii02::getUserInfo('max_signin') ?>天</li>
                                                <li>目前连续签到：<?= Yii02::getUserInfo('current_signin') ?>天</li>
                                            </ul>
                                        </li>
                                        <li><span class="glyphicon glyphicon-dashboard"></span>
                                            总在线时间：<?= sprintf("%.2f", Yii02::getUserInfo('online_time') / 60) ?>小时
                                        </li>
                                        <li><span class="glyphicon glyphicon-time"></span>
                                            注册时间：<?= date("Y-m-d H:i:s", Yii02::getUserInfo('created_at')) ?></li>
                                        <li><span class="glyphicon glyphicon-hourglass"></span>
                                            上次登录：<?= date("Y-m-d H:i:s", Yii02::getUserInfo('updated_at')) ?></li>
                                    </ul>
                                    <?php if(Yii02::getUserInfo('signin_time') != date("Ymd")):?>
                                        <?php //zhi(Yii02::getUserInfo('signin_time'));zhi(date("Ymd"))?>
                                        <button class="btn btn-info btn-block signin" type="button">
                                            <span>马 上 签 到</span>
                                        </button>
                                    <?php else: ?>
                                        <button class="btn btn-danger btn-block" type="button">
                                            <span>今 日 已 签 到</span>
                                        </button>
                                    <?php endif?>


                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
