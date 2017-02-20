<?php
/**
 * Created by PhpStorm.
 * User: PanChaoZhi
 * Date: 2017/1/29
 * Time: 13:56
 */
namespace frontend\widgets\post;

use common\models\Post;
use frontend\models\PostForm;
use yii\base\Widget;
use yii\data\Pagination;
use yii\helpers\Url;

class PostWidget extends Widget
{
    public $title = '';
    public $limit = 10;
    public $more = true;
    public $page = true;
    public $cid = null;

    public function run()
    {
        $model = Post::find()->joinWith('cate')->where(['cate_id' => $this->cid])->asArray()->all();
        foreach ($model as $value) {
            //zhi($this->cid);
            //zhi($value);exit;
            if ($this->cid == $value['cate_id']) {
                $curPage = \Yii::$app->request->get('page', 1);
                $cond = ['=', 'cate_id', $this->cid];
                $res = PostForm::getList($cond, $curPage, $this->limit);
                //zhi($res);exit;

                $result['title'] = $this->title ?: "最新文章";
                $result['more'] = Url::to(['post/index']);
                $result['body'] = $res['data'] ?: [];

                if ($this->page) {
                    $pages = new Pagination(['totalCount' => $res['count'], 'pageSize' => $res['pageSize']]);
                    $result['page'] = $pages;
                }

                return $this->render('index', [
                    'data' => $result,
                    'model' => $model,
                ]);
            }
        }
    }
}