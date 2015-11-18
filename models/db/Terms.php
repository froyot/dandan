<?php

namespace app\models\db;

use Yii;

/**
 * This is the model class for table "{{%terms}}".
 *
 * @property string $term_id
 * @property string $name
 * @property string $slug
 * @property string $taxonomy
 * @property string $description
 * @property string $parent
 * @property string $count
 * @property string $path
 * @property string $seo_title
 * @property string $seo_keywords
 * @property string $seo_description
 * @property string $list_tpl
 * @property string $one_tpl
 * @property integer $listorder
 * @property integer $status
 */
class Terms extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%terms}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['description'], 'string'],
            [['parent', 'count', 'listorder', 'status'], 'integer'],
            [['name', 'slug'], 'string', 'max' => 200],
            [['taxonomy'], 'string', 'max' => 32],
            ['taxonomy','in','range'=>['article','img']],
            [['path', 'seo_title', 'seo_keywords', 'seo_description'], 'string', 'max' => 500],
            [['list_tpl', 'one_tpl'], 'string', 'max' => 50],
            [['name'],'required'],
            ['status','default','value'=>1]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'term_id' => 'Term ID',
            'name' => 'Name',
            'slug' => 'Slug',
            'taxonomy' => 'Taxonomy',
            'description' => 'Description',
            'parent' => 'Parent',
            'count' => 'Count',
            'path' => 'Path',
            'seo_title' => 'Seo Title',
            'seo_keywords' => 'Seo Keywords',
            'seo_description' => 'Seo Description',
            'list_tpl' => 'List Tpl',
            'one_tpl' => 'One Tpl',
            'listorder' => 'Listorder',
            'status' => 'Status',
        ];
    }

    public static function getCategory( $id )
    {
        return self::findOne(['term_id'=>$id]);
    }
}
