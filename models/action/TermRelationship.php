<?php
/**
 * relation between post and term model
 */
namespace app\models\action;
use app\models\db\TermRelationships;

class TermRelationship extends TermRelationships {

    public function getTerm() {
        return $this->hasOne(Term::className(), ['term_id' => 'term_id']);
    }

    public function init() {
        parent::init();
        $this->on(self::EVENT_AFTER_INSERT, [$this, 'afterDataInsert']);
        $this->on(self::EVENT_AFTER_UPDATE, [$this, 'afterDataUpdate']);
        $this->on(self::EVENT_AFTER_DELETE, [$this, 'afterDataDelete']);
    }

    /**
     * relation event handler for data insert
     * to add count in term
     * @author Allon<xianlong300@sina.com>
     * @dateTime 2015-11-24T15:22:28+0800
     * @param    [type]                   $event [description]
     */
    public function afterDataInsert($event) {
        $term = Term::findOne(['term_id' => $event->sender->term_id]);
        if ($term) {
            $term->updateCounters(['count' => 1]);
        }

    }

    /**
     * relation event handler for data update
     * to add one for new term and multi one for older
     *
     * @author Allon<xianlong300@sina.com>
     * @dateTime 2015-11-24T15:23:04+0800
     * @param    [type]                   $event [description]
     */
    public function afterDataUpdate($event) {
        $term = Term::findOne(['term_id' => $event->sender->term_id]);
        if ($term) {
            $term->updateCounters(['count' => 1]);
        }

        $olds = $event->sender->getOldAttributes();
        if ($olds['term_id'] != $event->sender->term_id) {
            $term = Term::findOne(['term_id' => $olds['term_id']]);
            if ($term) {
                $term->updateCounters(['count' => -1]);
            }
        }
    }

    /**
     * relation event handelr for data delte
     * @author Allon<xianlong300@sina.com>
     * @dateTime 2015-11-24T15:24:25+0800
     */
    public function afterDataDelete($event) {
        $term = Term::findOne(['term_id' => $event->sender->term_id]);

        if ($term && $term->count > 0) {
            $term->updateCounters(['count' => -1]);
        }
    }
}
