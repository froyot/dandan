<?php
namespace app\models\action;
use app\models\db\TermRelationships;

class TermRelationship extends TermRelationships{

    public function getTerm()
    {
        return $this->hasOne(Term::className(),['term_id'=>'term_id']);
    }

    public function init()
    {
        parent::init();
        $this->on(self::EVENT_AFTER_INSERT,[$this,'afterDataInsert']);
        $this->on(self::EVENT_AFTER_UPDATE,[$this,'afterDataUpdate']);
        $this->on(self::EVENT_AFTER_DELETE,[$this,'afterDataDelete']);
    }

    public function afterDataInsert( $event )
    {
        $term = Term::findOne(['term_id'=>$event->sender->term_id]);
        if( $term )
        {
           $term->updateCounters(['count' => 1]);
        }

    }

    public function afterDataUpdate( $event )
    {
        $term = Term::findOne(['term_id'=>$event->sender->term_id]);
        if( $term )
        {
           $term->updateCounters(['count' => 1]);
        }

        $olds = $event->sender->getOldAttributes();
        if($olds['term_id'] != $event->sender->term_id)
        {
            $term = Term::findOne(['term_id'=>$olds['term_id']]);
            if( $term )
            {
               $term->updateCounters(['count' => -1]);
            }
        }
    }

    public function afterDataDelete( $event )
    {
        $term = Term::findOne(['term_id'=>$event->sender->term_id]);

        if( $term && $term->count > 0 )
        {
           $term->updateCounters(['count' => -1]);
        }
    }
}
