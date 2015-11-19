<?php
namespace app\models\action;

use Yii;
use app\models\db\SlideCat as SlideCatDb;
class SlideCat extends SlideCatDb
{
    public function attributeLabels()
    {
        $label = parent::attributeLabels();
        foreach( $label as $key => $item )
        {
            $label[$key] = Yii::t('app',$key);
        }
        return $label;
    }
}
