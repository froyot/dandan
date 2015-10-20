<?php
namespace allon\yii2\ueditor;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\widgets\InputWidget;

class Ueditor extends InputWidget
{
    public $attributes;
    public $inputOptions;
    public function init()
    {
        \Yii::setAlias('@Ueditor',__DIR__);
        parent::init();
    }

    public function run()
    {
        $view = $this->getView();
        $this->attributes['id']=$this->options['id'];
        if($this->hasModel())
        {
            $input=Html::activeTextarea($this->model, $this->attribute,$this->inputOptions);
        }
        else
        {
            $input=Html::textarea($this->name,'',$this->attributes);
        }
        UeditorAsset::register($view);//将Ueditor用到的脚本资源输出到视图
        $js='var ue = UE.getEditor("'.$this->options['id'].'",'.$this->getOptions().');';//Ueditor初始化脚本
        $view->registerJs($js, $view::POS_END);//将Ueditor初始化脚本也响应到视图中
        echo $input;
    }

    public function getOptions()
    {
        unset($this->options['id']);//Ueditor识别不了id属性,故而删之
        return Json::encode($this->options);
    }
}
