<?php

namespace app\models\posts;

use Yii;
use app\models\user\UserRecord as User;

/**
 * This is the model class for table "posts".
 *
 * @property integer $post_id
 * @property string $post_title
 * @property string $post_description
 * @property integer $author_id
 *
 * @property User $author
 */
class Posts extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'posts';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['post_description'], 'string'],
            [['author_id'], 'required'],
            [['author_id'], 'integer'],
            [['post_title'], 'string', 'max' => 255],
            [['author_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['author_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'post_id' => 'Post ID',
            'post_title' => 'Post Title',
            'post_description' => 'Post Description',
            'author_id' => 'Author Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor()
    {
        return $this->hasOne(User::className(), ['id' => 'author_id']);
    }
}
