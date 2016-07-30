
<?php

use yii\helpers\Inflector;
use yii\helpers\StringHelper;
?>
<?="<?php\n"?>

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model <?=$modelClass;?> */

$this->title = Yii::t('app', 'Create <?=Inflector::camel2id(StringHelper::basename($modelClass));?>');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', '<?=Inflector::camel2id(StringHelper::basename($modelClass));?>'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
<?="?>\n";?>
<div class="<?=Inflector::camel2id(StringHelper::basename($modelClass));?>-create">

    <h1><?="<?=";?> Html::encode($this->title) <?="?>";?></h1>

    <?="<?=";?> $this->render('_form', [
        'model' => $model,
    ]) <?="?>\n";?>

</div>
