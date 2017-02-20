<?php
/**
 * Created by PhpStorm.
 * User: PanChaoZhi
 * Date: 2017/2/9
 * Time: 8:15
 */

namespace frontend\controllers;


use common\models\Page;
use yii\base\NotSupportedException;
use yii\web\Controller;

class PageController extends Controller
{
    public function actionIndex($name)
    {
        if (!$name) {
            throw new NotSupportedException("请求参数错误");
        }
        $model = Page::findOne(['name' => $name]);
        if (!$model) {
            throw new NotSupportedException("页面不存在");
        }

        return $this->render('index', [
            'model' => $model,
            'name' => $name,
        ]);
    }
}