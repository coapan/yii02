<?php

/**
 * Created by PhpStorm.
 * User: PanChaoZhi
 * Date: 2017/1/29
 * Time: 16:09
 */
namespace common;

use common\models\Blacklist;
use common\models\Category;
use common\models\Comment;
use common\models\Post;
use common\models\Tag;
use common\models\User;
use common\models\UserPost;

/**
 * 自定义类，可以直接调用，不用每次都去第一遍
 */
class Yii02
{
    /**
     * 自定义调试函数
     * @param $var
     */
    public function zhi($var)
    {
        echo "<pre>" . print_r($var, 1) . "</pre>";
    }

    /**
     * 返回文章的浏览数目
     * @param $id
     * @return int
     */
    public static function getBrowser($id)
    {
        $bro = Post::findOne($id);
        return $bro->browser;
    }

    /**
     * 获取文章评论数
     * @param $id
     * @return int|string
     */
    public static function getComment($id)
    {
        $num = Comment::find()
            ->where(['post_id' => $id])
            ->count();
        return $num;
    }

    public static function getCateName($id)
    {
        return Category::findOne(['id' => $id]);
    }

    /**
     * 获取文章的标题
     * @param $id
     * @return string
     */
    public static function getPostTitle($id)
    {
        $data = Comment::findOne($id);
        return Post::findOne($data->post_id)->title;
    }

    public static function tree($array, $child = "child", $pid = null)
    {
        $temp = [];
        foreach ($array as $value) {
            if ($value['pid'] == $pid) {
                $value[$child] = self::tree($array, $child, $value['id']);
                $temp[] = $value;
            }
        }
        return $temp;
    }

    /**
     * 检查用户是否在黑名单里
     * @param int $type
     * @return string
     */
    public static function isBlackList($type = 1)
    {
        if ($type == 1 && \Yii::$app->user->id) {
            $user = User::findOne(\Yii::$app->user->id);
            $data = Blacklist::findOne(['user_name' => $user->username]);
            if ($data) {
                $diff = self::diffTime2(strtotime($data->time));
                return $diff;
            }
        } else {
            $data = Blacklist::findOne(['ip_address' => \Yii::$app->request->getUserIP()]);
            if ($data) {
                $diff = self::diffTime2(strtotime($data->time));
                return $diff;
            }
        }
    }

    /**
     * 获取时间差
     * @param $time
     * @return string
     */
    public static function diffTime($time)
    {
        $date = floor((time() - $time) / 86400);//24h*60m*60s
        $hour = floor((time() - $time) % 86400 / 3600);
        $minute = floor((time() - $time) % 86400 / 60);
        $second = floor((time() - $time) % 86400) + 1;

        if ($date) {
            return $date . "天";
        }
        if ($hour) {
            return $hour . "小时";
        }
        if ($minute) {
            return $minute . "分钟";
        }
        if ($second) {
            return $second . "秒";
        }
    }

    /**
     * 封禁时间
     * @param $time
     * @return string
     */
    public static function diffTime2($time)
    {
        $date = floor(($time - time()) / 86400);
        $hour = floor(($time - time()) % 86400 / 3600);
        $minute = floor(($time - time()) % 86400 / 60);
        $second = floor(($time - time()) % 86400) + 1;

        if ($date) {
            return $date . "天";
        }
        if ($hour) {
            return $hour . "小时";
        }
        if ($minute) {
            return $minute . "分钟";
        }
        if ($second) {
            return $second . "秒";
        }
    }

    public static function getUrl($url)
    {
        //
    }

    public static function isManager($id, $model)
    {
        //
    }

    public static function traverseArray($array, $uid)
    {
        $weburl = \Yii::$app->urlManager->baseUrl;
        foreach ($array as $v) {
            $str1 = "";
            $str2 = "";
            $fuck = "";
            if ($v['user_id'] == $uid) {
                $fuck = "(<b style='color: red'>博主</b>)";
            }
            $html1 = <<<CODE
            <ul class="media-list comment_box">
            <li class="media">

                <div class="media-left fold_box">
                    <a href="javascript:;" class="zhedie">
                        <img class="media-object img-rounded" src="{$weburl}/{$v["img"]}">
                    </a>

                </div>

                <div class="media-body">
                    <div class="gbook_list">
                        <a href="javascript:;" name="comment{$v["id"]}" class="nickname">{$v["user_name"]}{$fuck}</a><em>&nbsp;{$v["signature"]}&nbsp;</em>
                    </div>
                    <div class="content">{$v["content"]}</div>
                    <div class="comment-bottom">
                        <a href="javascript:;" id="report-comment"><span class="glyphicon glyphicon-trash"></span> 举报 <i style="display:none">{$v['id']}</i></a>
                        <a href="javascript:;" id="replay-comment" data-replay="{$v['user_name']}"   data-form="form-{$v['id']}"><span class="glyphicon glyphicon-comment"></span> 回复 </a>
CODE;
            echo $html1;
            /*if (\Yii::$app->user->can('admin_login') || self::isManager(\Yii::$app->user->id, self::getCateIdByPostId($v['post_id']))) {
                echo '<a href="javascript:;" class="delete-comment" data-id="' . $v['id'] . '"> <span class="glyphicon glyphicon-remove-circle" style="color:red;"></span>  删除 </a>';
            }*/
            echo "<span><i class='glyphicon glyphicon-time'></i>  回复于" . self::diffTime($v['time']) . "前</span>";
            $html2 = <<<CODE
                    </div>
                    <div class="clearfix"></div>
                    <form class="replay-from" id="form-{$v['id']}">
                            <div class="form-group">
                                <textarea   cols="5" class="form-control"></textarea>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-1 col-md-offset-9">
                                        <a href="javascript:;" class="btn btn-default" id="cancel-replay" data-form="form-{$v['id']}">取消</a>
                                    </div>
                                    <div class="col-md-1">
                                        <a href="javascript:;" class="btn btn-success" id="submit-replay" data-form="form-{$v['id']}" data-reply="{$v['user_id']}" data-post={$v['post_id']} data-pid="{$v['id']}">回复</a>
                                    </div>
                                </div>
                            </div>
                    </form>
                </div>

            </li>
CODE;

            echo $html2;
            if ($v['child']) {
                self::traverseArray($v['child'], $uid);
            }
            echo '</ul>';
        }
    }

