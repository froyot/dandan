<?php
use app\assets\DefaultAsset;
use app\common\widgets\SideNavWidget;
use app\models\util\ViewHelper;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;

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
    'brandLabel' => ViewHelper::getSiteOption('site_name') . Yii::t('app', 'backend'),
    'brandUrl' => Yii::$app->homeUrl,
    'options' => [
        'class' => 'navbar-inverse navbar-fixed-top',
    ],
]);
echo Nav::widget([
    'options' => ['class' => 'navbar-nav navbar-left'],
    'items' => [
        ['label' => Yii::t('app', 'fronted'), 'url' => Url::to(['/fronted/site/index'])],
    ],
]);

echo Nav::widget([
    'options' => ['class' => 'navbar-nav navbar-right'],
    'items' => [
        Yii::$app->user->isGuest ?
        ['label' => Yii::t('app', 'login'), 'url' => Url::to(\Yii::$app->user->loginUrl)] :
        ['label' => Yii::t('app', 'logout') . '(' . Yii::$app->user->identity->user_nicename . ')',
            'url' => ['site/logout'],
            'linkOptions' => ['data-method' => 'post']],
    ],
]);
?>

        <?php

NavBar::end();
?>

        <div class="container">
        <?php
if (Yii::$app->user->isGuest) {
    echo Breadcrumbs::widget([
        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
    ]);
    echo $content;
} else {
    ?>
            <div class="col-sm-3">
                <?php
echo SideNavWidget::widget([
        'items' => [
            [
                'label' => Yii::t('app', 'adminHome'),
                'url' => ['site/index'],
                'active' => Yii::$app->controller->id == 'site' ? true : false,
            ],
            [
                'label' => Yii::t('app', 'setting'),
                'active' => Yii::$app->controller->id == 'setting' ? true : false,
                'items' => [
                    ['label' => Yii::t('app', 'siteSetting'), 'url' => ['setting/site']],
                    ['label' => Yii::t('app', 'adSetting'), 'url' => ['setting/ad']],
                    ['label' => Yii::t('app', 'friendLink'), 'url' => ['setting/links']],
                ],
            ],
            [
                'label' => Yii::t('app', 'navManage'),
                'active' => Yii::$app->controller->id == 'nav' ? true : false,
                'url' => ['nav/index'],

            ],
            [
                'label' => Yii::t('app', 'postManage'),
                'active' => Yii::$app->controller->id == 'post' ? true : false,
                'url' => ['post/index'],
            ],
            [
                'label' => Yii::t('app', 'pageManage'),
                'active' => Yii::$app->controller->id == 'page' ? true : false,
                'url' => ['page/index'],
            ],
            [
                'label' => Yii::t('app', 'catManage'),
                'active' => Yii::$app->controller->id == 'term' ? true : false,
                'url' => ['term/index'],
            ],
            [
                'label' => Yii::t('app', 'slide Manage'),
                'items' => [
                    [
                        'label' => Yii::t('app', 'slide-cat'),
                        'url' => ['slide-cat/index'],
                        'active' => Yii::$app->controller->id == 'slide-cat' ? true : false,
                    ],
                    [
                        'label' => Yii::t('app', 'slide'),
                        'url' => ['slide/index'],
                        'active' => Yii::$app->controller->id == 'slide' ? true : false,
                    ],
                ],
            ],
            [
                'label' => Yii::t('app', 'Manage rbac'),
                'url' => ['rbac/roles'],
                'active' => Yii::$app->controller->id == 'rbac' ? true : false,
            ],
        ],
        'options' => ['id' => ''],
    ]);
    ?>
            </div>
            <div class="col-sm-9">
                <?=Breadcrumbs::widget([
'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
])?>
                <?=$content?>
            </div>
            <?php }
?>



        </div>
    </div>

    <footer class="footer">
        <div class="container">
            <p class="pull-left">&copy; <?=ViewHelper::getSiteOption('copyright');?><?=date('Y')?>
                &nbsp;&nbsp;&nbsp;<?php if (ViewHelper::getSiteOption('site_admin_email')): ?>
                <?=Yii::t('app', 'connect to admin');?><a href="mailto:<?=ViewHelper::getSiteOption('site_admin_email');?>"><?=ViewHelper::getSiteOption('site_admin_email');?></a><?php endif;?>
            </p>
            <p class="pull-right"><?=ViewHelper::getSiteOption('powerBy');?></p>

        </div>
        <?php if (ViewHelper::getLinks()): ?>
          <div >
                <?php foreach (ViewHelper::getLinks() as $link): ?>
                  <li><a href="<?=$link->site_url;?>" target="<?=$link->open_type;?>"><?=$link->site_name;?></li>
                <?php endforeach;?>
          </div>
        <?php endif;?>
        <div class="container">

            <p class="pull">
                <?php if (ViewHelper::getSiteOption('site_tongji')): ?>
                <?=ViewHelper::getSiteOption('site_tongji');?>
                <?php endif;?>
                <?=ViewHelper::getSiteOption('site_icp');?></p>
        </div>
    </footer>

<?php $this->endBody()?>
</body>
</html>
<?php $this->endPage()?>
