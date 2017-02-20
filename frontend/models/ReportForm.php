<?php
/**
 * Created by PhpStorm.
 * User: PanChaoZhi
 * Date: 2017/1/30
 * Time: 19:52
 */

namespace frontend\models;


use yii\base\Model;

class ReportForm extends Model
{
    public $reason;
    public $id;

    public function rules()
    {
        return [
            ['reason', 'required', 'message' => '请输入举报理由'],
            [['id'], 'integer'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'reason' => '举报理由',
        ];
    }
}