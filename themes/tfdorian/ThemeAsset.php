<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\themes\tfdorian;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class ThemeAsset extends AssetBundle
{
    public $sourcePath = '@app/themes/tfdorian/static';
    public $css = [
        'css/style.css',
        'css/materialize.min.css'
    ];
    public $js = [
        'js/materialize.min.js',
    ];
}
