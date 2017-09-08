<?php

/* @var $this yii\web\View */
use frontend\widgets\banner\BannerWidget;
use frontend\widgets\post\PostIndex;

$this->title = '博客-首页';
?>

<div class="row">
    <div class="col-lg-9">
        <div class="panel">
            <!--<div class="panel">
                <?/*= BannerWidget::widget() */?>
            </div>-->

            <!--<div class="panel">
                <?/*= PostIndex::widget(['limit' => 10]) */?>
            </div>-->
        </div>
    </div>

    <!--<div class="col-xs-3">
        <div class="panel">
            <div class="panel">
                <?/*= \frontend\widgets\hotpost\HotPostWidget::widget()*/?>
            </div>
        </div>
        <div class="panel">
            <div class="panel">
                <?/*= \frontend\widgets\tag\TagWidget::widget()*/?>
            </div>
        </div>
    </div>-->
</div>

<div class="panel">
    <?= PostIndex::widget(['limit' => 15]) ?>
</div>
