<?php
/**
 * 树状构建
 *
 */
namespace app\models\util;
use yii\base\Model;
use yii\helpers\Url;
use Yii;

class TreeItem extends Model{
    public $model;
    public $level;
    public $childs;

    public function rules()
    {
        return[
            [['model','level','childs'],'safe']
        ];
    }
}
