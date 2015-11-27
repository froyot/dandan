<?php
namespace app\models\action;
use app\models\db\Terms;
use Yii;

class Term extends Terms {
    public function init() {
        parent::init();
        $this->on(self::EVENT_AFTER_INSERT, [$this, 'afterInsert']);
        $this->on(self::EVENT_AFTER_UPDATE, [$this, 'afterUpdate']);
        $this->on(self::EVENT_AFTER_DELETE, [$this, 'afterDeleteData']);
    }

    /**
     * 分类插入后操作
     * @param  [type] $event [description]
     * @return [type]        [description]
     */
    public function afterInsert($event) {
        $event->sender->updatePath();
    }

    /**
     * 分类更新后操作
     * @param  [type] $event [description]
     * @return [type]        [description]
     */
    public function afterUpdate($event) {
        if (isset($event->changedAttributes['parent'])) {
            $event->sender->updatePath();
        }
    }

    /**
     * 自动更新path
     * @return [type] [description]
     */
    public function updatePath() {
        // if ($this->parent == 0) {
        //     $this->path = '0-' . $this->term_id;
        //     $this->save();
        // } else {
        //     $parent = self::find()
        //         ->where(['term_id' => $this->parent])
        //         ->select('path')
        //         ->one();
        //     if ($parent) {
        //         $parentPath = $parent->path;
        //         $this->path = $parentPath . '-' . $this->term_id;
        //         $this->off(self::EVENT_AFTER_UPDATE);
        //         $this->save();
        //     }
        // }
    }

    /**
     * 数据删除后删除子分类
     * @param  [type] $event [description]
     * @return [type]        [description]
     */
    public function afterDeleteData($event) {
        $child = self::find()
            ->where(['parent' => $event->sender->term_id])
            ->select('term_id')
            ->all();
        if ($child) {
            foreach ($child as $key => $obj) {
                $obj->delete();
            }
        }
    }

    public function attributeLabels() {
        $label = parent::attributeLabels();
        foreach ($label as $key => $item) {
            $label[$key] = Yii::t('app', $key);
        }
        return $label;
    }
}
