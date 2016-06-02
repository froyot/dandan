<?php
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = $model->title;
?>


<?php if(sizeof($model->settings) > 0) : ?>
    <?= Html::beginForm(); ?>
    <?php foreach($model->settings as $key => $value) : ?>
        <?php if(!is_bool($value)) : ?>
        <div class="form-group">
            <label><?= $key; ?></label>
            <?= Html::input('text', 'Settings['.$key.']', $value, ['class' => 'form-control']); ?>
        </div>
        <?php else : ?>
            <div class="checkbox">
                <label>
                    <?= Html::checkbox('Settings['.$key.']', $value, ['uncheck' => 0])?> <?= $key ?>
                </label>
            </div>
        <?php endif; ?>
    <?php endforeach; ?>
    <?= Html::submitButton(Yii::t('easydandan', 'Save'), ['class' => 'btn btn-primary']) ?>
    <?php Html::endForm(); ?>
<?php else : ?>
    <?= $model->title ?> <?= Yii::t('easydandan', 'module doesn`t have any settings.') ?>
<?php endif; ?>
<a href="<?= Url::to(['/admin/modules/restore-settings', 'id' => $model->module_id]) ?>" class="pull-right text-warning"><i class="glyphicon glyphicon-flash"></i> <?= Yii::t('easydandan', 'Restore default settings') ?></a>
