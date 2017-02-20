<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\ReportComment */

$this->title = 'Create Report Comment';
$this->params['breadcrumbs'][] = ['label' => 'Report Comments', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="report-comment-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
