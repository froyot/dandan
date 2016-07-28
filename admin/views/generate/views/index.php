<?php

/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\crud\Generator */


echo "<?php\n";
?>


use yii\helpers\Url;
use yii\helpers\Html;
use yii\web\View;
use admin\models\widgets\MyListView;

$this->title = Yii::t('app', '<?=$modelClass;?>');
$this->params['breadcrumbs'][] = $this->title;
<?= "?>\n" ?>
<div class="category-index">

    <h1><?= "<?=" ?> Html::encode($this->title) <?= "?>" ?></h1>

    <p>
        <?= "<?=" ?> Html::a(Yii::t('app', 'Create <?=$modelClass;?>'), ['create'], ['class' => 'btn btn-success']) <?= "?>" ?>
    </p>

    <?= "<?=" ?> MyListView::widget([
        'dataProvider' => $dataProvider,
    ]); <?= "?>" ?>

</div>
<?= "<?php " ?>
$this->registerJs('
var status_url = "'.Url::to(['items/set-status']).'";
',View::POS_BEGIN);


<?= "?>" ?>
