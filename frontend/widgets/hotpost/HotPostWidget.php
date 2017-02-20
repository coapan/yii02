<?php

/**
 * Created by PhpStorm.
 * User: PanChaoZhi
 * Date: 2017/1/31
 * Time: 14:30
 */
namespace frontend\widgets\hotpost;
use common\models\Post;
use Yii;
use yii\bootstrap\Widget;
use yii\db\Query;

class HotPostWidget extends Widget
{
    public $title = '';
    public $limit = 6;

    public function run()
    {
        $select = ['id', 'title', 'browser'];
        $res = (new Query())
            ->select($select)
            ->from('post')
            ->where('is_valid =' . Post::IS_VALID)
            ->orderBy(['browser' => SORT_DESC, 'id' => SORT_DESC])
            ->limit($this->limit)
            ->all();
        //zhi($res);exit;

        $result['title'] = $this->title?:"热门文章";
        $result['body'] = $res?:[];

        return $this->render('index', ['data' => $result]);
    }
}