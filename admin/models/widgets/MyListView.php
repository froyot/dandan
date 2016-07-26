<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace admin\models\widgets;
use yii\widgets\BaseListView;
use Yii;

use yii\base\InvalidConfigException;
use yii\base\Widget;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
/**
 * BaseListView is a base class for widgets displaying data from data provider
 * such as ListView and GridView.
 *
 * It provides features like sorting, paging and also filtering the data.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class MyListView extends BaseListView
{

    public $showHeader = true;
    public $beforeRow = null;
    public $afterRow = null;
    public $tableOptions = ['class'=>"table table-striped"];
    private $dataModels = [];
    private $dataColumns = [];
    public function init()
    {
        parent::init();
        $this->dataModels = array_values($this->dataProvider->getModels());
        if($this->dataModels[0])
        {

            $model = reset($this->dataModels);
            if (is_array($model) || is_object($model)) {
                $this->dataColumns[] = "Index";
                foreach ($model as $name => $value) {
                   $this->dataColumns[] = $name;
                }
                $this->dataColumns[] = "Action";
            }
        }

    }
    private function renderHeader()
    {
        $thead = "<thead><tr>";
        foreach ($this->dataColumns as $key => $column) {
            $thead .= "<th>".$column."</th>";
        }
        $thead .="</tr></thead>";
        return $thead;
    }

    private function renderRow($model, $key, $index)
    {
            $tr = '<tr><td>'.($index+1).'</td>';
            foreach ($model as $name => $value) {

                if($name == 'status')
                {
                    $tr .='<td><button type="button" class="btn btn-success btn-xs status-btn" data-id="'.$model->getPrimarykey().'">'.($value?"Used":"not used").'</button></td>';
                }
                else
                {
                    $tr .='<td>'.$value.'</td>';
                }

            }
            $tr .='<td><a href="'.Url::to([$model->ClassName().'/update','id'=>$model->getPrimarykey()]).'" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit </a><a href="'.Url::to([$model->ClassName().'/delete','id'=>$model->getPrimarykey()]).'" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Delete </a></td>';
            $tr .='</tr>';

            return $tr;

    }

    private function renderBody()
    {
        $models = $this->dataModels;
        $keys = $this->dataProvider->getKeys();
        $rows = [];
        foreach ($models as $index => $model) {
            $key = $keys[$index];
            if ($this->beforeRow !== null) {
                $row = call_user_func($this->beforeRow, $model, $key, $index, $this);
                if (!empty($row)) {
                    $rows[] = $row;
                }
            }

            $rows[] = $this->renderRow($model, $key, $index);

            if ($this->afterRow !== null) {
                $row = call_user_func($this->afterRow, $model, $key, $index, $this);
                if (!empty($row)) {
                    $rows[] = $row;
                }
            }
        }

        if (empty($rows)) {
            $colspan = count($this->columns);

            return "\n" . $this->renderEmpty() . "\n";
        } else {
            return "\n" . implode("\n", $rows) . "\n";
        }
    }


    /**
     * Renders the data models for the grid view.
     */
    public function renderItems()
    {

        $header = $this->showHeader ? $this->renderHeader() : false;
        $body = "<tbody>".$this->renderBody()."</tbody>";
        return Html::tag('table', $header.$body, $this->tableOptions);
    }
}
