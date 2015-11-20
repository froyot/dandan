<?php
/**
 * 树状构建
 *
 */
namespace app\models\util;
use yii\base\Model;
use yii\helpers\Url;
use Yii;

class Tree extends Model{

public $model;
public $parentKey;
public $primaryKey;
public $rootParent;
public $orderBy;

public $tree = [];

private $data;

    public function init()
    {
        parent::init();
        $this->model = Yii::createObject($this->model);
    }

    private function getDatas()
    {
        $query = $this->model->find();
        if( $this->orderBy )
            $query = $query->orderBy($this->orderBy);
        $this->data = $query->all();
    }

    private function makeTree( $parent, $level = 0 )
    {
        foreach ($this->data as $key => $nav)
        {
            if(!$this->parentKey)
            {
                $treeItem = new TreeItem();
                $treeItem->attributes = [
                  'model'=> $nav,
                  'level'=> $level
                ];
                $this->tree[] = $treeItem;
            }
            elseif( $nav->{$this->parentKey} == $parent )
            {
                $treeItem = new TreeItem();
                $treeItem->attributes = [
                  'model'=> $nav,
                  'level'=> $level
                ];
                $this->tree[] = $treeItem;
                $childLevel = $level+1;
                $this->makeTree( $nav->{$this->primaryKey}, $childLevel );
            }
        }
    }

    private function makeChildTree( $parentid, $level = 0)
    {
        $data = [];
        foreach ($this->data as $key => $nav)
        {
            if( $nav->parentid == $parentid )
            {
                $treeItem = new TreeItem();
                $childLevel = $level+1;
                $treeItem->attributes = [
                  'model'=> $nav,
                  'level'=> $level,
                  'childs'=>$this->makeChildTree( $nav->{$this->primaryKey}, $childLevel )
                ];
                $data[] = $treeItem;
            }
        }
        return $data;
    }

    public function getTree( $childTree = false)
    {
        $this->getDatas();
        if( $childTree )
        {
            return $this->makeChildTree($this->rootParent);
        }
        else
        {
            $this->makeTree( $this->rootParent );
            return $this->tree;
        }

    }

    public function makeDropDown( $config, $option = [] )
    {
        $primaryKey = 'id';
        $labelKey = 'name';
        $icon = '';
        $levelChar = '';

        $obj = new Tree( $config );
        $tree = $obj->getTree();

        if( isset( $option['value'] ))
        {
            $primaryKey = $option['value'];
        }

        if( isset( $option['label'] ))
        {
            $labelKey = $option['label'];
        }

        if( isset( $option['icon'] ))
        {
            $icon = $option['icon'];
        }

        if( isset( $option['levelChar'] ))
        {
            $levelChar = $option['levelChar'];
        }

        $data = [];
        foreach ($tree as $key => $item)
        {
            $data[$item->model->{$primaryKey}] =
            str_repeat($levelChar, $item->level).$icon.$item->model->{$labelKey};
        }
        return $data;


    }
}
