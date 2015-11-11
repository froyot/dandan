<?php

namespace app\models\db;

use Yii;

/**
 * This is the model class for table "{{%term_relationships}}".
 *
 * @property string $tid
 * @property string $object_id
 * @property string $term_id
 * @property integer $listorder
 * @property integer $status
 */
class TermRelationships extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%term_relationships}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['object_id', 'term_id', 'listorder', 'status'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'tid' => 'Tid',
            'object_id' => 'Object ID',
            'term_id' => 'Term ID',
            'listorder' => 'Listorder',
            'status' => 'Status',
        ];
    }
}
