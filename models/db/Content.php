<?php

namespace app\models\db;

use Yii;

/**
 * This is the model class for table "{{%content}}".
 *
 * @property integer $id
 * @property string $created_at
 * @property string $update_at
 * @property string $title
 * @property string $content
 * @property integer $create_by
 * @property string $others
 */
class Content extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%content}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created_at', 'update_at'], 'safe'],
            [['title', 'content', 'create_by'], 'required'],
            [['content'], 'string'],
            [['create_by'], 'integer'],
            [['title', 'others'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'created_at' => 'Created At',
            'update_at' => 'Update At',
            'title' => 'Title',
            'content' => 'Content',
            'create_by' => 'Create By',
            'others' => 'Others',
        ];
    }

    public function getRelations()
    {
        return $this->hasMany(Relation::className(),['content_id'=>'id']);
    }

    //从内容中获取摘要
    public function getAbstruct()
    {
        $data =  strip_tags($this->content);
        return mb_substr($data, 0,300);
    }
}
