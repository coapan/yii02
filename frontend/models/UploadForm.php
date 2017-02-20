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
use yii\web\UploadedFile;

class UploadForm extends Model
{
    public $file;

    public function rules()
    {
        return [
            ['file', 'required'],
            [['file'], 'file', 'extensions' => 'jpg,gif,bmp,png', 'mimeTypes' => 'image/gif,image/bmp,image/jpeg,image/png',],
        ];
    }

    /**
     * Upload the user avatar method
     * @return bool|null
     */
    public function uploadImg()
    {
        if ($this->validate()) {
            $user = User::findOne(\Yii::$app->user->id);
            $thumb = UploadedFile::getInstance($this, 'file');
            if ($thumb) {
                $dir = 'uploads/' . date("Ym");
                if (!file_exists($dir)) {
                    mkdir($dir);
                }
                $file_path = $dir . "/" . time() . rand(0, 99) . "." . $thumb->getExtension();
                $thumb->saveAs($file_path);
                $user->avatar = $file_path;
                if ($user->save()) {
                    return true;
                }
            }
        }
        return null;
    }

    public function attributeLabels()
    {
        return [
            'file' => '头像',
        ];
    }
}