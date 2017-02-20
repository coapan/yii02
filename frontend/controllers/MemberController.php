<?php
/**
 * Created by PhpStorm.
 * User: PanChaoZhi
 * Date: 2017/2/1
 * Time: 17:58
 */

namespace frontend\controllers;


use common\models\Comment;
use common\models\Post;
use common\models\User;
use frontend\models\UploadForm;
use frontend\models\UserInfoForm;
use yii\data\Pagination;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\UploadedFile;

class MemberController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    /**
     * 用户的个人信息
     * @return string
     */
    public function actionInfo()
    {
        $this->layout = 'member';
        $model = User::findOne(\Yii::$app->user->id);
        //zhi($model);
        $form = new UserInfoForm();
        $user = User::findOne(\Yii::$app->user->id);
        $upload = new UploadForm();

        if ($form->load(\Yii::$app->request->post())) {
            if ($form->updateInfo()) {
                return $this->render('info', [
                    'model' => $model,
                    'user' => $user,
                    'info' => $form,
                    'upload' => $upload,
                ]);
            }
        }

        /**
         * 上传头像
         */
        if ($upload->load(\Yii::$app->request->post())) {
            $thumb = UploadedFile::getInstance($upload, 'file');
            if ($thumb) {
                $dir = 'uploads/' . date("Ym");
                if (!file_exists($dir)) {
                    mkdir($dir);
                }
                $file_path = $dir . "/" . time() . rand(0, 99) . "." . $thumb->getExtension();
                $thumb->saveAs($file_path);
                $user->avatar = $file_path;
                if ($user->save()) {
                    return $this->render('info', [
                        'model' => $model,
                        'info' => $form,
                        'user' => $user,
                        'upload' => $upload
                    ]);
                }
            }
        }

        return $this->render('info', [
            'model' => $model,
            'info' => $form,
            'user' => $user,
            'upload' => $upload
        ]);
    }

    public function actionCollect()
    {
        $this->layout = "member";
        $query = Post::find()
            ->innerJoinWith('userPosts')
            ->innerJoinWith('cate')
            ->where(['user_post.user_id' => \Yii::$app->user->id]);
        //zhi($query);exit;
        $countQuery = clone $query;
        $pages = new Pagination([
            'totalCount' => $countQuery->count(),
            'defaultPageSize' => 10,
        ]);

        $model = $query
            ->offset($pages->offset)
            ->limit($pages->limit)
            ->orderBy(['user_post.time' => SORT_DESC])
            ->asArray()
            ->all();
        //zhi($model);exit;

        return $this->render('collect', [
            'pages' => $pages,
            'model' => $model,
        ]);
    }

    /**
     * 获取我发表过的文章
     * @return string
     */
    public function actionPost()
    {
        $this->layout = "member";
        $query = Post::find()
            ->innerJoinWith('cate')
            ->where(['user_id' => \Yii::$app->user->id, 'is_valid' => 1,]);
        $countQuery = clone $query;
        $pages = new Pagination([
            'totalCount' => $countQuery->count(),
            'defaultPageSize' => 10,
        ]);

        $model = $query
            ->offset($pages->offset)
            ->limit($pages->limit)
            ->orderBy(['created_at' => SORT_DESC])
            ->asArray()
            ->all();
        //zhi($model);exit;

        return $this->render('post', [
            'model' => $model,
            'pages' => $pages,
            //'msg' => $msg,
            'count' => $countQuery->count()
        ]);
    }

    /**
     * 获取用户的评论
     * @return string
     */
    public function actionComment()
    {
        $this->layout = "member";
        $comment = Comment::find()
            ->where(['user_id' => \Yii::$app->user->id, 'status' => 1])
            ->orderBy(['time' => SORT_DESC]);

        $pages = new Pagination([
            'totalCount' => $comment->count(),
            'defaultPageSize' => 10,
        ]);
        $model = Comment::find()
            ->offset($pages->offset)
            ->limit($pages->limit)
            ->asArray()
            ->all();

        //zhi($model);exit;
        return $this->render('comment', [
            'model' => $model,
            'pages' => $pages
        ]);
    }

    public function actionMessage()
    {
        $this->layout = "member";
        $comment = Comment::find()
            ->where(['reply_to' => \Yii::$app->user->id])
            ->orderBy(['id' => SORT_DESC]);
        $c = clone $comment;
        $comment = $comment->innerJoinWith("post");
        $pages = new Pagination([
            'totalCount' => $c->count(),
            'defaultPageSize' => 10,
        ]);

        $model = $comment
            ->offset($pages->offset)
            ->limit($pages->limit)
            ->asArray()
            ->all();
        //zhi($model);exit;

        return $this->render('message', [
            'model' => $model,
            'pages' => $pages,
        ]);
    }
}