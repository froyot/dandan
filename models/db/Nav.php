<?php

namespace app\models\db;

use Yii;

/**
 * This is the model class for table "{{%nav}}".
 *
 * @property integer $id
 * @property integer $cid
 * @property integer $parentid
 * @property string $label
 * @property string $target
 * @property string $href
 * @property string $icon
 * @property integer $status
 * @property integer $listorder
 * @property string $path
 */
class Nav extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%nav}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cid', 'parentid', 'label', 'href', 'icon'], 'required'],
            [['cid', 'parentid', 'status', 'listorder'], 'integer'],
            [['label', 'href', 'icon', 'path'], 'string', 'max' => 255],
            [['target'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'cid' => 'Cid',
            'parentid' => 'Parentid',
            'label' => 'Label',
            'target' => 'Target',
            'href' => 'Href',
            'icon' => 'Icon',
            'status' => 'Status',
            'listorder' => 'Listorder',
            'path' => 'Path',
        ];
    }
}
