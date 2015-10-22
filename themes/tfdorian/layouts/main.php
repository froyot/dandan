<?php

use yii\helpers\Html;
use yii\widgets\Menu;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use app\common\helper\ViewHelper;
/**
 * @var $this \yii\base\View
 * @var $content string
 */
AppAsset::register($this);
?>
<?php $this->beginPage(); ?>

<html>
    <head>
      <!--Import materialize.css-->
   <!--    <link type="text/css" rel="stylesheet" href="<?php echo $this->theme->baseUrl ?>/css/materialize.min.css"  media="screen,projection"/>
      <link type="text/css" rel="stylesheet" href="<?php echo $this->theme->baseUrl ?>/css/style.css"  media="screen,projection"/> -->

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
            <a href="#" class="brand-logo right"><?php echo Html::encode(\Yii::$app->name); ?></a>
  					<?php
	  					echo Menu::widget([
	  					  'options' => [
	  					    "id"  => "nav-mobile",
	  					    "class" => "left side-nav"
	  					  ],
						    'items' => [
						        ['label' => Yii::t('app','Home'), 'url' => ['site/index']],
                    ['label' => Yii::t('app','Contents'), 'url' => ['content/index']],
						        ['label' => Yii::t('app','About'), 'url' => ['site/about']],
						        ['label' => Yii::t('app','Admin'), 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],
						    ],
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
                <img src="<?=ViewHelper::getLeftAd('img');?>">
                <span class="card-title"><?=ViewHelper::getLeftAd('title');?></span>
              </div>
              <div class="card-content">
                <p><?=ViewHelper::getLeftAd('tips');?></p>
              </div>
              <div class="card-action">
                <?=ViewHelper::getLeftAd('url');?>
              </div>
            </div>
          </div>

        </div>

        <footer class="page-footer">
          <div class="container">
            <div class="row">
              <div class="col l6 s12">
                <h5 class="grey-text"><?=ViewHelper::getFooter('title');?></h5>
                <p class="grey-text text-lighten-1"><?=ViewHelper::getFooter('tips');?></p>
              </div>
              <div class="col l4 offset-l2 s12">
                <h5 class="white-text"><?=\Yii::t('app','links');?></h5>
                 <?php foreach ( ViewHelper::getLinks() as $item ): ?>
                  <li><a class="white-text" href="<?= $item['link'];?>" target="_blank"><?=$item['text'];?></a></li>
                <?php endforeach;?>
              </div>
            </div>
          </div>
          <div class="footer-copyright">
            <div class="container grey-text center">
            <?=ViewHelper::getCopyright()?>
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
