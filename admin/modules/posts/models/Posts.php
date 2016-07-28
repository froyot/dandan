<?php

namespace admin\modules\posts\models;

use Yii;

/**
 * This is the model class for table "{{%posts}}".
 *
 * @property integer $post_id
 * @property string $title
 * @property string $content
 * @property string $abstruct
 * @property integer $create_at
 * @property integer $update_at
 * @property integer $author_id
 */
class Posts extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%posts}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'content', 'abstruct', 'create_at', 'update_at', 'author_id'], 'required'],
            [['content'], 'string'],
            [['create_at', 'update_at', 'author_id'], 'integer'],
            [['title', 'abstruct'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'post_id' => 'Post ID',
            'title' => 'Title',
            'content' => 'Content',
            'abstruct' => 'Abstruct',
            'create_at' => 'Create At',
            'update_at' => 'Update At',
            'author_id' => 'Author ID',
        ];
    }
}
