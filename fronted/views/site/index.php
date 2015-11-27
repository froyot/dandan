<?php
use app\assets\DefaultAsset;
use app\models\util\ViewHelper;
use yii\web\View;

/* @var $this yii\web\View */
$this->title = ViewHelper::getSiteOption('site_seo_title');
$_description = ViewHelper::getSiteOption('site_seo_description');
$_keywords = ViewHelper::getSiteOption('site_seo_keywords');

$bundle = DefaultAsset::register($this);
$this->registerMetaTag(['name' => 'description', 'content' => $_description]);
$this->registerMetaTag(['name' => 'keywords', 'content' => $_keywords]);
$bundle->addPageCssFile($this, 'css/sb-slider.css');
?>


<div id="slides">


        <?php foreach (ViewHelper::getIndexSlide() as $item): ?>
        <li>
            <a href="<?=$item['url'];?>" ><img src="<?=$item['img'];?>" alt=""></a>

        </li>
        <?php endforeach;?>
</div>

    <div>
        <h1 class="text-center">了解DanDan Cms</h1>
        <h3 class="text-center">Quickly Learn About DanDan Cms</h3>
    </div>
    <div class="row">
         <div class="col-md-4">
             <h2 class="font-large nospace"><i class="fa fa-bars"></i> 开发基础Yii2.0 </h2>
             <p>
                Yii是一个PHP框架，用于开发各种类型的Web应用。Yii官方将其定义为高性能、基于组件的框架。Yii开发团队一直关注业内Web开发的最新技术，很注意吸收当下最为流行的技术。就Web开发而言，无论是哪种类型的应用、无论是哪个开发阶段的常见问题，Yii都有成熟、高效、可靠的解决方案。 由于Yii架构合理，Web开发中常用的思路和模式都可以很顺地套上使用。 在Web开发中经常遇到的一些细节上的问题，Yii也提供了许多现成解决方案，拿来就可以使用，非常高效、方便。

            </p>
        </div>
        <div class="col-md-4">
             <h2 class="font-large nospace"><i class="fa fa-group"></i> Yii2 特色</h2>
             <p>Yii2.0格外重视安全性，采取一系列手段有效防止SQL注入、XSS攻击、CSRF攻击、cookie篡改等。运用了PHP命名空间、Trait、 PSR标准 、Composer和Bower包管理器。支持各类SQL和NOSQL数据库，高效实现了Active Record等数据库查询、操作界面，提供数据库迁移、复制、 读写分离等功能。支持Bootstrap，jQuery UI，提供了丰富的Widget挂件供使用。提供多种认证和授权手段基于cookie和基于令牌的认证。
            </p>
        </div>
        <div class="col-md-4">
              <h2 class="font-large nospace "><i class="fa fa-cloud"></i>DanDan CMS</h2>
              <p>以 Yii2 基础版为基础进行开发，默认有前台fronted,后台admin,安装install三个模块。DanDan CMS支持多主题切换，只需要将下载的主题(推荐使用themefactory.net进行下载),参照默认layout进行修改即可。所有需要在模板视图中用到的函数推荐写在app\models\util\ViewHelper类当中。后台采用rbac进行权限管理,默认使用安装时的用户作为超级用户。
            </p>
        </div>
    </div>

    <div>
        <h1 class="text-center">服务领域</h1>
    </div>
    <div class="row boder-bottom">
        <div class="col-md-4">
              <h2 class="font-large nospace text-center"><i class="fa fa-cloud"></i>电子商务</h2>
              <div class="text-center"><img src="<?=Yii::getAlias('@static');?>/images/dianzishangwu.png" style="width:14em;height:14em;"></div>
        </div>
        <div class="col-md-4">
              <h2 class="font-large nospace text-center"><i class="fa fa-cloud"></i>教育</h2>
              <div class="text-center"><img src="<?=Yii::getAlias('@static');?>/images/jiaoyu.jpg" style="width:14em;height:14em;"></div>
        </div>
        <div class="col-md-4">
              <h2 class="font-large nospace text-center"><i class="fa fa-cloud"></i>农业</h2>
              <div class="text-center"><img src="<?=Yii::getAlias('@static');?>/images/nongye.png" style="width:14em;height:14em;"></div>
        </div>
    </div>

<?php
$bundle->addPageScript($this, 'js/jquery.slides.min.js');

$this->registerJs(
    "
$(function() {
      $('#slides').slidesjs({
        width: 800,
        height: 380,
        navigation: {
            active: false
        },
        pagination: {
          active: true,

          effect: 'slide'
        },
        play: {
          active: false,
          auto: true,
          interval: 5000,
          swap: true
        }
      });
    });
", View::POS_LOAD);
?>
