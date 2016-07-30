<?= "<?php"?>

namespace <?=$moduleNs;?>;

class Module extends \yii\base\Module
{
    public $controllerNamespace = '<?=$moduleNs;?>\controllers';

    public function init()
    {
        parent::init();
    }
}
