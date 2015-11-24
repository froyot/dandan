<?php
use app\assets\DefaultAsset;
use yii\bootstrap\NavBar;
use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $content string */

// AppAsset::register($this);
$bundle = DefaultAsset::register($this);
?>
<?php $this->beginPage()?>
<!DOCTYPE html>
<html lang="<?=Yii::$app->language?>">
<head>
    <meta charset="<?=Yii::$app->charset?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?=Html::csrfMetaTags()?>
    <title><?=Html::encode($this->title)?></title>

    <?php $this->head()?>
</head>
<body>

<?php $this->beginBody()?>
    <div class="wrap">
        <?php
NavBar::begin([
    'options' => [
        'class' => 'navbar-inverse navbar-fixed-top',
    ],
]);

NavBar::end();
?>

        <div class="container">
            <?=$content?>
        </div>


        </div>
    </div>

<?php $this->endBody()?>
</body>
</html>
<?php $this->endPage()?>
