<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "report_comment".
 *
 * @property string $id
 * @property string $comment_id
 * @property string $reason
 * @property integer $status
 * @property string $ip_address
 *
 * @property Comment $comment
 */
class ReportComment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'report_comment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['comment_id', 'status'], 'integer'],
            [['reason', 'ip_address'], 'string', 'max' => 255],
            [['comment_id'], 'exist', 'skipOnError' => true, 'targetClass' => Comment::className(), 'targetAttribute' => ['comment_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'comment_id' => 'Comment ID',
            'reason' => 'Reason',
            'status' => 'Status',
            'ip_address' => 'Ip Address',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComment()
    {
        return $this->hasOne(Comment::className(), ['id' => 'comment_id']);
    }
}
