<?php
use yii\web\View;
use yii\helpers\Url;
use app\assets\DefaultAsset;
use app\models\util\ViewHelper;

/* @var $this yii\web\View */
$this->title = ViewHelper::getSiteOption('site_seo_title');
$_description = ViewHelper::getSiteOption('site_seo_description');
$_keywords = ViewHelper::getSiteOption('site_seo_keywords');

$bundle = DefaultAsset::register($this);
$this->registerMetaTag(['name' => 'description', 'content' => $_description]);
$this->registerMetaTag(['name' => 'description', 'content' => $_keywords]);
$bundle->addPageCssFile($this,'css/slippry/slippry.css');
$this->registerCss('
.caption-wraper{position: absolute;left:50%;bottom:2em;}
            .caption-wraper .caption{
            position: relative;left:-50%;
            background-color: rgba(0, 0, 0, 0.54);
            padding: 0.4em 1em;
            color:#fff;
            -webkit-border-radius: 1.2em;
            -moz-border-radius: 1.2em;
            -ms-border-radius: 1.2em;
            -o-border-radius: 1.2em;
            border-radius: 1.2em;
            }
            @media (max-width: 767px){
                .sy-box{margin: 12px -20px 0 -20px;}
                .caption-wraper{left:0;bottom: 0.4em;}
                .caption-wraper .caption{
                left: 0;
                padding: 0.2em 0.4em;
                font-size: 0.92em;
                -webkit-border-radius: 0;
                -moz-border-radius: 0;
                -ms-border-radius: 0;
                -o-border-radius: 0;
                border-radius: 0;}
            }
');
?>
<ul id="homeslider" class="unstyled">


    <li>
        <div class="caption-wraper">
            <div class="caption">test</div>
        </div>
        <a href="http://www.baidu.com"><img src="http://imgs.focus.cn/upload/pics/37300/a_372997589.jpg" alt=""></a>
    </li>
    <li>
        <div class="caption-wraper">
            <div class="caption">test222</div>
        </div>
        <a href="http://www.baidu.com?rt=123"><img src="http://imgs.focus.cn/upload/pics/37300/b_372997586.jpg" alt=""></a>
    </li>


</ul>
<div>
    <div>
        <h1 class="text-center">快速了解ThinkCMF</h1>
        <h3 class="text-center">Quickly understand the ThinkCMF</h3>
    </div>
    <div class="row">
         <div class="col-md-4">
             <h2 class="font-large nospace"><i class="fa fa-bars"></i> MVC分层模式</h2>
             <p>使用MVC应用程序被分成三个核心部件：模型（M）、视图（V）、控制器（C），他不是一个新的概念，只是ThinkCMF将其发挥到了极致。</p>
        </div>
        <div class="col-md-4">
             <h2 class="font-large nospace"><i class="fa fa-group"></i> 用户管理</h2>
             <p>ThinkCMF内置了灵活的用户管理方式，并可直接与第三方站点进行互联互通，如果你愿意甚至可以对单个用户或群体用户的行为进行记录及分享，为您的运营决策提供有效参考数据。</p>
        </div>
        <div class="col-md-4">
              <h2 class="font-large nospace"><i class="fa fa-cloud"></i> 云端部署</h2>
              <p>通过驱动的方式可以轻松支持云平台的部署，让你的网站无缝迁移，内置已经支持SAE、BAE，正式版将对云端部署进行进一步优化。</p>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
             <h2 class="font-large nospace"><i class="fa fa-heart"></i> 安全策略</h2>
             <p>提供的稳健的安全策略，包括备份恢复，容错，防治恶意攻击登陆，网页防篡改等多项安全管理功能，保证系统安全，可靠，稳定的运行。</p>
        </div>
        <div class="col-md-4">
             <h2 class="font-large nospace"><i class="fa fa-cubes"></i> 应用模块化</h2>
             <p>提出全新的应用模式进行扩展，不管是你开发一个小功能还是一个全新的站点，在ThinkCMF中你只是增加了一个APP，每个独立运行互不影响，便于灵活扩展和二次开发。</p>
        </div>
        <div class="col-md-4">
              <h2 class="font-large nospace"><i class="fa fa-certificate"></i> 免费开源</h2>
              <p>代码遵循Apache2开源协议，免费使用，对商业用户也无任何限制。</p>
        </div>
    </div>

    <div>
        <h1 class="text-center">最新资讯</h1>
        <h3 class="text-center">Last News</h3>
    </div>
</div>
<?php
$bundle->addPageScript($this,'js/slippry.min.js');
$this->registerJs('
    var demo1 = $("#homeslider").slippry({
        transition: "fade",
        useCSS: true,
        captions: false,
        speed: 1000,
        pause: 3000,
        auto: true,
        preload: "visible"
    });
',View::POS_LOAD);
?>
