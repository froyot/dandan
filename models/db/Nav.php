<?php

namespace app\models\db;

use Yii;

/**
 * This is the model class for table "{{%nav}}".
 *
 * @property integer $id
 * @property integer $parentid
 * @property string $label
 * @property string $target
 * @property string $href
 * @property string $icon
 * @property integer $status
 * @property integer $listorder
 * @property string $path
 */
class Nav extends \yii\db\ActiveRecord {
    /**
     * @inheritdoc
     */
    public static function tableName() {
        return '{{%nav}}';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['label', 'href'], 'required'],
            [['parentid', 'listorder'], 'integer'],
            [['label', 'href'], 'string', 'max' => 255],
            [['target'], 'string', 'max' => 50],
            [['parentid', 'listorder'], 'default', 'value' => 0],

        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'parentid' => 'Parentid',
            'label' => 'Label',
            'target' => 'Target',
            'status' => 'Status',
            'listorder' => 'Listorder',

        ];
    }
}
