<?php

use frontend\widgets\post\PostWidget;
/** @var $model \frontend\controllers\PostController */
/** @var $cid \frontend\controllers\PostController */
?>

<div class="row">
    <div class="col-lg-9">
        <?= PostWidget::widget([
            'cid' => $cid,
        ])?>
    </div>
</div>