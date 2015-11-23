<?php

use yii\helpers\Html;
use yii\widgets\Menu;
use yii\widgets\Breadcrumbs;
use app\themes\tfdorian\ThemeAsset;
use app\models\util\ViewHelper;
/**
 * @var $this \yii\base\View
 * @var $content string
 */
$bundle = ThemeAsset::register($this);
$assetBaseUrl = $this->assetManager->getAssetUrl($bundle,'');
?>
<?php $this->beginPage(); ?>

<html>
    <head>
      <!--Import materialize.css-->
   <!--    <link type="text/css" rel="stylesheet" href="<?php echo $assetBaseUrl ?>/css/materialize.min.css"  media="screen,projection"/>
      <link type="text/css" rel="stylesheet" href="<?php echo $assetBaseUrl ?>/css/style.css"  media="screen,projection"/> -->

    	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    	<meta name="author" content="Imre Mehesz">
    	<meta name="description" content="A simple design based on Material UI and MaterializeCSS.">
    	<meta name="robots" content="all">
      <?php $this->head() ?>
    </head>

    <body>
    	<?php $this->beginBody() ?>
      <div class="container">

        <!-- Navbar goes here -->

        <nav>
          <div class="nav-wrapper">
          <a href="<?=Yii::$app->homeUrl;?>" class="brand-logo right">
              <?php echo Html::encode(ViewHelper::getSiteOption('site_name')); ?>
          </a>

  					<?php
	  					echo Menu::widget([
	  					  'options' => [
	  					    "id"  => "nav-mobile",
	  					    "class" => "left side-nav"
	  					  ],
						    'items' => ViewHelper::getSiteMenu(),
		  				]);
			  		?>
            <a class="button-collapse" href="#" data-activates="nav-mobile"><i class="mdi-navigation-menu"></i></a>
          </div>
        </nav>

        <!-- Page Layout here -->
        <div class="row">

          <div class="left col s12 m8 l9"> <!-- Note that "m8 l9" was added -->
            <p>
              <?php echo $content; ?>
            </p>
          </div>

          <div class="right col s12 m4 l3"> <!-- Note that "m4 l3" was added -->
            <div class="card">
              <div class="card-image">
                <a href="#">
                <img src="<?=$assetBaseUrl.'/images/ecto.jpg';?>">
                <span class="card-title"> TestAd </span>
                </a>
              </div>
              <div class="card-content">

              </div>
              <div class="card-action">

              </div>
            </div>
          </div>

        </div>

        <footer class="page-footer">
          <div class="container">
            <div class="row">
              <div class="col l6 s12">
                <h5 class="grey-text"></h5>
                <p class="grey-text text-lighten-1"><?ViewHelper::getAd('footer');?></p>
              </div>
              <div class="col l4 offset-l2 s12">
                <h5 class="white-text"><?=Yii::t('app','friendLink');?></h5>
                  <?php foreach(ViewHelper::getLinks() as $link):?>
                    <li><a class="white-text" href="<?=$link->site_url;?>" target="<?=$link->open_type;?>"><?=$link->site_name;?></a></li>
                  <?php endforeach;?>

              </div>
            </div>
          </div>
          <div class="footer-copyright">
            <div class="container grey-text center">
            &copy; <?=ViewHelper::getSiteOption('copyright');?><?= date('Y') ?>
            </div>
          </div>
        </footer>

      </div>

      <!--Import jQuery before materialize.js-->
      <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>

      <?php $this->endBody(); ?>
    </body>
  </html>
  <?php $this->endPage(); ?>
