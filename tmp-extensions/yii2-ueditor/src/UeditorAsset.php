<?php
namespace allon\yii2\ueditor;

use yii\web\AssetBundle;

class UeditorAsset extends AssetBundle
{
    public $js = [
        'ueditor.config.js',
        'ueditor.all.js',
    ];
    public $css = [
    ];
    public function init()
    {
        $this->sourcePath =\Yii::getAlias('@Ueditor').'/ueditor'; //设置资源所处的目录
    }
}
