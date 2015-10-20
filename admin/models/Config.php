<?php

namespace app\admin\models;

use Yii;
use app\models\db\Config as ConfigModel;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%config}}".
 *
 * @property string $key
 * @property string $value
 */
class Config extends ConfigModel
{
    public function rules()
    {
        return ArrayHelper::merge(parent::rules(),[
                [
                'key','in','range'=>[
                        'slide',
                        'leftAd',
                        'footerContent',
                        'links',
                        'author',
                        'copyRight',
                        'sysName'
                    ]
                ]
            ]);
    }
    public function deleteSlide($id)
    {
        $slide = Config::findOne(['key'=>'slide']);
        if( !$slide )
            return;
        $slideContents = explode(',', $slide->value);
        if( !is_array($slideContents) )
            $slideContents = [$slideContents];

        foreach ($slideContents as $key => $value)
        {
            if( $value == $id )
            {
                unset($slideContents[$key]);
            }
        }
        if( !$slideContents )
            $slide->value = '';
        else
            $slide->value = implode(',', $slideContents);
        return $slide->save();
    }
}
