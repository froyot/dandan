<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use admin\assets\AdminAsset;

/* @var $this \yii\web\View */
/* @var $content string */

$bundle = AdminAsset::register($this);
?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Gentallela Alela! | </title>
    <?php $this->head() ?>


  </head>

  <body class="nav-md">
    <?php $this->beginBody() ?>
    <div class="container body">
      <div class="main_container">


        <?=$this->render('slite_menu',['bundle'=>$bundle]);?>
        <?=$this->render('top_nav',['bundle'=>$bundle]);?>

        <!-- page content -->
        <?=$content;?>
        <!-- /page content -->

        <!-- footer content -->
        <footer>
          <div class="pull-right">
            Gentelella - Bootstrap Admin Template by <a href="https://colorlib.com">Colorlib</a>
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>


    <?php $this->endBody() ?>

    <!-- /gauge.js -->
  </body>
</html>
<?php $this->endPage() ?>