    /**
     * 获取字符串的长度
     * @param $string
     * @param $sublen
     * @param int $start
     * @param string $code
     * @return string
     */
    public static function cutStr($string, $sublen, $start = 0, $code = 'utf-8')
    {
        $string = strip_tags(htmlspecialchars_decode($string));
        if ($code == 'utf-8') {
            $pa = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|\xe0[\xa0-\xbf][\x80-\xbf]|[\xe1-\xef][\x80-\xbf][\x80-\xbf]|\xf0[\x90-\xbf][\x80-\xbf][\x80-\xbf]|[\xf1-\xf7][\x80-\xbf][\x80-\xbf][\x80-\xbf]/";
            preg_match_all($pa, $string, $t_string);
            if (count($t_string[0]) - $start > $sublen) return join('', array_slice($t_string[0], $start, $sublen)) . "...";
            return join('', array_slice($t_string[0], $start, $sublen));
        } else {
            $start = $start * 2;
            $sublen = $sublen * 2;
            $strlen = strlen($string);
            $tmpstr = '';
            for ($i = 0; $i < $strlen; $i++) {
                if ($i >= $start && $i < ($start + $sublen)) {
                    if (ord(substr($string, $i, 1)) > 129) {
                        $tmpstr .= substr($string, $i, 2);
                    } else {
                        $tmpstr .= substr($string, $i, 1);
                    }
                }
                if (ord(substr($string, $i, 1)) > 129) $i++;
            }
            //超出多余的字段就显示...
            if (strlen($tmpstr) < $strlen) $tmpstr .= "...";
            return $tmpstr;
        }
    }

    /**
     * 获取登录用户某个字段的信息
     * @param $field
     * @return mixed
     */
    public static function getUserInfo($field)
    {
        $user = User::findOne(\Yii::$app->user->id);
        return $user[$field];
    }

    /**
     * 获取文章的摘要，也就是截取某一段字符串的长度
     * @param $content
     * @param int $s
     * @param int $e
     * @param string $char
     * @return null|string
     */
    public static function getSummary($content, $s = 0, $e = 90, $char = "utf-8")
    {
        if (empty($content)) {
            return null;
        }

        return (mb_substr(str_replace('&nbsp;', '', strip_tags($content)), $s, $e, $char));
    }

    /**
     * 通过文章的id 来获取分类的名称
     * $data = Category::findOne($model);
     * $name = $data->name
     * return $name;
     * @param $post_id
     * @return string
     */
    public static function getCateNameByPostId($post_id)
    {
        $model = Post::findOne($post_id);
        return Category::findOne($model->cate_id)->name;
    }


    public static function getComments($uid)
    {
        return Comment::find()->where(['user_id' => $uid])->count();
    }

    /**
     * 获取收藏文章的数量
     * @param $uid
     * @return int|string
     */
    public static function getCollectPostNum($uid)
    {
        return UserPost::find()->where(['user_id' => $uid])->count();
    }

    /**
     * 获取用户发表的文章的数量
     * @param $uid
     * @return int|string
     */
    public static function getUserPostNum($uid)
    {
        return Post::find()->where(['user_id' => $uid])->count();
    }

    /**
     * 获取用户评论的数量
     * @param $uid
     * @return int|string
     */
    public static function getUserComments($uid)
    {
        return Comment::find()->where(['user_id' => $uid])->count();
    }

    /**
     * 获取回复的数量
     * @return int|string
     */
    public static function getReplayNum()
    {
        $uid = \Yii::$app->user->id;
        $count = Comment::find()->where(['reply_to' => $uid, 'msgstatus' => 0])->count();
        return $count;
    }

    /**
     * 判断是否为相邻两天，传入 Ymd 格式的数据即可
     * @param $last
     * @param $current
     * @return bool
     */
    public static function isStreakDays($last, $current)
    {
        if (($last['year'] == $current['year']) && ($current['yday'] - $last['yday'] == 1)) {
            return true;
        } elseif (($current['year'] - $last['year'] == 1) && ($last['mon'] - $current['mon'] == 11) && ($last['mday'] = $current['mday'] == 30)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * 获取近期文章
     * @return array|\yii\db\ActiveRecord[]
     */
    public static function getNewPostList()
    {
        return Post::find()
            ->select(['id', 'title', 'created_at'])
            ->orderBy(['created_at' => SORT_DESC])
            ->indexBy('title')
            ->limit(5)
            ->all();
    }

    /**
     * 获取热闹标签
     * @return array|\yii\db\ActiveRecord[]
     */
    public static function getHotTag()
    {
        return Tag::find()
            ->orderBy(['post_num' => SORT_DESC])
            ->limit(20)
            ->all();
    }

    /**
     * 获取热门文章
     * @return array|\yii\db\ActiveRecord[]
     */
    public static function getHotPost()
    {
        return Post::find()
            ->select(['id', 'title', 'browser'])
            ->orderBy(['browser' => SORT_DESC])
            ->indexBy('title')
            ->limit(5)
            ->all();
    }
}