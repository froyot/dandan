<?php

use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\form\UserForm */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'user list');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">


    <?php echo $this->render('/public/_search', ['model' => $searchModel]);?>



    <?=GridView::widget([
'dataProvider' => $dataProvider,
'columns' => [
['class' => 'yii\grid\SerialColumn'],

'id',
'user_login',
'user_nicename',
'user_email:email',
[
'attribute' => 'role',
'value' => 'authAssignment.item_name',
],

// 'user_url:url',
// 'avatar',
// 'sex',
// 'birthday',
// 'signature',
// 'last_login_ip',
// 'last_login_time',
// 'create_time',
// 'user_activation_key',
// 'user_status',
// 'score',
// 'user_type',
// 'coin',
// 'mobile',

[
'class' => 'yii\grid\ActionColumn',
'template' => '{reset-password} | {update} | {delete}',
'buttons' => [
'reset-password' => function ($url, $model, $key) {
return '<a href="' . $url . '">' . Yii::t('app', 'reset password') . '</a>';
},
],
],
],
]);?>

</div>
