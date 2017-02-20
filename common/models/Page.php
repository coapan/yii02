<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "page".
 *
 * @property string $id
 * @property string $name
 * @property string $title
 * @property string $keywords
 * @property string $description
 * @property string $content
 * @property integer $time
 */
class Page extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'page';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['content'], 'string'],
            [['time'], 'integer'],
            [['name'], 'string', 'max' => 20],
            [['title'], 'string', 'max' => 100],
            [['keywords', 'description'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'title' => 'Title',
            'keywords' => 'Keywords',
            'description' => 'Description',
            'content' => 'Content',
            'time' => 'Time',
        ];
    }
}
