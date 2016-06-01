<?php
use easydandan\models\action\Module;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = Yii::t('easydandan', 'Modules');


$action = $this->context->action->id;
?>
 <p>
        <?=Html::a(Yii::t('easydandan','Create Module'), ['create'], ['class' => 'btn btn-success'])?>
</p>
<?php if($dataProvider->count > 0) : ?>
<div class="table-responsive">
    <table id="sample-table-1" class="table table-striped table-bordered table-hover">
        <thead>
            <tr>

            <th class="center">
                <label>
                        <input type="checkbox" class="ace" />
                        <span class="lbl"></span>
                </label>
            </th>
            <th><?= Yii::t('easydandan', 'Name') ?></th>
            <th><?= Yii::t('easydandan', 'Title') ?></th>
            <th><?= Yii::t('easydandan', 'Class') ?></th>
            <th class="hidden-480"><?= Yii::t('easydandan', 'Icon') ?></th>
            <th class="hidden-480"><?= Yii::t('easydandan', 'Status') ?></th>
            <th width="150"></th>
            </tr>
        </thead>

        <tbody>
        <?php foreach($dataProvider->models as $module) : ?>
            <tr>
                <td class="center">
                    <label>
                        <input type="checkbox" class="ace" />
                        <span class="lbl"><?= $module->primaryKey ?></span>
                    </label>
                </td>
                <td><a href="<?= Url::to(['/admin/modules/edit/', 'id' => $module->primaryKey]) ?>" title="<?= Yii::t('easydandan', 'Edit') ?>"><?= $module->name ?></a></td>
                <td><?= $module->title ?></td>
                <td><?= $module->class ?></td>
                <td class="hidden-480">
                    <?php if($module->icon) : ?>
                        <span class="glyphicon glyphicon-<?= $module->icon ?>"></span> <?= $module->icon ?>
                    <?php endif; ?>
                </td>
                <td class="hidden-480">
                    <?= Html::checkbox('', $module->status == Module::STATUS_ON, [
                        'class' => 'switch',
                        'data-id' => $module->primaryKey,
                        'data-link' => Url::to(['/admin/modules/']),
                        'data-reload' => '1'
                    ]) ?>
                </td>
                <td class="control">
                    <div class="btn-group btn-group-sm" role="group">
                        <a href="<?= Url::to(['/admin/modules/up/', 'id' => $module->primaryKey]) ?>" class="btn btn-default" title="<?= Yii::t('easydandan', 'Move up') ?>"><span class="glyphicon glyphicon-arrow-up"></span></a>
                        <a href="<?= Url::to(['/admin/modules/down/', 'id' => $module->primaryKey]) ?>" class="btn btn-default" title="<?= Yii::t('easydandan', 'Move down') ?>"><span class="glyphicon glyphicon-arrow-down"></span></a>
                        <a href="<?= Url::to(['/admin/modules/delete/', 'id' => $module->primaryKey]) ?>" class="btn btn-default confirm-delete" title="<?= Yii::t('easydandan', 'Delete item') ?>"><span class="glyphicon glyphicon-remove"></span></a>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>

        </tbody>
        <?= yii\widgets\LinkPager::widget([
            'pagination' => $dataProvider->pagination
        ]) ?>
    </table>
<?php else : ?>
    <p><?= Yii::t('easydandan', 'No records found') ?></p>
<?php endif; ?>
