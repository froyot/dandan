<?php

use yii\helpers\Html;
use yii\widgets\Menu;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

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
						        ['label' => 'Home', 'url' => ['site/index']],
						        ['label' => 'About', 'url' => ['site/about']],
						        ['label' => 'Contact', 'url' => ['site/contact']],
						        ['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],
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
                <img src="<?php echo $this->theme->baseurl ?>/images/ecto.jpg">
                <span class="card-title">TF Dorian</span>
              </div>
              <div class="card-content">
                <p>I am a very simple card. I am good at containing small bits of information.
                I am convenient because I require little markup to use effectively.</p>
              </div>
              <div class="card-action">
                <a href="#">This is a link</a>
              </div>
            </div>
          </div>

        </div>

        <footer class="page-footer">
          <div class="container">
            <div class="row">
              <div class="col l6 s12">
                <h5 class="grey-text">Footer Content</h5>
                <p class="grey-text text-lighten-1">You can use rows and columns here to organize your footer content.</p>
              </div>
              <div class="col l4 offset-l2 s12">
                <h5 class="grey-text">Links</h5>
                <li><a class="grey-text" href="#!">Link 1</a></li>
                <li><a class="grey-text" href="#!">Link 2</a></li>
                <li><a class="grey-text" href="#!">Link 3</a></li>
                <li><a class="grey-text" href="#!">Link 4</a></li>
              </div>
            </div>
          </div>
          <div class="footer-copyright">
            <div class="container grey-text center">
            &copy; 2015 ThemeFactory.net
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
