<?php
use yii\helpers\Url;
/* @var $this yii\web\View */
$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron" id="index_slide">
        <div class="slide-content" style="position: absolute;bottom: 78px;">
        <h2><?=$data[0][0]['title'];?></h2>
        <p class="lead"><?=$data[0][0]->getAbstruct(20);?></p>
        <p class="slide-button"><a class="btn btn-lg btn-success" href="<?=Url::to(['content/view','id'=>$data[0][0]['id']]);?>">ReadMore</a></p>
        </div>
                <?php if($data[0][0]['others']):?><img src="<?= $data[0][0]['others'];?>" style="
    width: 100%;"/><?php endif;?>

    </div>

    <div class="body-content">

        <div class="row">
            <?php foreach($data[1] as $content):?>
            <div class="col-lg-4">
                <!-- <h3><?=$content->title;?></h3> -->

                <p><?=$content->abstruct;?></p>

                <p><a class="btn btn-default" href="<?=Url::to(['content/view','id'=>$content->id]);?>">Detail &raquo;</a></p>
            </div>
            <?php endforeach;?>

        </div>

    </div>
</div>
