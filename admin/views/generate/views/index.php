<?php

/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\crud\Generator */
use yii\helpers\StringHelper;
use yii\helpers\Inflector;
echo "<?php\n";
?>


use yii\helpers\Url;
use yii\helpers\Html;
use yii\web\View;
use admin\models\widgets\MyGridView;

$this->title = Yii::t('app', '<?=Inflector::camel2id(StringHelper::basename($modelClass));?>');
$this->params['breadcrumbs'][] = $this->title;

/* list for <?=Inflector::camel2id(StringHelper::basename($modelClass));?>*/
<?= "?>\n" ?>
<div class="category-index">

    <h1><?= "<?=" ?> Html::encode($this->title) <?= "?>" ?></h1>

    <p>
        <?= "<?=" ?> Html::a(Yii::t('app', 'Create <?=Inflector::camel2id(StringHelper::basename($modelClass));?>'), ['create'], ['class' => 'btn btn-success']) <?= "?>" ?>
    </p>

    <?= "<?=" ?>MyGridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        [
        'class' => 'admin\models\widgets\ActionColumn'
        ],
    ],
]); <?= "?>" ?>

</div>
<?= "<?php " ?>
$this->registerJs('
var status_url = "'.Url::to(['items/set-status']).'";
',View::POS_BEGIN);


<?= "?>" ?>
