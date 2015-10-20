<?php

use yii\helpers\Html;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\form\Content */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = \Yii::t('app','Contents');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="content-index">

    <?php echo $this->render('_search', ['model' => $searchModel]); ?>
    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'itemView'=>'@app/views/content/listItem',
        'layout' => "{items}\n{pager}"
    ]); ?>

</div>
