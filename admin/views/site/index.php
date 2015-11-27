<?php
use app\assets\DefaultAsset;
use app\models\util\ViewHelper;

/* @var $this yii\web\View */
$this->title = ViewHelper::getSiteOption('site_seo_title');
$_description = ViewHelper::getSiteOption('site_seo_description');
$_keywords = ViewHelper::getSiteOption('site_seo_keywords');

$bundle = DefaultAsset::register($this);
$this->registerMetaTag(['name' => 'description', 'content' => $_description]);
$this->registerMetaTag(['name' => 'description', 'content' => $_keywords]);
?>
<div>
    <div>
        <h1 class="text-center">快速了解DanDan CMS</h1>
        <h3 class="text-center">Quickly understand the DanDan CMS</h3>
    </div>


    <div class="row">
        <div class="col-md-4">
             <h2 class="font-large nospace"><i class="fa fa-heart"></i> 安全策略</h2>
             <p>提供的稳健的安全策略，容错，防治恶意攻击登陆，网页防篡改等多项安全管理功能，保证系统安全，可靠，稳定的运行。</p>
        </div>
        <div class="col-md-4">
             <h2 class="font-large nospace"><i class="fa fa-cubes"></i> 应用模块化</h2>
             <p>提出全新的应用模式进行扩展，不管是你开发一个小功能还是一个全新的站点,DanDan CMS都非常便利</p>
        </div>
        <div class="col-md-4">
              <h2 class="font-large nospace"><i class="fa fa-certificate"></i> 免费开源</h2>
              <p>代码遵循Apache2开源协议，免费使用，对商业用户也无任何限制。</p>
        </div>
    </div>
</div>

