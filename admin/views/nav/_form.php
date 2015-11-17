<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\util\Tree;
use app\models\action\Nav;
use app\models\action\Post;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model app\models\action\Nav */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="nav-form">

    <?php $form = ActiveForm::begin($option); ?>

    <?= $form->field($model, 'cid')->dropDownList(Tree::makeDropDown( [
            'model'=> 'app\models\action\NavCat',
        ],
        [
            'value'=>'navcid',
            'label'=>'name',
            'icon'=>'├─',
            'levelChar'=>'    '
        ]
    ),[
    'name'=>'cid',
    'encodeSpaces'=>true,
    'prompt' => '--'.Yii::t('app','select').Yii::t('app','nav cat').'--'
    ])->label(Yii::t('app','nav cat')) ?>


    <?= $form->field($model, 'parentid')->dropDownList(Tree::makeDropDown( [
            'model'=> 'app\models\action\Nav',
            'parentKey'=>'parentid',
            'primaryKey'=>'id',
            'rootParent'=>0
        ],
        [
            'value'=>'id',
            'label'=>'label',
            'icon'=>'├─',
            'levelChar'=>'    '
        ]
    ),[
    'name'=>'parentid',
    'encodeSpaces'=>true,
    'prompt' => '--'.Yii::t('app','select').Yii::t('app','parent').Yii::t('app','menu').'--'])->label(Yii::t('app','parent').Yii::t('app','menu')) ?>


    <?= $form->field($model, 'label')->textInput(['maxlength' => true,'name'=>'label',]) ?>

    <?= $form->field($model, 'target')->dropDownList(['_blank'=>Yii::t('app','new window')],['prompt' => '--'.Yii::t('app','default').'--','name'=>'target',])->label(Yii::t('app','open type')); ?>

    <div class="row">
        <div class="col-lg-12">
        <div class="form-group field-nav-target">
        <?=Html::tag('label',Yii::t('app','href type'));?>
        </div>
    </div>
        <div class="col-lg-3">
        <?= $form->field($model, 'href_type')->radio(['name'=>'href_type','value'=>0,'uncheck'=>null],false)->label(Yii::t('app','href'));?>

        <?= $form->field($model, 'href_txt')->textInput(['maxlength' => true,'name'=>'href_txt',])->label(false) ?>
        </div>

        <div class="col-lg-3">
        <?= $form->field($model, 'href_type')->radio(['name'=>'href_type','value'=>1,'uncheck'=>null],false)->label(Yii::t('app','category'));?>
        <?= $form->field($model, 'href_cat')->dropDownList(Tree::makeDropDown( [
                'model'=> 'app\models\action\term',
                'parentKey'=>'parent',
                'primaryKey'=>'term_id',
                'rootParent'=>0
            ],
            [
                'value'=>'term_id',
                'label'=>'name',
                'icon'=>'├─',
                'levelChar'=>'    '
            ]
        ),[
        'name'=>'href_cat',
        'encodeSpaces'=>true,
        'prompt' => '--'.Yii::t('app','select').Yii::t('app','category').'--'])->label(false) ?>
        </div>

        <div class="col-lg-3">
        <?= $form->field($model, 'href_type')->radio(['name'=>'href_type','value'=>2,'uncheck'=>null],false)->label(Yii::t('app','page'));?>
        <?php
            $pages = Post::find()->where(['post_type'=>'page'])->select(['id','post_title'])->asArray()->all();
            if( !$pages )
            {
                $pages = [];
            }
            else
            {
                $pages = ArrayHelper::map($pages, 'id', 'post_title');
            }
        ?>
        <?= $form->field($model, 'href_page')->dropDownList($pages,['name'=>'href_page','prompt' => 'select page'])->label(false) ?>
    </div>
</div>

    <?= $form->field($model, 'icon')->textInput(['maxlength' => true,'name'=>'icon',]) ?>

    <?= $form->field($model, 'status')->dropDownList([0=>Yii::t('app','hidden'),1=>Yii::t('app','show')],['name'=>'status'])->label(Yii::t('app','status')) ?>

    <?= $form->field($model, 'listorder')->textInput(['name'=>'listorder'])->label(Yii::t('app','order')) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
