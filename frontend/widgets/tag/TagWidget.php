<?php

/**
 * Created by PhpStorm.
 * User: PanChaoZhi
 * Date: 2017/1/31
 * Time: 15:42
 */
namespace frontend\widgets\tag;


use common\models\Tag;
use yii\bootstrap\Widget;

class TagWidget  extends Widget
{
    public $title;
    public $limit = 20;

    public function run()
    {
        $res = Tag::find()
            ->orderBy(['post_num' => SORT_DESC])
            ->limit($this->limit)
            ->all();
        //zhi($res);

        //$result['title'] = $this->title?:"热门标签";
        $result['body'] = $res?:[];

        return $this->render('index', [
            'data' => $result,
        ]);
    }
}