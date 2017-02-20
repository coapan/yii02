<?php
/**
 * Created by PhpStorm.
 * User: PanChaoZhi
 * Date: 2017/1/29
 * Time: 19:37
 */

namespace frontend\models;


use yii\base\Model;

class CommentForm extends Model
{
    public $content;
    public $post_id;

    public function rules()
    {
        return [
            ['content', 'required', 'message' => '请输入评论内容'],
            ['post_id', 'required'],
            ['content', 'safe'],
            [['post_id'], 'integer'],
            [['content'], 'string', 'min' => 5, 'message' => '举报理由至少5个字符'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'reason' => '举报理由',
        ];
    }
}