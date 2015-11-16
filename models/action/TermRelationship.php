<?php
namespace app\models\action;
use app\models\db\TermRelationships;

class TermRelationship extends TermRelationships{

    public function getTerm()
    {
        return $this->hasOne(Term::className(),['term_id'=>'term_id']);
    }
}
