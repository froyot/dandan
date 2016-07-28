<?= "<?php"?>

namespace admin\modules\<?= $modelClass;?>;

class Module extends \yii\base\Module
{
    public $controllerNamespace = 'admin\modules\<?= $modelClass;?>\controllers';

    public function init()
    {
        parent::init();
    }
}
