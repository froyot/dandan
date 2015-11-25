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
 * @property integer $listorder
 */
class Terms extends \yii\db\ActiveRecord {
    /**
     * @inheritdoc
     */
    public static function tableName() {
        return '{{%terms}}';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['description'], 'string'],
            [['parent', 'count', 'listorder', 'status'], 'integer'],
            [['name', 'slug'], 'string', 'max' => 200],
            [['taxonomy'], 'string', 'max' => 32],
            ['taxonomy', 'in', 'range' => ['article', 'img']],
            [['name'], 'required'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'term_id' => 'Term ID',
            'name' => 'Name',
            'slug' => 'Slug',
            'taxonomy' => 'Taxonomy',
            'description' => 'Description',
            'parent' => 'Parent',
            'count' => 'Count',

            'listorder' => 'Listorder',
        ];
    }

    public static function getCategory($id) {
        return self::findOne(['term_id' => $id]);
    }
}
