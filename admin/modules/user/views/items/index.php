<?php

use yii\helpers\Html;
use admin\models\widgets\MyListView;

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
        // 'columns' => [
        //     ['class' => 'yii\grid\SerialColumn'],

        //     'username',
        //     'password',
        //     'create_at',
        //     'status',

        //     ['class' => 'yii\grid\ActionColumn'],
        // ],
    ]); ?>

</div>
