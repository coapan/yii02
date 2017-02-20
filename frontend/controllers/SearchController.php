<?php
/**
 * Created by PhpStorm.
 * User: PanChaoZhi
 * Date: 2017/2/2
 * Time: 14:04
 */

namespace frontend\controllers;


use common\models\Post;
use yii\data\Pagination;
use yii\web\Controller;

class SearchController extends Controller
{
    public function actionIndex($q)
    {
        $diffTime = 0;
        $query = Post::find()
            ->joinWith('cate')
            ->orderBy(['post.id' => SORT_DESC])
            ->asArray();
        $post = clone $query;
        if ($q) {
            $post = $query->andFilterWhere(['like', 'post.title', $q])
                ->orFilterWhere(['like', 'post.content', $q])
                ->andWhere('post.created_at > :diffTime', [':diffTime' => $diffTime]);
        }
        $pages = new Pagination([
            'totalCount' => $post->count(),
            'defaultPageSize' => 10
        ]);

        $model = $post->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        return $this->render('index', [
            'model' => $model,
            'pages' => $pages,
            'q' => $q,
            'count' => $post->count(),
        ]);
    }
}