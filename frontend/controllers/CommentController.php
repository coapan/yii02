<?php
/**
 * Created by PhpStorm.
 * User: PanChaoZhi
 * Date: 2017/1/29
 * Time: 17:53
 */

namespace frontend\controllers;


use common\models\Comment;
use common\models\Post;
use common\models\ReportComment;
use common\models\User;
use common\Yii02;
use yii\web\Controller;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

class CommentController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * 显示评论
     * @param $id
     * @return string
     */
    public function actionIndex($id)
    {
        $this->layout = false;
        $data = Comment::find()
            ->where(['post_id' => $id])
            ->asArray()
            ->all();
        //zhi($data);
        $comment = Yii02::tree($data);
        //zhi($comment);
        return $this->render('index', ['comment' => $comment]);
    }

    /**
     * 提交评论
     */
    public function actionComment()
    {
        //检查用户是否在黑名单里
        $blackList = Yii02::isBlackList();
        if ($blackList) {
            $data['status'] = -2;
            $data['msg'] = "IP被封禁，距离解封还有" . $blackList;
            echo json_encode($data);
            return;
        }

        //用户通过Ajax请求获取数据
        if (\Yii::$app->request->isAjax) {
            $data = \Yii::$app->request->post("CommentForm");
            $content = $data['content'];
            $post_id = $data['post_id'];

            $post = Post::findOne($post_id);
            $post->last_comment = time();
            $post->save();

            $comment = new Comment();
            $comment->content = $content;
            $comment->post_id = $post_id;
            $comment->status = 1;
            $comment->time = time();
            $comment->ip_address = \Yii::$app->request->getUserIP();
            //如果用户不是游客
            if (!\Yii::$app->user->isGuest) {
                $user = User::findOne(\Yii::$app->user->id);
                $comment->user_name = $user->nickname;
                $comment->user_id = $user->id;
                $comment->signature = $user->signature;
                $comment->img = $user->avatar;
            } else {
                //用户是游客显示这个
                if (!\Yii::$app->request->cookies->has("anonymous_name")) {
                    $comment->user_name = "用户";
                } else {
                    $comment->user_name = \Yii::$app->request->cookies->get("anonymous_name")->value;
                }
                //
                if (!\Yii::$app->request->cookies->has("anonymous_signature")) {
                    $comment->signature = "";
                } else {
                    $comment->signature = \Yii::$app->request->cookies->get("anonymous_signature")->value;
                }
                //游客头像
                $comment->img = "/img/avatar.jpg";
            }
            //成功保存到数据库
            if ($comment->save()) {
                $data['status'] = 1;
                $data['msg'] = "comment success";
                echo json_encode($data);
            }
        }
    }

    /**
     * 回复评论
     */
    public function actionReplay()
    {
        $blackList = Yii02::isBlackList(2);
        if ($blackList) {
            $data['status'] = -2;
            $data['msg'] = "IP被封禁，距离解封还有" . $blackList;
            echo json_encode($data);
            return;
        }

        if (\Yii::$app->request->isAjax) {
            $pid = \Yii::$app->request->post("pid"); //pid是要回复评论的id
            $content = \Yii::$app->request->post("content");
            $post_id = \Yii::$app->request->post("post_id");
            $reply_to = \Yii::$app->request->post("reply_to");

            $post = Post::findOne($post_id);
            $post->last_comment = time();
            $post->save();

            $comment = new Comment();
            $comment->content = htmlspecialchars($content);
            $comment->post_id = $post_id;
            $comment->status = 1;
            $comment->time = time();
            $comment->ip_address = \Yii::$app->request->getUserIP();
            //如果用户不是游客
            if (!\Yii::$app->user->isGuest) {
                $user = User::findOne(\Yii::$app->user->id);
                $comment->user_name = $user->nickname;
                $comment->user_id = $user->id;
                $comment->signature = $user->signature;
                $comment->img = $user->avatar;
                $comment->pid = $pid;
                $comment->reply_to = $reply_to;
            } else {
                //用户是游客显示这个
                if (!\Yii::$app->request->cookies->has("anonymous_name")) {
                    $comment->user_name = "用户";
                } else {
                    $comment->user_name = \Yii::$app->request->cookies->get("anonymous_name")->value;
                }
                //
                if (!\Yii::$app->request->cookies->has("anonymous_signature")) {
                    $comment->signature = "";
                } else {
                    $comment->signature = \Yii::$app->request->cookies->get("anonymous_signature")->value;
                }
                //游客头像
                $comment->img = "/img/avatar.jpg";
                $comment->pid = $pid;
                $comment->reply_to = $reply_to;
            }
            //成功保存到数据库
            if ($comment->save()) {
                $data['status'] = 1;
                $data['msg'] = "comment success";
                echo json_encode($data);
            }
        }
    }

    /**
     * 举报评论
     */
    public function actionReport()
    {
        $ReportForm = \Yii::$app->request->post("ReportForm");
        $report = new ReportComment();
        $result = $report->findOne(['ip_address' => \Yii::$app->request->getUserIP(), 'comment_id' => $ReportForm['id']]);

        if ($result) {
            $data['status'] = 0;
            $data['msg'] = "举报失败，您已经举报过";
            echo json_encode($data);
        } else {
            $report->comment_id = $ReportForm['id'];
            $report->reason = $ReportForm['reason'];
            $report->ip_address = \Yii::$app->request->getUserIP();
            if ($report->save()) {
                $data['status'] = 1;
                $data['msg'] = "举报成功";
                echo json_encode($data);
            }
        }
    }
}