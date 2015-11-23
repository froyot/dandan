<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ListView;
/* @var $this yii\web\View */
/* @var $model app\models\db\Content */

?>
<div class="comment-item">
<?php
echo ListView::widget([
            'dataProvider' => $dataProvider,
            'itemView' => function ($model, $key, $index, $widget) {
                return $this->render('comment_item',['model' => $model]);
            },
        ]);
?>
</div>
