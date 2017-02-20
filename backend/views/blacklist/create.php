<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Blacklist */

$this->title = '添加黑名单';
$this->params['breadcrumbs'][] = ['label' => 'Blacklists', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="blacklist-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php \yii\bootstrap\Alert::begin([
        'options'=>[
            'class'=>'alert-warning',
        ],
    ]);

    echo '请注意：如果封禁发布文章的作者，请填写用户名，如果封禁评论用户，请填写IP地址。信息对应错误将不生效。';

    \yii\bootstrap\Alert::end(); ?>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
