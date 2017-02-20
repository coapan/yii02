<?php
/**
 * Created by PhpStorm.
 * User: PanChaoZhi
 * Date: 2017/2/1
 * Time: 16:43
 */

namespace frontend\controllers;


use common\models\Category;
use common\models\CategoryGroup;
use common\Yii02;
use yii\web\Controller;

class ListController extends Controller
{
    public function actionIndex($id = 1)
    {
        $cate_group = CategoryGroup::find()->orderBy(['sort' => SORT_DESC])->all();
        //zhi($cate_group);

        $group = CategoryGroup::findOne(['id' => $id]);
        $model = Category::find()
            ->joinWith("cateGroup")
            ->where(['status' => 1, 'category_group.id' => $id])
            ->orderBy(['category_group.sort' => SORT_DESC, 'category.sort' => SORT_DESC])
            ->asArray()
            ->all();
        //zhi($model);
        //用户是否关注分类，是否这一功能
        /*$msg = false;
        if (Yii02::isHasCate()) {
            $msg = true;
        }*/

        return $this->render('index', [
            'model' => $model,
            'cate_group' => $cate_group,
            'group' => $group
        ]);
    }
}