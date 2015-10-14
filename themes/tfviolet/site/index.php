<?php
use yii\helpers\Url;
/* @var $this yii\web\View */
$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1><?=$data[0][0]['title'];?></h1>
        <p class="lead">You have successfully created your Yii-powered application.</p>
        <p><a class="btn btn-lg btn-success" href="<?=Url::to(['content/view','id'=>$data[0][0]['id']]);?>">ReadMore</a></p>
    </div>

    <div class="body-content">

        <div class="row">
            <?php foreach($data[1] as $content):?>
            <div class="col-lg-4">
                <h2><?=$content->title;?></h2>

                <p><?=$content->abstruct;?></p>

                <p><a class="btn btn-default" href="<?=Url::to(['content/view','id'=>$content->id]);?>">Detail &raquo;</a></p>
            </div>
            <?php endforeach;?>

        </div>

    </div>
</div>
