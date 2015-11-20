<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\DefaultAsset;
use yii\helpers\ArrayHelper;
use app\models\util\ViewHelper;


/* @var $this \yii\web\View */
/* @var $content string */

// AppAsset::register($this);
$bundle = DefaultAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>

    <?php $this->head() ?>
</head>
<body>

<?php $this->beginBody() ?>
    <div class="wrap">
        <?php
            NavBar::begin([
                'brandLabel' => ViewHelper::getSiteOption('site_name'),
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar-inverse navbar-fixed-top',
                ],
            ]);
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-left'],
                'items' => ViewHelper::getSiteMenu()
            ]);

            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => [
                Yii::$app->user->isGuest ?
                        ['label' => 'Login', 'url' => Url::to(\Yii::$app->user->loginUrl)] :
                        ['label' => 'Logout (' . Yii::$app->user->identity->user_nicename . ')',
                            'url' => ['site/logout'],
                            'linkOptions' => ['data-method' => 'post']]
                    ],
                ]);
        ?>
        <?= Html::beginForm(Url::to(['site/search']),'GET');?>
        <div class="navbar-form navbar-right">
            <div class="form-group">
                <input id="searchbox" type="text" class="form-control" placeholder="搜索问题、话题或人,,," name="_keywords" value="<?=Yii::$app->request->get('_keywords');?>">
            </div>
            <div class="form-group">
                <?= Html::submitButton(Yii::t('app','search'), ['class' => 'btn btn-primary']) ?>
            </div>
        </div>
        <?= Html::endForm();?>
        <?php

            NavBar::end();
        ?>

        <div class="container">
            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>

            <?= $content ?>
        </div>


        </div>
    </div>

    <footer class="footer">
        <div class="container">
            <p class="pull-left">&copy; <?=ViewHelper::getSiteOption('copyright');?><?= date('Y') ?>
                &nbsp;&nbsp;&nbsp;<?php if(ViewHelper::getSiteOption('site_admin_email')):?>
                <?=Yii::t('app','connect to admin');?><a href="mailto:<?=ViewHelper::getSiteOption('site_admin_email');?>"><?=ViewHelper::getSiteOption('site_admin_email');?></a><?php endif;?>
            </p>
            <p class="pull-right"><?=ViewHelper::getSiteOption('powerBy');?></p>

        </div>
        <div class="container">

            <p class="pull">
                <?php if(ViewHelper::getSiteOption('site_tongji')):?>
                <?=ViewHelper::getSiteOption('site_tongji');?>
                <?php endif;?>
                <?=ViewHelper::getSiteOption('site_icp');?></p>
        </div>
    </footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
