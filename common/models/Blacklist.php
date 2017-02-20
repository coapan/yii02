<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "blacklist".
 *
 * @property string $id
 * @property string $ip_address
 * @property string $time
 * @property string $user_name
 */
class Blacklist extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'blacklist';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['time'], 'required'],
            [['ip_address'], 'string', 'max' => 60],
            [['time', 'user_name'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ip_address' => 'Ip Address',
            'time' => 'Time',
            'user_name' => 'User Name',
        ];
    }
}
