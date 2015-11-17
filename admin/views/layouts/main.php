<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use app\common\widgets\SideNavWidget;
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
                'brandLabel' => ViewHelper::getSiteOption('site_name').'后台',
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar-inverse navbar-fixed-top',
                ],
            ]);
            // echo Nav::widget([
            //     'options' => ['class' => 'navbar-nav navbar-left'],
            //     'items' => ViewHelper::getSiteMenu()
            // ]);

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

        <?php

            NavBar::end();
        ?>

        <div class="container">
        <?php
        if( Yii::$app->user->isGuest )
        {
            echo Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]);
            echo $content;
        }
        else
        {
        ?>
            <div class="col-sm-3">
                <?php
                    echo SideNavWidget::widget([
                          'items' => [
                              [
                                  'label' => Yii::t('app','adminHome'),
                                  'url' => ['site/index'],
                                  'active'=>Yii::$app->controller->id == 'site'?true:false,
                              ],
                              [
                                  'label' => Yii::t('app','setting'),
                                  'active'=>Yii::$app->controller->id == 'setting'?true:false,
                                  'items' => [
                                       ['label' => Yii::t('app','siteSetting'), 'url' => '#'],
                                       ['label' => Yii::t('app','smtpSetting'), 'url' => '#'],
                                  ],
                              ],
                              [
                                'label' => Yii::t('app','navManage'),
                                'active'=>Yii::$app->controller->id == 'nav'?true:false,
                                'url' => ['nav/index'],

                              ],
                              [
                                  'label' => Yii::t('app','postManage'),
                                  'active'=>Yii::$app->controller->id == 'post'?true:false,
                                  'url' => ['post/index'],
                              ],
                              [
                                  'label' => Yii::t('app','pageManage'),
                                  'active'=>Yii::$app->controller->id == 'page'?true:false,
                                  'url' => ['page/index'],
                              ],
                              [
                                  'label' => Yii::t('app','catManage'),
                                  'active'=>Yii::$app->controller->id == 'term'?true:false,
                                  'url' => ['term/index'],
                              ],
                          ],
                          'options'=>['id'=>'']
                      ]);
                ?>
            </div>
            <div class="col-sm-9">
                <?= Breadcrumbs::widget([
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                ]) ?>
                <?= $content ?>
            </div>
            <?php }?>



        </div>
    </div>

    <footer class="footer">
        <div class="container">
            <p class="pull-left">&copy; <?=ViewHelper::getSiteOption('copyright');?><?= date('Y') ?></p>
            <p class="pull-right"><?=ViewHelper::getSiteOption('powerBy');?></p>

        </div>
        <div class="container">
            <p class="pull"><?=ViewHelper::getSiteOption('site_icp');?></p>
        </div>
    </footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
