<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
/* @var $this yii\web\View */
$this->title = Yii::t('app','user info');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="content-view">
    <?php if( $user_id == $data->id ):?>
        <?=Html::a(Yii::t('app','edit userinfo').'&gt;&gt;',Url::to(['user/edit','id'=>$data->id]));?>
    <?php endif;?>
    <?= DetailView::widget([
        'model' => $data,
        'attributes' => [
            'avatar',
            'birthday',
            'coin',
            'create_time',
            'last_login_ip',
            'last_login_time',
            'mobile',
            'score',
            'sex',
            'signature',
            'user_email',
            'user_login',
            'user_nicename'
        ],
    ]) ?>

</div>
