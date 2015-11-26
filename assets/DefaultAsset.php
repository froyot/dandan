<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class DefaultAsset extends AssetBundle {
    public static $assertUrl;
    public $sourcePath = '@webroot/static';
    public $css = [
        'css/site.css',
    ];
    public $js = [

    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];

    public function addPageScript($view, $jsFile) {
        $view->registerJsFile($this->getAssetUrl($view) . $jsFile, [DefaultAsset::className(), 'depends' => 'app\assets\DefaultAsset']);
    }
    public function addScript($view, $jsFile) {
        $view->registerJsFile($jsFile, [DefaultAsset::className(), 'depends' => 'app\assets\DefaultAsset']);
    }
    public function addPageCssFile($view, $cssFiel) {
        $view->registerCssFile($this->getAssetUrl($view) . $cssFiel);
    }

    private function getAssetUrl($view) {
        if (!self::$assertUrl) {
            $assertManage = $view->getAssetManager();
            self::$assertUrl = $assertManage->getAssetUrl($this, '');
        }
        return self::$assertUrl;
    }

}
