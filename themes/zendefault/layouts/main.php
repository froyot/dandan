<?php

use yii\helpers\Html;
use yii\widgets\Menu;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use yii\helpers\ArrayHelper;
use app\models\util\ViewHelper;
use app\themes\zendefault\ThemeAsset;
/**
 * @var $this \yii\base\View
 * @var $content string
 */

$bundle = ThemeAsset::register($this);
$assetBaseUrl = $this->assetManager->getAssetUrl($bundle,'');
?>
<?php $this->beginPage(); ?>

<!DOCTYPE html>
<html lang="en">
<head>

	<meta charset="utf-8"/>
	<title><?php echo Html::encode($this->title); ?></title>
	<?php $this->head(); ?>


	<link rel="alternate" type="application/rss+xml" title="RSS" href="http://www.csszengarden.com/zengarden.xml">

	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="author" content="Dave Shea">
	<meta name="description" content="A demonstration of what can be accomplished visually through CSS-based design.">
	<meta name="robots" content="all">


	<!--[if lt IE 9]>
	<script src="script/html5shiv.js"></script>
	<![endif]-->
</head>


<body id="css-zen-garden">
<div class="page-wrapper">

	<section class="intro" id="zen-intro">
		<header role="banner">
			<h1><?php echo Html::encode(ViewHelper::getSiteOption('site_name')); ?></h1>

		</header>

		<div class="preamble" role="article">
			<?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
			<?php echo $content; ?>
		</div>
	</section>

	</div>


	<aside class="sidebar" role="complementary">
		<div class="wrapper">

			<div class="design-selection" id="design-selection">
				<nav role="navigation">
					<?php
						echo Menu::widget([
						    'items' => ArrayHelper::merge(ViewHelper::getSiteMenu(),
						        [['label' => \Yii::t('app','Admin'), 'url' => ['/admin/default/index'], 'visible' => Yii::$app->user->isGuest]]),
						]);
					?>
				</nav>

			</div>
		</div>
	</aside>


</div>


<div class="extra1" role="presentation"></div><div class="extra2" role="presentation"></div><div class="extra3" role="presentation"></div>
<div class="extra4" role="presentation"></div><div class="extra5" role="presentation"></div><div class="extra6" role="presentation"></div>

	<?php $this->endBody(); ?>
</body>
</html>

<?php $this->endPage(); ?>
