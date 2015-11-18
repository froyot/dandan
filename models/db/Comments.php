<?php

namespace app\models\db;

use Yii;

/**
 * This is the model class for table "{{%comments}}".
 *
 * @property string $id
 * @property string $post_table
 * @property string $post_id
 * @property string $url
 * @property integer $uid
 * @property integer $to_uid
 * @property string $full_name
 * @property string $email
 * @property string $createtime
 * @property string $content
 * @property integer $type
 * @property string $parentid
 * @property string $path
 * @property integer $status
 */
class Comments extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%comments}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['post_table', 'content'], 'required'],
            [['post_id', 'uid', 'to_uid', 'type', 'parentid', 'status'], 'integer'],
            [['createtime'], 'safe'],
            [['content'], 'string'],
            [['post_table'], 'string', 'max' => 100],
            [['url', 'email'], 'string', 'max' => 255],
            [['full_name'], 'string', 'max' => 50],
            [['path'], 'string', 'max' => 500]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'post_table' => 'Post Table',
            'post_id' => 'Post ID',
            'url' => 'Url',
            'uid' => 'Uid',
            'to_uid' => 'To Uid',
            'full_name' => 'Full Name',
            'email' => 'Email',
            'createtime' => 'Createtime',
            'content' => 'Content',
            'type' => 'Type',
            'parentid' => 'Parentid',
            'path' => 'Path',
            'status' => 'Status',
        ];
    }
}
