<?php

namespace easydandan\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{

    public $sourcePath = '@easydandan/static';
    public $css = [
        "css/font-awesome.min.css",
        "css/ace.min.css",
        "css/ace-rtl.min.css",
        "css/ace-skins.min.css"
    ];
    public $js = [

        "js/typeahead-bs2.min.js",



        "js/ace-elements.min.js",
        "js/ace.min.js",
        "js/admin.js"
    ];

    public $depends = [

        'yii\bootstrap\BootstrapPluginAsset',

    ];
    // public $jsOptions = array(
    //     'position' => \yii\web\View::POS_HEAD
    // );
}
