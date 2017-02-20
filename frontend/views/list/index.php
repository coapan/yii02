<?php
/**
 * Created by PhpStorm.
 * User: PanChaoZhi
 * Date: 2017/2/1
 * Time: 16:37
 */
use yii\bootstrap\Alert;
use common\Yii02;

/** @var $group \frontend\controllers\ListController */
/** @var $cate_group \frontend\controllers\ListController */
/** @var $model \frontend\controllers\ListController */
?>

<div class="main pd20">
    <div class="cate-group">
        <div class="row">
            <?php foreach ($cate_group as $value):?>
            <div class="col-xs-2">
                <a href="<?= Yii::$app->urlManager->createUrl(['post/index', 'cid' => $value['id']]) ?>"><?= $value['name'];?></a>
            </div>
            <?php endforeach;?>
        </div>
    </div>
    <p class="cate-title"><?= $group['name'] ?>相关的板块</p>

    <div class="cate-main">
        <div class="row">

        </div>
    </div>
</div>
