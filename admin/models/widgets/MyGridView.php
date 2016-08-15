<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace admin\models\widgets;
use yii\grid\GridView;
use Yii;

use yii\base\InvalidConfigException;
use yii\base\Widget;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\DataColumn;

/**
 * BaseListView is a base class for widgets displaying data from data provider
 * such as ListView and GridView.
 *
 * It provides features like sorting, paging and also filtering the data.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class MyGridView extends GridView
{
    public $tableOptions = ['class' => 'table table-striped'];

    /**
     * This function tries to guess the columns to show from the given data
     * if [[columns]] are not explicitly specified.
     */
    protected function guessColumns()
    {
        $models = $this->dataProvider->getModels();
        $model = reset($models);
        $columns = [];
        if (is_array($model) || is_object($model)) {
            foreach ($model as $name => $value) {
                $columns[] = $name;
            }
        }
        return $columns;
    }

    protected function mergeColum()
    {

        $guessColumns = $this->guessColumns();
        $configColums = [];
        $hiddenColums = [];
        $addColum = [];
        foreach ($this->columns as $key => $colum) {
           if(is_array($colum))
           {
            if(isset($colum['show']) && $colum['show'] === false)
            {
                $hiddenColums[$colum['attribute']] = 1;
                continue;
            }
            if(isset($colum['attribute']))
            {
                $configColums[$colum['attribute']] = $colum;
            }
            else
            {
                $addColum[] = $colum;
            }
           }
        }


        $this->columns = [];
        $this->columns[] = ['class' => 'yii\grid\SerialColumn'];

        foreach ($guessColumns as $key => $name) {
            if(isset($hiddenColums[$name]))
            {
                continue;
            }
            if(isset($configColums[$name]))
            {
                $this->columns[] = $configColums[$name];
            }
            else
            {

                if($name == 'status')
                {
                    $statusColum = [
                        'attribute'=>'status',
                        'format' => 'raw',
                        'value'=>function($model)
                        {
                            return Html::tag('button',$model->status?'Used':'Not Used',['type'=>'button','class'=>'btn btn-xs status-btn'.($model->status?' btn-success':' btn-error'),'data-id'=>$model->getPrimaryKey()]);
                            // return $model->status;
                        }
                    ];
                    $this->columns[] = $statusColum;
                }
                else
                {

                    $this->columns[] = $name;
                }
            }
        }
        $this->columns = ArrayHelper::merge($this->columns,$addColum);

    }


    /**
     * Creates column objects and initializes them.
     */
    protected function initColumns()
    {
        $this->mergeColum();
        foreach ($this->columns as $i => $column) {
            if (is_string($column)) {
                $column = $this->createDataColumn($column);
            } else {
                $column = Yii::createObject(array_merge([
                    'class' => $this->dataColumnClass ? : DataColumn::className(),
                    'grid' => $this,
                ], $column));
            }
            if (!$column->visible) {
                unset($this->columns[$i]);
                continue;
            }
            $this->columns[$i] = $column;
        }
    }


}
