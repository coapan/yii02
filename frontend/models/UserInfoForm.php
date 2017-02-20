<?php
/**
 * Created by PhpStorm.
 * User: PanChaoZhi
 * Date: 2017/2/1
 * Time: 18:05
 */

namespace frontend\models;


use common\models\User;
use yii\base\Model;

class UserInfoForm extends Model
{
    public $username;
    public $nickname;
    public $email;
    public $password;
    public $rePassword;
    public $signature;

    public function rules()
    {
        return [
            ['nickname', 'string', 'min' => 2, 'max' => 15],
            ['signature', 'safe'],
            [['password', 'rePassword'], 'safe'],
            ['rePassword', 'compare', 'compareAttribute' => 'password', 'message' => '两次输入的密码不同'],
        ];
    }

    /**
     * Update User Info.
     * @return null|static the nickname,signature,password will be change
     */
    public function updateInfo()
    {
        if ($this->validate()) {
            $user = User::findOne(\Yii::$app->user->id);
            $user->nickname = $this->nickname;
            $user->signature = $this->signature;
            if ($this->password != "") {
                $user->setPassword($this->password);
            }
            if ($user->save()) {
                return $user;
            }
        }
        return null;
    }
}