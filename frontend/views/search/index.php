<?php
/**
 * Created by PhpStorm.
 * User: PanChaoZhi
 * Date: 2017/2/2
 * Time: 14:15
 */
/** @var $model \frontend\controllers\SearchController */
/** @var $q */
/** @var $pages */
/** @var $count */
use common\Yii02;
use yii\bootstrap\Alert;
use yii\widgets\LinkPager;

?>

<?php if (!$model): ?>
    <div class="main pd20">
        <?php
        Alert::begin([
            'options' => [
                'class' => 'alert-warning',
            ],
        ]);

        echo "没有找到...请尝试其他关键词";

        Alert::end();
        ?>
    </div>
<?php else: ?>
    <div class="main">
        <div class="search-type">
            <span style="float: left;font-size: 15px;font-weight: bold;padding: 10px;">一共搜索到<?= $count ?>关于"<?= $q ?>
                "的搜索结果</span>
            <div class="btn-group">
                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"
                        aria-expanded="false">
                    筛选<span class="caret"></span>
                </button>
                <ul class="dropdown-menu" role="menu">
                    <li><a href="<?= Yii::$app->urlManager->createUrl(['search/index', 'q' => $q]) ?>" data-type="0">时间不限</a>
                    </li>
                    <li><a href="<?= Yii::$app->urlManager->createUrl(['search/index', 'q' => $q, 'type' => 1]) ?>"
                           data-type="1">一天之内</a></li>
                    <li><a href="<?= Yii::$app->urlManager->createUrl(['search/index', 'q' => $q, 'type' => 2]) ?>"
                           data-type="2">一周之内</a></li>
                    <li><a href="<?= Yii::$app->urlManager->createUrl(['search/index', 'q' => $q, 'type' => 3]) ?>"
                           data-type="3">三个月内</a></li>
                </ul>
            </div>
        </div>
        <div role="tabpanel" style="position: relative;">
            <div class="tab-content pd20">
                <div role="tabpanel" class="tab-pane active" id="one">
                    <?php foreach ($model as $value): ?>
                        <div class="row gbook_list">
                            <h1>
                                <a href="<?= Yii::$app->urlManager->createUrl(['post/view', 'id' => $value['id']]) ?>"><?= $value['title']; ?></a>
                            </h1>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>