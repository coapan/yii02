<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tag".
 *
 * @property string $id
 * @property string $tag_name
 * @property integer $post_num
 *
 * @property RelationPostTag[] $relationPostTags
 */
class Tag extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tag';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['post_num'], 'integer'],
            [['tag_name'], 'string', 'max' => 50],
            [['tag_name'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tag_name' => 'Tag Name',
            'post_num' => 'Post Num',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRelationPostTags()
    {
        return $this->hasMany(RelationPostTag::className(), ['tag_id' => 'id']);
    }
}
