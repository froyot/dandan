<?php

namespace app\models\db;

use Yii;

/**
 * This is the model class for table "{{%guestbook}}".
 *
 * @property integer $id
 * @property string $full_name
 * @property string $email
 * @property string $title
 * @property string $msg
 * @property string $createtime
 * @property integer $status
 */
class Guestbook extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%guestbook}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['full_name', 'email', 'msg', 'createtime'], 'required'],
            [['msg'], 'string'],
            [['createtime'], 'safe'],
            [['status'], 'integer'],
            [['full_name'], 'string', 'max' => 50],
            [['email'], 'string', 'max' => 100],
            [['title'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'full_name' => 'Full Name',
            'email' => 'Email',
            'title' => 'Title',
            'msg' => 'Msg',
            'createtime' => 'Createtime',
            'status' => 'Status',
        ];
    }
}
