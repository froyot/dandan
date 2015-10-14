<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\themes\tfviolet;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class ThemeAsset extends AssetBundle
{
    public $sourcePath = '@app/themes/tfviolet/static';
    public $css = [

        'css/materialize.min.css',
        'css/style.css'
    ];

    public $js = [
        'js/materialize.min.js'
    ];

}
