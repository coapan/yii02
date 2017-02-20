<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "post".
 *
 * @property string $id
 * @property string $title
 * @property string $label_img
 * @property string $summary
 * @property string $content
 * @property string $cate_id
 * @property string $user_id
 * @property string $user_name
 * @property integer $is_valid
 * @property integer $browser
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $zan
 * @property integer $cai
 * @property string $ip_address
 * @property string $keywords
 * @property integer $last_comment
 * @property string $signature
 * @property string $nickname
 *
 * @property Category $cate
 * @property User $user
 * @property RelationPostTag[] $relationPostTags
 */
class Post extends \yii\db\ActiveRecord
{
    const IS_VALID = 1;
    const UN_VALID = 0;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'post';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'content'], 'required'],
            [['content'], 'string'],
            [['cate_id', 'user_id', 'is_valid', 'browser', 'created_at', 'updated_at', 'zan', 'cai', 'last_comment'], 'integer'],
            [['title', 'user_name', 'ip_address'], 'string', 'max' => 50],
            [['label_img', 'summary', 'nickname'], 'string', 'max' => 255],
            [['keywords'], 'string', 'max' => 100],
            [['signature'], 'string', 'max' => 60],
            [['cate_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['cate_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'label_img' => 'Label Img',
            'summary' => 'Summary',
            'content' => 'Content',
            'cate_id' => 'Cate ID',
            'user_id' => 'User ID',
            'user_name' => 'User Name',
            'is_valid' => 'Is Valid',
            'browser' => 'Browser',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'zan' => 'Zan',
            'cai' => 'Cai',
            'ip_address' => 'Ip Address',
            'keywords' => 'Keywords',
            'last_comment' => 'Last Comment',
            'signature' => 'Signature',
            'nickname' => 'Nickname',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCate()
    {
        return $this->hasOne(Category::className(), ['id' => 'cate_id']);
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
    public function getRelationPostTags()
    {
        return $this->hasMany(RelationPostTag::className(), ['post_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserPosts()
    {
        return $this->hasMany(UserPost::className(), ['post_id' => 'id']);
    }

    public function getPages($query, $curPage = 1, $pageSize = 10, $search = null)
    {
        if ($search) {
            $query = $query->andFilterWhere($search);
        }

        $data['count'] = $query->count();
        if (!$data['count']) {
            return [
                'count' => 0,
                'curPage' => $curPage,
                'pageSize' => $pageSize,
                'start' => 0,
                'end' => 0,
                'data' => []
            ];
        }

        $curPage = (ceil($data['count'] / $pageSize) < $curPage ? ceil($data['count'] / $pageSize) : $curPage);

        $data['curPage'] = $curPage;
        $data['pageSize'] = $pageSize;
        $data['start'] = ($curPage - 1) * $pageSize + 1;
        $data['end'] = (ceil($data['count'] / $pageSize) === $curPage) ? $data['count'] : ($curPage - 1) * $pageSize + $pageSize;
        $data['data'] = $query->offset(($curPage - 1) * $pageSize)
            ->limit($pageSize)
            ->asArray()
            ->all();

        return $data;
    }
}
