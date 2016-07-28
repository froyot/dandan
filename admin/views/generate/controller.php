<?php
/**
 * This is the template for generating a CRUD controller class file.
 */

use yii\db\ActiveRecordInterface;
use yii\helpers\StringHelper;


/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\crud\Generator */

$baseControllerClassName = StringHelper::basename($controllerClass);
$baseModelClassName = StringHelper::basename($modelClass);




echo "<?php\n";
?>

namespace <?= StringHelper::dirname(ltrim($controllerClass, '\\')) ?>;



use Yii;
use <?= ltrim($modelClass, '\\') ?>;
<?php if (!empty($searchModelClass)): ?>
use <?= ltrim($searchModelClass, '\\') ?>;
<?php else: ?>
use yii\data\ActiveDataProvider;
<?php endif; ?>
use <?= ltrim($baseControllerClass, '\\') ?>;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ItemsController implements the CRUD actions for <?= $modelClass ?> model.
 */
class <?=$baseControllerClassName;?> extends <?= StringHelper::basename($baseControllerClass) . "\n" ?>
{

    public $_left_nav = ['modules','<?= lcfirst($baseModelClassName) ?>/items/index'];
    public $modelSearch = '<?= $searchModelClass ?>';
    public $modelClass = '<?= $modelClass ?>';

    public function actionIndex()
    {
        $dataProvider = $this->pageList();
        return $this->render('index',['dataProvider'=>$dataProvider]);
    }

}
