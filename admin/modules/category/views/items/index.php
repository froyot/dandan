<?php


use yii\helpers\Url;
use yii\helpers\Html;
use yii\web\View;
use admin\models\widgets\MyGridView;

$this->title = Yii::t('app', 'category');
$this->params['breadcrumbs'][] = $this->title;

/* list for category*/
?>
<div class="category-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create category'), ['create'], ['class' => 'btn btn-success']) ?>    </p>

    <?=MyGridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        [
        'class' => 'admin\models\widgets\ActionColumn'
        ],
    ],
]); ?>
</div>
<?php $this->registerJs('
var status_url = "'.Url::to(['items/set-status']).'";
',View::POS_BEGIN);


?>