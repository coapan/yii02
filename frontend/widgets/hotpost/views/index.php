<?php
/**
 * Created by PhpStorm.
 * User: PanChaoZhi
 * Date: 2017/1/31
 * Time: 14:30
 */
/** @var $data \frontend\widgets\hotpost\HotPostWidget */

?>
<?php if (!empty($data)):?>
<div class="panel">
    <div class="panel-title box-title">
        <span><strong><?= $data['title']?></strong></span>
    </div>
    <div class="panel-body hot-body">
        <?php foreach ($data['body'] as $v):?>
            <?//php zhi($v);exit;?>
        <div class="clearfix hot-list">
            <div class="pull-left media-left">
                <a href="#">浏览<em><?= $v['browser'];?></em></a>
            </div>
            <div class="media-right">
                <a href="<?=\yii\helpers\Url::to(['post/view', 'id' => $v['id']])?>"><?= $v['title'];?></a>
            </div>
        </div>
        <?php endforeach;?>
    </div>
</div>
<?php endif;?>
