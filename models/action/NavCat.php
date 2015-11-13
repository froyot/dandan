<?php

namespace app\models\action;

use Yii;
use app\models\db\NavCat as NavCatDb;
use yii\helpers\ArrayHelper;
class NavCat extends NavCatDb
{
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        $label = parent::attributeLabels();
        foreach( $label as $key => $item )
        {
            $label[$key] = Yii::t('app',$key);
        }
        return $label;
    }

    public function rules()
    {
        return ArrayHelper::merge(
            parent::rules(),
            [
                [['name'], 'unique']
            ]
        );
    }
}
