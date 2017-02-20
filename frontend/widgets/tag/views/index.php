<?php
/**
 * Created by PhpStorm.
 * User: PanChaoZhi
 * Date: 2017/1/31
 * Time: 15:42
 */
?>
<?php if (!empty($data)):?>
<div class="panel-title box-title">
    <span><b><?= $data['title']?></b></span>
</div>
<div class="panel-body padding-left-0">
    <div class="tag-cloud">
        <?php foreach ($data['body'] as $v):?>
        <a href="<?= \yii\helpers\Url::to(['post/index', 'tag' => $v['tag_name']]) ?>"><?= $v['tag_name']?></a>
        <?php endforeach;?>
    </div>
</div>
<?php endif;?>
