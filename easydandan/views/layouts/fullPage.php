<?php
use easydandan\assets\AppAsset;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;

/* @var $this \yii\web\View */
/* @var $content string */
$asset = AppAsset::register($this);

?>
<?php $this->beginPage()?>
<!DOCTYPE html>
<html lang="<?=Yii::$app->language?>">
<head>
    <meta charset="<?=Yii::$app->charset?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <?=Html::csrfMetaTags()?>
    <title><?=Html::encode($this->title)?></title>
        <?php $this->head()?>
    </head>

    <body class="login-layout">
         <?php $this->beginBody()?>
        <div class="main-container">
            <?=$content;?>
        </div><!-- /.main-container -->

<?php $this->endBody()?>
        <script type="text/javascript">
            function show_box(id) {
             jQuery('.widget-box.visible').removeClass('visible');
             jQuery('#'+id).addClass('visible');
            }
        </script>



</body>
</html>
<?php $this->endPage()?>


