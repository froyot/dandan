<?php
use yii\helpers\Url;

$this->title = Yii::t('easydandan', 'Admins');
?>



<?php if($dataProvider->count > 0) : ?>
    <table class="table table-hover">
        <thead>
        <tr>
            <th width="50">#</th>
            <th><?= Yii::t('easydandan', 'Username') ?></th>
            <th width="50"></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach($dataProvider->models as $admin) : ?>
            <tr>
                <td><?= $admin->admin_id ?></td>
                <td><a href="<?= Url::to(['/admin/admins/view', 'id' => $admin->admin_id]) ?>"><?= $admin->username ?></a></td>
                <td>
                    <a href="<?= Url::to(['/admin/admins/edit', 'id' => $admin->admin_id]) ?>" class="glyphicon glyphicon-edit" title="<?= Yii::t('easydandan', 'Delete item') ?>"></a>
                    <a href="<?= Url::to(['/admin/admins/delete', 'id' => $admin->admin_id]) ?>" class="glyphicon glyphicon-remove confirm-delete" title="<?= Yii::t('easydandan', 'Delete item') ?>"></a></td>
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
