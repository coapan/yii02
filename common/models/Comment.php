<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "comment".
 *
 * @property string $id
 * @property string $pid
 * @property string $content
 * @property string $user_id
 * @property string $post_id
 * @property string $user_name
 * @property integer $status
 * @property string $signature
 * @property integer $time
 * @property integer $zan
 * @property integer $cai
 * @property string $img
 * @property string $ip_address
 * @property string $reply_to
 * @property integer $msgstatus
 *
 * @property User $user
 * @property Post $post
 * @property User $replyTo
 * @property Comment $p
 * @property Comment[] $comments
 */
class Comment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'comment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pid', 'user_id', 'post_id', 'status', 'time', 'zan', 'cai', 'reply_to', 'msgstatus'], 'integer'],
            [['content'], 'required'],
            [['content'], 'string'],
            [['user_name'], 'string', 'max' => 50],
            [['signature', 'img', 'ip_address'], 'string', 'max' => 255],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['post_id'], 'exist', 'skipOnError' => true, 'targetClass' => Post::className(), 'targetAttribute' => ['post_id' => 'id']],
            [['reply_to'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['reply_to' => 'id']],
            [['pid'], 'exist', 'skipOnError' => true, 'targetClass' => Comment::className(), 'targetAttribute' => ['pid' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'pid' => 'Pid',
            'content' => 'Content',
            'user_id' => 'User ID',
            'post_id' => 'Post ID',
            'user_name' => 'User Name',
            'status' => 'Status',
            'signature' => 'Signature',
            'time' => 'Time',
            'zan' => 'Zan',
            'cai' => 'Cai',
            'img' => 'Img',
            'ip_address' => 'Ip Address',
            'reply_to' => 'Reply To',
            'msgstatus' => 'Msgstatus',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPost()
    {
        return $this->hasOne(Post::className(), ['id' => 'post_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReplyTo()
    {
        return $this->hasOne(User::className(), ['id' => 'reply_to']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getP()
    {
        return $this->hasOne(Comment::className(), ['id' => 'pid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comment::className(), ['pid' => 'id']);
    }
}
