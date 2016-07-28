<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\gii\components\ActiveField;
use yii\gii\CodeFile;
use yii\gii\GiiAsset;


/* @var $this yii\web\View */
/* @var $generator yii\gii\Generator */
/* @var $id string panel ID */
/* @var $form yii\widgets\ActiveForm */
/* @var $results string */
/* @var $hasError boolean */
/* @var $files CodeFile[] */
/* @var $answers array */

$this->title = $generator->getName();
$templates = [];
foreach ($generator->templates as $name => $path) {
    $templates[$name] = "$name ($path)";
}
GiiAsset::register($this);
?>


<div class="clearfix"></div>

<div class="row">
  <div class="col-md-12">
    <div class="x_panel">
      <div class="x_title">
        <h2><?= Html::encode($this->title) ?></h2>
        <ul class="nav navbar-right panel_toolbox">
          <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
          </li>

        </ul>
        <div class="clearfix"></div>
      </div>
      <div class="x_content default-view">

            <p><?= $generator->getDescription() ?></p>

            <?php $form = ActiveForm::begin([
                'id' => "generator",
                'successCssClass' => '',
                'fieldConfig' => ['class' => ActiveField::className()],
            ]); ?>
                <div class="row">
                    <div class="col-lg-8 col-md-10">
                        <?= $this->renderFile($generator->formView(), [
                            'generator' => $generator,
                            'form' => $form,
                        ]) ?>
                        <?= $form->field($generator, 'template')->sticky()
                            ->label('Code Template')
                            ->dropDownList($templates)->hint('
                                Please select which set of the templates should be used to generated the code.
                        ') ?>
                        <div class="form-group">
                            <?= Html::submitButton('Preview', ['name' => 'preview', 'class' => 'btn btn-primary']) ?>

                            <?php if (isset($files)): ?>
                                <?= Html::submitButton('Generate', ['name' => 'generate', 'class' => 'btn btn-success']) ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <?php
                if (isset($results)) {
                    echo $this->render('@yii/gii/views/default/view/results', [
                        'id'=>'generator',
                        'generator' => $generator,
                        'results' => $results,
                        'hasError' => $hasError,
                    ]);
                } elseif (isset($files)) {
                    echo $this->render('@yii/gii/views/default/view/files', [
                        'id'=>'generator',
                        'generator' => $generator,
                        'files' => $files,
                        'answers' => $answers,
                    ]);
                }
                ?>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
</div>

