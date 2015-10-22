<?php

use yii\helpers\Html;
use yii\widgets\Menu;
use yii\widgets\Breadcrumbs;
use app\common\helper\ViewHelper;
/**
 * @var $this \yii\base\View
 * @var $content string
 */
$this->registerAssetBundle('app\assets\AppAsset');
?>
<?php $this->beginPage(); ?>

<html>
    <head>
     <?php $this->head(); ?>
    	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    	<meta name="author" content="Imre Mehesz">
    	<meta name="description" content="A simple design based on Material UI and MaterializeCSS.">
    	<meta name="robots" content="all">
    </head>

    <body>
    	<?php $this->beginBody() ?>
      <div class="container">

        <!-- Navbar goes here -->

        <nav>
          <div class="nav-wrapper">
            <a href="#" class="brand-logo right"><?php echo Html::encode(ViewHelper::getSiteName()); ?></a>
  					<?php
	  					echo Menu::widget([
	  					  'options' => [
	  					    "id"  => "nav-mobile",
	  					    "class" => "left side-nav"
	  					  ],
						    'items' => [
						        ['label' => \Yii::t('app','Home'), 'url' => ['site/index']],
                    ['label' => \Yii::t('app','Contents'), 'url' => ['content/index']],
						        ['label' => \Yii::t('app','About'), 'url' => ['site/about']],
						        ['label' => \Yii::t('app','Admin'), 'url' => ['/admin/default/index'], 'visible' => Yii::$app->user->isGuest],
						    ],
		  				]);
			  		?>
            <a class="button-collapse" href="#" data-activates="nav-mobile"><i class="mdi-navigation-menu"></i></a>
          </div>
        </nav>

        <!-- Page Layout here -->
        <div class="row">
            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                'options'=>['class'=>'breadcrumb','style'=>'margin-left: 0.75rem; margin-right: 0.75rem;']
            ]) ?>
          <div class="right col s12 m8 l9"> <!-- Note that "m8 l9" was added -->

            <p>
              <?php echo $content; ?>
            </p>
          </div>

          <div class="left col s12 m4 l3"> <!-- Note that "m4 l3" was added -->
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
                <h5 class="white-text"><?=ViewHelper::getFooter('title');?></h5>
                <p class="white-text text-lighten-1"><?=ViewHelper::getFooter('tips');?></p>
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
            <div class="container white-text center">
              <?=ViewHelper::getCopyright()?>
            <!-- &copy; 2015 ThemeFactory.net -->
            </div>
          </div>
        </footer>

      </div>


      <?php $this->endBody(); ?>
      <script type="text/javascript">
        $(function(){
          $(".button-collapse").sideNav();
        });
      </script>
    </body>
  </html>
  <?php $this->endPage(); ?>
