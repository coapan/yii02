<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "category".
 *
 * @property string $id
 * @property string $cate_group_id
 * @property string $name
 * @property integer $sort
 * @property string $keywords
 * @property integer $created_at
 * @property string $create_by
 * @property integer $status
 *
 * @property CategoryGroup $cateGroup
 * @property User $createBy
 * @property Post[] $posts
 */
class Category extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cate_group_id', 'sort', 'created_at', 'create_by', 'status'], 'integer'],
            [['name'], 'required'],
            [['name'], 'string', 'max' => 50],
            [['keywords'], 'string', 'max' => 100],
            [['cate_group_id'], 'exist', 'skipOnError' => true, 'targetClass' => CategoryGroup::className(), 'targetAttribute' => ['cate_group_id' => 'id']],
            [['create_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['create_by' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '编号',
            'cate_group_id' => '分类组编号',
            'name' => '分类名称',
            'sort' => '排序无则',
            'keywords' => '关键词',
            'created_at' => '创建时间',
            'create_by' => '更新时间',
            'status' => '状态',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCateGroup()
    {
        return $this->hasOne(CategoryGroup::className(), ['id' => 'cate_group_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreateBy()
    {
        return $this->hasOne(User::className(), ['id' => 'create_by']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPosts()
    {
        return $this->hasMany(Post::className(), ['cate_id' => 'id']);
    }

    public static function getAllCate()
    {
        $cate = ['0' => '请选择分类'];
        $res = self::find()->asArray()->all();
        //zhi($res);
        if ($res) {
            foreach ($res as $v) {
                $cate[$v['id']] = $v['name'];
            }
        }
        //zhi($cate);
        return $cate;
    }
}
