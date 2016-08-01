<?php

namespace admin\modules\posts\models;

use Yii;
use yii\helpers\ArrayHelper;
/**
 * This is the model class for table "{{%posts}}".
 *
 * @property integer $post_id
 * @property string $title
 * @property string $content
 * @property string $abstruct
 * @property string $create_at
 * @property string $update_at
 * @property integer $author_id
 */
class Posts extends \yii\db\ActiveRecord
{
            public $_relates;

                    public function behaviors()
    {
        return ArrayHelper::merge(
            parent::behaviors(),
            [

                [
                    'class'=>'admin\behaviors\CorrelationModel',
                    'model'=>'Posts',
                    'correlations'=>[
                        'category'=>[
                          'type'=>'single',//or 'multinue'
                          'class'=>'admin\modules\category\models\Category',
                          'value_key'=>'cat_id',
                          'label_key'=>'name'
                        ]
                    ],
                    'saveCorrets'=>function(&$relates){
                                $relates = $this->_relates;
                    }
                ],

                [
                    'class'=>'admin\behaviors\StatusModel'
                ],

            ]
        );
    }
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
            [['create_at', 'update_at'], 'safe'],
            [['author_id'], 'integer'],
            [['title', 'abstruct'], 'string', 'max' => 255],
            ['_relates','safe'],
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
