<?php
use common\models\LoginForm;
use frontend\models\Anonymous;
use frontend\models\ReportForm;
use frontend\models\SignupForm;
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\bootstrap\Modal;

?>
    <!-- 登录/注册模态框 -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h2 class="modal-title" id="myModalLabel">快速融入我们：</h2>
                </div>
                <div class="modal-body container-fluid">
                    <div class="row">
                        <!-- register begin-->
                        <div class="col-xs-6">
                            <div class="pd20">
                                <h3 class="text-success">快速注册：</h3>
                                <hr>
                                <?php $form = ActiveForm::begin([
                                    'action' => Yii::$app->urlManager->createUrl('site/signup'),
                                    'id' => 'form-signup',
                                    'options' => ['class' => 'form-horizontal'],
                                    'fieldConfig' => [
                                        'template' => "<div class=\"col-xs-1\"></div><div class=\"col-xs-3\">{label}</div><div class=\"col-xs-8\">{input}</div>\n<div class=\"col-xs-4\"></div>{error}",
                                    ],
                                ]); ?>
                                <?= $form->field(new SignupForm(), 'username')->label("用户名") ?>
                                <?= $form->field(new SignupForm(), 'email')->label("邮箱") ?>
                                <?= $form->field(new SignupForm(), 'password')->passwordInput()->label("密码") ?>
                                <?= $form->field(new SignupForm(), 'rePassword')->passwordInput()->label("重复密码") ?>
                                <div class="form-group">
                                    <div class="col-sm-offset-4 col-sm-8">
                                        <?= Html::submitButton('<span class="glyphicon glyphicon-check"></span> 注册账号', ['class' => 'btn btn-block btn-success ', 'name' => 'signup-button']) ?>
                                    </div>
                                </div>
                                <?php ActiveForm::end(); ?>
                            </div>
                        </div>
                        <!--register end-->

                        <div class="col-xs-6">
                            <div class="pd20">
                                <h3 class="text-primary">快速登录：</h3>
                                <hr>
                                <?php $form = ActiveForm::begin([
                                    'action' => Yii::$app->urlManager->createUrl('site/login'),
                                    'id' => 'form-login',
                                    'options' => ['class' => 'form-horizontal'],
                                    'fieldConfig' => [
                                        'template' => "<div class=\"col-xs-1\"></div><div class=\"col-xs-3\">{label}</div><div class=\"col-xs-8\">{input}</div>\n<div class=\"col-xs-4\"></div>{error}",
                                    ],
                                ]); ?>
                                <?= $form->field(new \frontend\models\LoginForm(), 'username')->label("用户名") ?>
                                <?= $form->field(new \frontend\models\LoginForm(), 'password')->passwordInput()->label("密码") ?>
                                <?= $form->field(new \frontend\models\LoginForm(), 'rememberMe')->checkbox() ?>
                                <div style="color:#999;margin:2em 0" align="center">
                                    忘记密码了？点击 <?= Html::a('重置密码', ['site/request-password-reset']) ?>.
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-4 col-sm-8">
                                        <?= Html::submitButton('<span class="glyphicon glyphicon-log-in"></span> 登 录', ['class' => 'btn btn-block btn-primary', 'name' => 'login-button']) ?>
                                    </div>
                                </div>
                                <?php ActiveForm::end(); ?>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger btn-xs" data-dismiss="modal"><span
                            class="glyphicon glyphicon-remove-circle"></span> 关 闭
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!--举报-->

    <!-- Modal -->
    <div class="modal fade" id="reportCommentModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">评论举报理由</h4>

                    <p>注意：恶意举报将被永久封号</p>
                </div>
                <?php $form = ActiveForm::begin([
                    'action' => Yii::$app->urlManager->createUrl('comment/report'),
                    'id' => 'report-comment-form',
                    'options' => ['class' => 'form-horizontal'],
                ]); ?>
                <div class="modal-body" style="padding:0 20px;">
                    <?= $form->field(new ReportForm(), 'reason')->textarea()->label(false) ?>
                    <input type="hidden" name="ReportForm[id]" class="comment_report_id" value="0"/>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                    <button type="button" class="btn btn-primary report-btn">举报</button>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>


<?php
Modal::begin([
    'header' => '<h2>Loading...</h2>',
    'id' => "content-dialog",
    'size' => Modal::SIZE_LARGE,
]);
echo '<span style="float: right;position: absolute;top: -45px;right: 10px;">
<a href="" class="btn btn-default fuck-comment"></a>

</span>';
echo '<iframe src=""  width="100%" height="500" frameborder="0"></iframe>';

Modal::end();
?>