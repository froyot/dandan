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

$this->registerAssetBundle('app\assets\AppAsset');
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

<!--



	View source is a feature, not a bug. Thanks for your curiosity and
	interest in participating!

	Here are the submission guidelines for the new and improved csszengarden.com:

	- CSS3? Of course! Prefix for ALL browsers where necessary.
	- go responsive; test your layout at multiple screen sizes.
	- your browser testing baseline: IE9+, recent Chrome/Firefox/Safari, and iOS/Android
	- Graceful degradation is acceptable, and in fact highly encouraged.
	- use classes for styling. Don't use ids.
	- web fonts are cool, just make sure you have a license to share the files. Hosted
	  services that are applied via the CSS file (ie. Google Fonts) will work fine, but
	  most that require custom HTML won't. TypeKit is supported, see the readme on this
	  page for usage instructions: https://github.com/mezzoblue/csszengarden.com/

	And a few tips on building your CSS file:

	- use :first-child, :last-child and :nth-child to get at non-classed elements
	- use ::before and ::after to create pseudo-elements for extra styling
	- use multiple background images to apply as many as you need to any element
	- use the Kellum Method for image replacement, if still needed. http://goo.gl/GXxdI
	- don't rely on the extra divs at the bottom. Use ::before and ::after instead.


-->

<body id="css-zen-garden">
<div class="page-wrapper">

	<section class="intro" id="zen-intro">
		<header role="banner">
			<h1><?php echo Html::encode(ViewHelper::getSiteName()); ?></h1>

		</header>

        <!--
		<div class="summary" id="zen-summary" role="article">
			<p>A demonstration of what can be accomplished through <abbr title="Cascading Style Sheets">CSS</abbr>-based design. Select any style sheet from the list to load it into this page.</p>
			<p>Download the example <a href="/examples/index" title="This page's source HTML code, not to be modified.">html file</a> and <a href="/examples/style.css" title="This page's sample CSS, the file you may modify.">css file</a></p>
		</div>

		<div class="preamble" id="zen-preamble" role="article">
			<h3>The Road to Enlightenment</h3>
			<p>Littering a dark and dreary road lay the past relics of browser-specific tags, incompatible <abbr title="Document Object Model">DOM</abbr>s, broken <abbr title="Cascading Style Sheets">CSS</abbr> support, and abandoned browsers.</p>
			<p>We must clear the mind of the past. Web enlightenment has been achieved thanks to the tireless efforts of folk like the <abbr title="World Wide Web Consortium">W3C</abbr>, <abbr title="Web Standards Project">WaSP</abbr>, and the major browser creators.</p>
			<p>The CSS Zen Garden invites you to relax and meditate on the important lessons of the masters. Begin to see with clarity. Learn to use the time-honored techniques in new and invigorating fashion. Become one with the web.</p>
		</div>
		-->

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
						    'items' => [
						        ['label' => Yii::t('app','Home'), 'url' => ['site/index']],

						        ['label' => Yii::t('app','Contents'), 'url' => ['content/index']],
						        ['label' => Yii::t('app','About'), 'url' => ['site/about']],
						        ['label' => Yii::t('app','Admin'), 'url' => ['/admin/default/index'], 'visible' => Yii::$app->user->isGuest],
						    ],
						]);
					?>
				</nav>

			</div>
		</div>
	</aside>


</div>

<!--

	These superfluous divs/spans were originally provided as catch-alls to add extra imagery.
	These days we have full ::before and ::after support, favour using those instead.
	These only remain for historical design compatibility. They might go away one day.

-->
<div class="extra1" role="presentation"></div><div class="extra2" role="presentation"></div><div class="extra3" role="presentation"></div>
<div class="extra4" role="presentation"></div><div class="extra5" role="presentation"></div><div class="extra6" role="presentation"></div>

	<?php $this->endBody(); ?>
</body>
</html>

<?php $this->endPage(); ?>
