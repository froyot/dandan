<?php
namespace app\common\widgets;

use yii\widgets\ListView as BaseListView;

class ListView extends BaseListView{
    public $layout = "{items}\n{pager}";
}
