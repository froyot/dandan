<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace admin\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AdminAsset extends AssetBundle
{
    public $sourcePath = '@admin/static';

    public $baseUrl = '@web';
    public $css = [
        'vendors/font-awesome/css/font-awesome.min.css',
        'vendors/iCheck/skins/flat/green.css',
        'vendors/iCheck/skins/flat/green.css',
        'vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css',
        'css/jquery-jvectormap-2.0.3.css',
        'css/custom.min.css',
        'css/style.css'
    ];





    public $js = [
        'vendors/fastclick/lib/fastclick.js',
        'vendors/nprogress/nprogress.js',
        'vendors/Chart.js/dist/Chart.min.js',
        'vendors/bernii/gauge.js/dist/gauge.min.js',
        'vendors/bootstrap-progressbar/bootstrap-progressbar.min.js',
        'vendors/iCheck/icheck.min.js',
        'vendors/skycons/skycons.js',
        'vendors/Flot/jquery.flot.js',
        'vendors/Flot/jquery.flot.js',
        'vendors/Flot/jquery.flot.pie.js',
        'vendors/Flot/jquery.flot.time.js',
        'vendors/Flot/jquery.flot.stack.js',
        'vendors/Flot/jquery.flot.resize.js',
        'js/flot/jquery.flot.orderBars.js',
        'js/flot/date.js',
        'js/flot/jquery.flot.spline.js',
        'js/flot/curvedLines.js',
        'js/maps/jquery-jvectormap-2.0.3.min.js',
        'js/moment/moment.min.js',
        'js/datepicker/daterangepicker.js',
        'js/custom.js',
        "js/maps/jquery-jvectormap-world-mill-en.js",
        "js/maps/jquery-jvectormap-us-aea-en.js",
        "js/maps/gdp-data.js",
        "js/main.js"
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
