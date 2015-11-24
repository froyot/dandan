<?php
/**
 * Tree data builder
 *
 */
namespace app\models\util;
use Yii;
use yii\base\Model;

class Tree extends Model {
    /**
     * the model name want to builder tree
     * @var string
     */
    public $model;

    /**
     * the parent key name in model
     * @var string
     */
    public $parentKey;

    /**
     * model primary key name
     * @var string
     */
    public $primaryKey;

    /**
     * the root node parent value
     * @var int
     */
    public $rootParent;

    /**
     * orderBy , order method
     * @var string
     */
    public $orderBy;

    /**
     * $tree, bulded tree array
     * @var array
     */
    public $tree = [];

    /**
     * raw model data
     * @var array
     */
    private $data;

    /**
     * model init
     * @author Allon<xianlong300@sina.com>
     * @dateTime 2015-11-24T14:46:19+0800
     */
    public function init() {
        parent::init();
        $this->model = Yii::createObject($this->model);
    }

    /**
     * get raw data from model
     * @author Allon<xianlong300@sina.com>
     * @dateTime 2015-11-24T14:46:45+0800
     */
    private function getDatas() {
        $query = $this->model->find();
        if ($this->orderBy) {
            $query = $query->orderBy($this->orderBy);
        }

        $this->data = $query->all();
    }

    /**
     * make tree data
     * @author Allon<xianlong300@sina.com>
     * @dateTime 2015-11-24T14:47:06+0800
     * @param    int                   $parent parent value
     * @param    integer                  $level  tree leve
     */
    private function makeTree($parent, $level = 0) {
        foreach ($this->data as $key => $nav) {
            if (!$this->parentKey) {
                $treeItem = new TreeItem();
                $treeItem->attributes = [
                    'model' => $nav,
                    'level' => $level,
                ];
                $this->tree[] = $treeItem;
            } elseif ($nav->{$this->parentKey} == $parent) {
                $treeItem = new TreeItem();
                $treeItem->attributes = [
                    'model' => $nav,
                    'level' => $level,
                ];
                $this->tree[] = $treeItem;
                $childLevel = $level + 1;
                $this->makeTree($nav->{$this->primaryKey}, $childLevel);
            }
        }
    }

    /**
     * make a tree, child in parent node
     * @author Allon<xianlong300@sina.com>
     * @dateTime 2015-11-24T14:54:56+0800
     * @param    int                   $parentid parent id
     * @param    integer                  $level    tree level
     * @return   data                               tree data
     */
    private function makeChildTree($parentid, $level = 0) {
        $data = [];
        foreach ($this->data as $key => $nav) {
            if ($nav->parentid == $parentid) {
                $treeItem = new TreeItem();
                $childLevel = $level + 1;
                $treeItem->attributes = [
                    'model' => $nav,
                    'level' => $level,
                    'childs' => $this->makeChildTree(
                        $nav->{$this->primaryKey},
                        $childLevel
                    ),
                ];
                $data[] = $treeItem;
            }
        }
        return $data;
    }

    /**
     * get tree data
     * if $childTree is false, child tree while append after parent
     * else child tree is one element in parent
     * @author Allon<xianlong300@sina.com>
     * @dateTime 2015-11-24T14:50:36+0800
     * @param    boolean                  $childTree   if need to get child tree
     * @return   array                    $this->tree  tree model data
     */
    public function getTree($childTree = false) {
        $this->getDatas();
        if ($childTree) {
            return $this->makeChildTree($this->rootParent);
        } else {
            $this->makeTree($this->rootParent);
            return $this->tree;
        }

    }

    /**
     * get DropDown data from tree
     * @author Allon<xianlong300@sina.com>
     * @dateTime 2015-11-24T14:55:48+0800
     * @param    array                   $config  tree model config
     * @param    array                    $option display config
     * @return   array                          DropDown data
     */
    public function makeDropDown($config, $option = []) {
        // some default option
        $primaryKey = 'id';
        $labelKey = 'name';
        $icon = '';
        $levelChar = '';

        $obj = new Tree($config);
        $tree = $obj->getTree();

        if (isset($option['value'])) {
            $primaryKey = $option['value'];
        }

        if (isset($option['label'])) {
            $labelKey = $option['label'];
        }

        if (isset($option['icon'])) {
            $icon = $option['icon'];
        }

        if (isset($option['levelChar'])) {
            $levelChar = $option['levelChar'];
        }

        $data = [];
        foreach ($tree as $key => $item) {
            $data[$item->model->{$primaryKey}] =
            str_repeat($levelChar, $item->level) .
            $icon . $item->model->{$labelKey};
        }
        return $data;

    }
}
