<?php

namespace app\models\db;

use Yii;
use yii\helpers\Url;

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
            [['created_at', 'updated_at'], 'safe'],
            [['title', 'content'], 'required'],
            [['content'], 'string'],
            [['created_by','updated_by'], 'integer'],
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
            'updated_at' => 'Updated At',
            'title' => 'Title',
            'content' => 'Content',
            'created_by' => 'Created By',
            'updated_by' => 'Updated_by',
            'others' => 'Others',
        ];
    }

    public function getRelations()
    {
        return $this->hasMany(Relation::className(),['content_id'=>'id']);
    }

    //从内容中获取摘要
    public function getAbstruct($length = 300)
    {
        if($length> 300)
            $length = 300;
        $data =  strip_tags($this->content);
        return mb_substr($data, 0,$length);
    }

    public function getLinks( $id )
    {
        $links = [];
        $model = Content::find()->where(['<','id',$id])->one();
        if($model)
        {
            $links['pre'] = [
                'title'=>$model->title,
                'url'=>Url::to(['content/view','id'=>$model->id])
            ];
        }
        $model = Content::find()->where(['>','id',$id])->one();
        if($model)
        {
            $links['next'] = [
                'title'=>$model->title,
                'url'=>Url::to(['content/view','id'=>$model->id])
            ];
        }
        return $links;
    }
}
