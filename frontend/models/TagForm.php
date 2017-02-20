<?php
/**
 * Created by PhpStorm.
 * User: PanChaoZhi
 * Date: 2017/1/28
 * Time: 21:25
 */

namespace frontend\models;


use common\models\Tag;
use yii\base\Model;

class TagForm extends Model
{
    public $id;
    public $tags;

    public function rules()
    {
        return [
            ['tags' => 'required'],
            ['tags', 'each', 'rule' => ['string']],
        ];
    }

    public function saveTags()
    {
        $ids = [];
        if (!empty($this->tags)) {
            foreach ($this->tags as $tag) {
                $ids[] = $this->_saveTag($tag);
            }
        }

        return $ids;
    }

    public function _saveTag($tag)
    {
        $model = new Tag();
        $res = $model->find()->where(['tag_name' => $tag])->one();
        if (!$res) {
            $model->tag_name = $tag;
            $model->post_num = 1;
            $model->save();
            return $model->id;
        } else {
            $res->updateCounters(['post_num' => 1]);
        }

        return $res->id;
    }
}