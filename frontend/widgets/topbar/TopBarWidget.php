<?php

/**
 * Created by PhpStorm.
 * User: PanChaoZhi
 * Date: 2017/1/31
 * Time: 17:14
 */
namespace frontend\widgets\topbar;

use yii\bootstrap\Widget;
use common\models\CategoryGroup;

class TopBarWidget extends Widget
{
    public function run()
    {
        $cate = CategoryGroup::find()
            ->joinWith("categories")
            ->orderBy(['category_group.sort' => SORT_DESC])
            ->where('category_group.sort >:threshold', [':threshold' => 99])
            ->asArray()
            ->all();
        //zhi($cate);

        return $this->render('index', [
            'cate' => $cate,
        ]);
    }
}