<?php

namespace app\models\action;

use Yii;
use app\models\db\Nav as NavDb;
class Nav extends NavDb
{
    public function init()
    {
        parent::init();
        $this->on(self::EVENT_AFTER_INSERT,[$this,'afterDataSave']);
        $this->on(self::EVENT_AFTER_UPDATE,[$this,'afterDataSave']);
        $this->on(self::EVENT_AFTER_DELETE,[$this,'afterDataDelete']);
    }
    public function attributeLabels()
    {
        $label = parent::attributeLabels();
        foreach( $label as $key => $item )
        {
            $label[$key] = Yii::t('app',$key);
        }
        return $label;
    }


    public function afterDataSave( $event )
    {
        //update path
        if( !$event->sender->parentid )
        {
            $this->parentid = 0;
        }
        $parent = Nav::find()
                    ->where(['id'=>$event->sender->parentid])
                    ->select(['path'])
                    ->one();
        if($parent)
        {
            $event->sender->path = $parent->path.'-'.$event->sender->getPrimaryKey();
        }
        else
        {
            $event->sender->path = '0-'.$event->sender->getPrimaryKey();
        }

        $event->sender->off(self::EVENT_AFTER_INSERT);
        $event->sender->off(self::EVENT_AFTER_UPDATE);
        $event->sender->save();

        //删除菜单缓存
        Yii::$app->cacheManage->site_menu = null;
    }

    public function afterDataDelete()
    {
        //删除菜单缓存
        Yii::$app->cacheManage->site_menu = null;
    }


}
