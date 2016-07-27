<?php
use yii\helpers\Url;
use yii\helpers\Html;
use admin\models\widgets\MyListView;
use yii\web\View;
/* @var $this yii\web\View */
/* @var $searchModel admin\modules\user\models\UsersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Users');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="users-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Users'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= MyListView::widget([
        'dataProvider' => $dataProvider,
    ]); ?>

</div>
<?php
$this->registerJs('
var status_url = "'.Url::to(['items/set-status']).'";
',View::POS_BEGIN);


?>
