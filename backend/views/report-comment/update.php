<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ReportComment */

$this->title = 'Update Report Comment: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Report Comments', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="report-comment-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
