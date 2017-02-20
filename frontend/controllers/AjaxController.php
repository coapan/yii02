<?php
/**
 * Created by PhpStorm.
 * User: PanChaoZhi
 * Date: 2017/2/2
 * Time: 11:31
 */

namespace frontend\controllers;


use common\models\Comment;
use common\models\User;
use common\models\UserPost;
use common\Yii02;
use yii\web\Controller;

class AjaxController extends Controller
{
    /**
     * 收藏文章的操作
     */
    public function actionCollect()
    {
        if (!\Yii::$app->user->isGuest) {
            if (\Yii::$app->request->isAjax) {
                $post_id = \Yii::$app->request->post("id");
                $user_id = \Yii::$app->user->id;
                $user_post = new UserPost();
                $result = $user_post->findOne(['user_id' => $user_id, 'post_id' => $post_id]);
                if ($result) {
                    $data['status'] = 1;
                    $data['msg'] = "您已取消收藏";
                    echo json_encode($data);
                    $result->delete();
                } else {
                    $data['status'] = 0;
                    $data['msg'] = "收藏成功";
                    echo json_encode($data);
                    $user_post->user_id = $user_id;
                    $user_post->post_id = $post_id;
                    $user_post->time = time();
                    $user_post->save();
                }
            }
        } else {
            $data['status'] = -1;
            $data['msg'] = "请先登录";
            echo json_encode($data);
        }

    }

    /**
     * 判断用户是否登录
     * @return bool
     */
    public function isLogin()
    {
        if (\Yii::$app->user->isGuest) {
            return false;
        } else {
            return true;
        }
    }

    /**
     * 在线时长
     */
    public function actionOnline()
    {
        //是否是Ajax请求
        if (\Yii::$app->request->isAjax) {
            $session = \Yii::$app->session;
            //如果不存在这个session
            if (!$session['online']) {
                $session['online'] = time();
            }
            //获取时差，时差如果大于设置的毫秒数，就操作数据库
            $diffTime = time() - $session['online'];
            if ($diffTime > 300) {
                //更新 session
                $session['online'] = time();
                //更新数据库字段
                $user = User::findOne(\Yii::$app->user->id);
                $user->online_time += 5;
                $user->save();
            }
        }
    }

    /**
     * 签到的操作
     */
    public function actionSignin()
    {
        if (\Yii::$app->request->isAjax && !\Yii::$app->user->isGuest) {
            $uid = \Yii::$app->user->id;
            $user = User::findOne($uid);
            //获取当前时间和上次签到的时间
            $current = date("Ymd");
            $last = $user->signin_time;
            if ($current == $last) {
                $data['status'] = 1;
                $data['msg'] = "今天已签到";
                echo json_encode($data);
                return;
            }
            $isAdjacentDay = Yii02::isStreakDays(getdate(strtotime($last)), getdate(strtotime($current)));
            //如果是相邻的两天
            if ($isAdjacentDay) {
                $user->total_signin += 1;
                $user->current_signin += 1;
                if ($user->current_signin > $user->max_signin) {
                    $user->max_signin = $user->current_signin;
                }
                $user->signin_time = $current;
                $user->save();
                $data['status'] = 1;
                $data['msg'] = "签到成功,连续签到";
                echo json_encode($data);
            } else {
                $user->total_signin += 1;
                $user->current_signin = 1;
                if ($user->current_signin > $user->max_signin) {
                    $user->max_signin = $user->current_signin;
                }
                $user->signin_time = $current;
                $user->save();
                $data['status'] = 1;
                $data['msg'] = "签到成功，不连续，重新签到";
                echo json_encode($data);
            }
        }
    }

    /**
     * 读消息的操作
     */
    public function actionRead()
    {
        $id = \Yii::$app->request->post("id");
        $comment = Comment::findOne($id);
        $comment->msgstatus = 1;
        if ($comment->save()) {
            echo json_encode("success");
        }
    }
}