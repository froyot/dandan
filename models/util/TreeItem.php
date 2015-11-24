<?php
/**
 * tree item model
 *
 */
namespace app\models\util;
use yii\base\Model;

class TreeItem extends Model {
    /**
     * current model item
     * @var model
     */
    public $model;

    /**
     * tree level
     * @var int
     */
    public $level;

    /**
     * child item,if not is null
     * @var maxid
     */
    public $childs;

    public function rules() {
        return [
            [['model', 'level', 'childs'], 'safe'],
        ];
    }
}
