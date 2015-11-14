<?php

namespace app\models\action;

use Yii;
use app\models\db\Nav as NavDb;
class Nav extends NavDb
{
    public function init()
    {
        parent::init();
        $this->on(self::EVENT_AFTER_INSERT,[$this,'afterInsert']);
        $this->on(self::EVENT_AFTER_INSERT,[$this,'afterInsert']);
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

    public function afterInsert( $event )
    {
        $event->sender->updatePath( );
    }
    public function afterUpdate( $event )
    {
        $event->sender->updatePath( );
    }
    private function updatePath()
    {
        if( $this->parentid )
        {
            $this->parentid = 0;
        }
        $this->path = $this->parentid.'-'.$this->getPrimaryKey();
        $this->save();
    }
}
