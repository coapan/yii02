<?php
/**
 * Created by PhpStorm.
 * User: PanChaoZhi
 * Date: 2017/1/30
 * Time: 13:58
 */
use Yii;
use common\Yii02;

/** @var $comment \frontend\controllers\CommentController */
?>

<div class="main">
    <?= Yii02::traverseArray($comment) ?>
</div>