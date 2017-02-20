<?php
/**
 * Created by PhpStorm.
 * User: PanChaoZhi
 * Date: 2017/2/1
 * Time: 15:58
 */
namespace frontend\widgets\post;

use common\models\Post;
use frontend\models\PostForm;
use yii\base\Widget;
use yii\data\Pagination;
use yii\helpers\Url;

class PostIndex extends Widget
{
    public $title = '';
    public $limit = 10;
    public $more = true;
    public $page = true;

    public function run()
    {
        $curPage = \Yii::$app->request->get('page', 1);
        $cond = ['=', 'is_valid', Post::IS_VALID];
        $res = PostForm::getList($cond, $curPage, $this->limit);
        //zhi($res);exit;

        $result['title'] = $this->title ?: "最新文章";
        $result['more'] = Url::to(['post/index1']);
        $result['body'] = $res['data'] ?: [];

        if ($this->page) {
            $pages = new Pagination(['totalCount' => $res['count'], 'pageSize' => $res['pageSize']]);
            $result['page'] = $pages;
        }

        return $this->render('index', ['data' => $result]);
    }
}