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
use yii\grid\ActionColumn as ParentActionColumn;
/**
 * BaseListView is a base class for widgets displaying data from data provider
 * such as ListView and GridView.
 *
 * It provides features like sorting, paging and also filtering the data.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class ActionColumn extends ParentActionColumn
{

    protected function initDefaultButtons()
    {

        if (!isset($this->buttons['update'])) {
            $this->buttons['update'] = function ($url, $model, $key) {
                return Html::a('<i class="fa fa-pencil"></i>Update', $url, [
                    'title' => Yii::t('yii', 'Update'),
                    'data-pjax' => '0',
                    'class'=>'btn btn-info btn-xs'
                ]);
            };
        }
        if (!isset($this->buttons['delete'])) {
            $this->buttons['delete'] = function ($url, $model, $key) {
                return Html::a('<i class="fa fa-trash-o"></i>Delete', $url, [
                    'title' => Yii::t('yii', 'Delete'),
                    'data-confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),
                    'data-method' => 'post',
                    'data-pjax' => '0',
                    'class'=>'btn btn-danger btn-xs'
                ]);
            };
        }
    }

}
