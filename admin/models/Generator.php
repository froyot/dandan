<?php
namespace admin\models;
use ReflectionClass;
use yii\gii\generators\model\Generator as ModelGenerator;
use yii\gii\CodeFile;
use Yii;
use yii\db\ActiveRecord;
use yii\web\View;
use yii\db\Schema;
use yii\helpers\Inflector;
use yii\helpers\VarDumper;
class Generator extends ModelGenerator{

    public $db = 'db';
    public $ns;
    public $moduleNs = 'admin\modules';
    public $tableName;
    public $modelClass;
    public $baseClass = 'yii\db\ActiveRecord';
    public $generateRelations = true;
    public $generateLabelsFromComments = false;
    public $useTablePrefix = false;

    public $searchModelClass;


    public function load($data, $formName = null)
    {
        if( parent::load($data, $formName) )
        {
            $this->modelClass = str_replace(" ", "", ucwords(str_replace("_", " ", strtolower($this->tableName))));

            $this->ns = $this->moduleNs;

        }
        return false;

    }
    public function rules()
    {
        return [
            [['template'], 'required', 'message' => 'A code template must be selected.'],
            [['template'], 'validateTemplate'],
            [['db', 'moduleNs', 'tableName', 'modelClass', 'baseClass'], 'filter', 'filter' => 'trim'],
            [['moduleNs'], 'filter', 'filter' => function($value) { return trim($value, '\\'); }],

            [['db', 'moduleNs', 'tableName', 'baseClass'], 'required'],
            [['db', 'modelClass'], 'match', 'pattern' => '/^\w+$/', 'message' => 'Only word characters are allowed.'],
            [['moduleNs', 'baseClass'], 'match', 'pattern' => '/^[\w\\\\]+$/', 'message' => 'Only word characters and backslashes are allowed.'],
            [['tableName'], 'match', 'pattern' => '/^(\w+\.)?([\w\*]+)$/', 'message' => 'Only word characters, and optionally an asterisk and/or a dot are allowed.'],
            [['db'], 'validateDb'],
            [['moduleNs'], 'validateNamespace'],
            [['tableName'], 'validateTableName'],
            [['modelClass'], 'validateModelClass', 'skipOnEmpty' => false],
            [['baseClass'], 'validateClass', 'params' => ['extends' => ActiveRecord::className()]],
            [['generateRelations', 'generateLabelsFromComments'], 'boolean'],
            [['enableI18N'], 'boolean'],
            [['useTablePrefix'], 'boolean'],
            [['messageCategory'], 'validateMessageCategory', 'skipOnEmpty' => false],
        ];
    }

    public function formView()
    {
        return Yii::getAlias('@admin/views/generate/form.php');
    }

    public function defaultTemplate()
    {
        $class = new ReflectionClass('yii\gii\generators\model\Generator');

        return dirname($class->getFileName()) . '/default';
    }

    public function render($template, $params = [])
    {
        $view = new View();
        if(!isset($params['generator']))
            $params['generator'] = $this;
        return $view->renderFile($template, $params, $this);
    }

    /**
     * @inheritdoc
     */
    public function generate()
    {

        $files = [];

        //生成model
        $this->ns .= "\\models";
        $relations = $this->generateRelations();
        $db = $this->getDbConnection();
        foreach ($this->getTableNames() as $tableName) {
            $className = $this->generateClassName($tableName);
            $tableSchema = $db->getTableSchema($tableName);
            $params = [
                'tableName' => $tableName,
                'className' => $className,
                'tableSchema' => $tableSchema,
                'labels' => $this->generateLabels($tableSchema),
                'rules' => $this->generateRules($tableSchema),
                'relations' => isset($relations[$className]) ? $relations[$className] : [],
            ];


            $files[] = new CodeFile(
                Yii::getAlias('@' . str_replace('\\', '/', $this->ns)) . '/' . $className . '.php',
                $this->render('@yii/gii/generators/model/default/model.php', $params)
            );

            //生成searchmodel
            $this->searchModelClass = $this->ns."\\".$this->modelClass."Search";
            if (!empty($this->searchModelClass)) {
                $searchModel = Yii::getAlias('@' . str_replace('\\', '/', $this->searchModelClass). '.php');
                $searchGenerator = clone $this;

                $searchGenerator->modelClass = $this->ns."\\".$this->modelClass;

                $files[] = new CodeFile($searchModel, $this->render('@yii/gii/generators/crud/default/search.php',['generator'=>$searchGenerator]));
                // $this->modelClass = $searchGenerator->modelClass;
            }


            //生成curd controller

            $controllerClass = $this->moduleNs."\\controllers\\ItemsController";
            $controllerFile = Yii::getAlias('@' . str_replace('\\', '/', ltrim($controllerClass, '\\')) . '.php');

            $files[]= new CodeFile($controllerFile, $this->render('@admin/views/generate/controller.php',[
                'controllerClass'=>$controllerClass,
                'modelClass'=>$this->ns."\\".$this->modelClass,
                'searchModelClass'=>$this->searchModelClass,
                'baseControllerClass'=>'admin\components\Controller'
            ]));

            //生成view文件
            $viewPath = '../'.$this->moduleNs."/views/items";
            $templatePath = Yii::getAlias('@admin/views/generate/views');
            foreach (scandir($templatePath) as $file) {
                if (empty($this->searchModelClass) && $file === '_search.php') {
                    continue;
                }
                if (is_file($templatePath . '/' . $file) && pathinfo($file, PATHINFO_EXTENSION) === 'php') {
                    $files[] = new CodeFile("$viewPath/$file", $this->render("@admin/views/generate/views/".$file,[
                            'modelClass'=>$this->ns."\\".$this->modelClass,
                            'generator'=>$this
                        ]));
                }
            }

            //生成module文件
            $moduleFile = $this->moduleNs."\\Module";
            $moduleFile = Yii::getAlias('@' . str_replace('\\', '/', ltrim($moduleFile, '\\')) . '.php');

            $files[]= new CodeFile($moduleFile, $this->render('@admin/views/generate/module.php',[
                'moduleNs'=>$this->moduleNs,
            ]));

        }


        //生成CURD

        return $files;
    }


    //search model
    //
    /**
     * @return array model column names
     */
    public function getColumnNames()
    {
        $db = $this->getDbConnection();
        return $db->getTableSchema($this->tableName)->getColumnNames();

    }

    public function getSaveColumnNames()
    {
        $primaryKey = [];
        if (($table =$this->getDbConnection()->getTableSchema($this->tableName)) !== false)
        {
            $primaryKey = $table->primaryKey;
        }
        else
        {
            return [];
        }
        $column = $table->getColumnNames();
        return array_diff($column,$primaryKey);

    }
   /**
     * Generates validation rules for the search model.
     * @return array the generated validation rules
     */
    public function generateSearchRules()
    {
        $db = $this->getDbConnection();
        if (($table = $db->getTableSchema($this->tableName)) === false) {
            return ["[['" . implode("', '", $this->getColumnNames()) . "'], 'safe']"];
        }
        $types = [];
        foreach ($table->columns as $column) {
            switch ($column->type) {
                case Schema::TYPE_SMALLINT:
                case Schema::TYPE_INTEGER:
                case Schema::TYPE_BIGINT:
                    $types['integer'][] = $column->name;
                    break;
                case Schema::TYPE_BOOLEAN:
                    $types['boolean'][] = $column->name;
                    break;
                case Schema::TYPE_FLOAT:
                case Schema::TYPE_DOUBLE:
                case Schema::TYPE_DECIMAL:
                case Schema::TYPE_MONEY:
                    $types['number'][] = $column->name;
                    break;
                case Schema::TYPE_DATE:
                case Schema::TYPE_TIME:
                case Schema::TYPE_DATETIME:
                case Schema::TYPE_TIMESTAMP:
                default:
                    $types['safe'][] = $column->name;
                    break;
            }
        }

        $rules = [];
        foreach ($types as $type => $columns) {
            $rules[] = "[['" . implode("', '", $columns) . "'], '$type']";
        }

        return $rules;
    }

    public function generateSearchLabels()
    {


        $attributeLabels = [];
        $labels = [];
        foreach ($this->getColumnNames() as $name) {
            if (isset($attributeLabels[$name])) {
                $labels[$name] = $attributeLabels[$name];
            } else {
                if (!strcasecmp($name, 'id')) {
                    $labels[$name] = 'ID';
                } else {
                    $label = Inflector::camel2words($name);
                    if (!empty($label) && substr_compare($label, ' id', -3, 3, true) === 0) {
                        $label = substr($label, 0, -3) . ' ID';
                    }
                    $labels[$name] = $label;
                }
            }
        }

        return $labels;
    }

    public function getSearchAttributes()
    {
        return $this->getColumnNames();
    }

 /**
     * Generates search conditions
     * @return array
     */
    public function generateSearchConditions()
    {
        $db = $this->getDbConnection();
        $columns = [];
        if (($table = $db->getTableSchema($this->tableName)) === false) {
            $class = $this->modelClass;
            /* @var $model \yii\base\Model */
            $model = new $class();
            foreach ($model->attributes() as $attribute) {
                $columns[$attribute] = 'unknown';
            }
        } else {
            foreach ($table->columns as $column) {
                $columns[$column->name] = $column->type;
            }
        }

        $likeConditions = [];
        $hashConditions = [];
        foreach ($columns as $column => $type) {
            switch ($type) {
                case Schema::TYPE_SMALLINT:
                case Schema::TYPE_INTEGER:
                case Schema::TYPE_BIGINT:
                case Schema::TYPE_BOOLEAN:
                case Schema::TYPE_FLOAT:
                case Schema::TYPE_DOUBLE:
                case Schema::TYPE_DECIMAL:
                case Schema::TYPE_MONEY:
                case Schema::TYPE_DATE:
                case Schema::TYPE_TIME:
                case Schema::TYPE_DATETIME:
                case Schema::TYPE_TIMESTAMP:
                    $hashConditions[] = "'{$column}' => \$this->{$column},";
                    break;
                default:
                    $likeConditions[] = "->andFilterWhere(['like', '{$column}', \$this->{$column}])";
                    break;
            }
        }

        $conditions = [];
        if (!empty($hashConditions)) {
            $conditions[] = "\$query->andFilterWhere([\n"
                . str_repeat(' ', 12) . implode("\n" . str_repeat(' ', 12), $hashConditions)
                . "\n" . str_repeat(' ', 8) . "]);\n";
        }
        if (!empty($likeConditions)) {
            $conditions[] = "\$query" . implode("\n" . str_repeat(' ', 12), $likeConditions) . ";\n";
        }

        return $conditions;
    }


        /**
     * Generates code for active field
     * @param string $attribute
     * @return string
     */
    public function generateActiveField($attribute)
    {

        $tableSchema = $this->getDbConnection()->getTableSchema($this->tableName);
        if ($tableSchema === false || !isset($tableSchema->columns[$attribute])) {
            if (preg_match('/^(password|pass|passwd|passcode)$/i', $attribute)) {
                return "\$form->field(\$model, '$attribute')->passwordInput()";
            } else {
                return "\$form->field(\$model, '$attribute')";
            }
        }
        $column = $tableSchema->columns[$attribute];

        if($column->type =='datetime')
        {

            return "\$form->field(\$model, '$attribute')->render(function(\$filed){

                return '<div class=\"has-feedback\"><input type=\"text\" class=\"form-control has-feedback-left datetimeinput\"   aria-describedby=\"inputSuccess$attribute\" value=\"'.\$filed->model->$attribute.'\">
                        <span class=\"fa fa-calendar-o form-control-feedback left\" aria-hidden=\"true\"></span>
                        <span id=\"inputSuccess$attribute\" class=\"sr-only\">(success)</span></div>
                      ';
            })";
        }
        elseif ($column->phpType === 'boolean') {
            return "\$form->field(\$model, '$attribute')->checkbox()";
        } elseif ($column->type === 'text') {
            return "\$form->field(\$model, '$attribute')->textarea(['rows' => 6])";
        }
        elseif($column->name =="status")
        {
            $dropDownOptions = [
            '0'=>'Not Used',
            '1'=>'Used'
            ];
            return "\$form->field(\$model, '$attribute')->dropDownList("
                    . preg_replace("/\n\s*/", ' ', VarDumper::export($dropDownOptions)).")";
        }
        else {
            if (preg_match('/^(password|pass|passwd|passcode)$/i', $column->name)) {
                $input = 'passwordInput';
            } else {
                $input = 'textInput';
            }
            if (is_array($column->enumValues) && count($column->enumValues) > 0) {
                $dropDownOptions = [];
                foreach ($column->enumValues as $enumValue) {
                    $dropDownOptions[$enumValue] = Inflector::humanize($enumValue);
                }
                return "\$form->field(\$model, '$attribute')->dropDownList("
                    . preg_replace("/\n\s*/", ' ', VarDumper::export($dropDownOptions)).", ['prompt' => ''])";
            } elseif ($column->phpType !== 'string' || $column->size === null) {
                return "\$form->field(\$model, '$attribute')->$input()";
            } else {
                return "\$form->field(\$model, '$attribute')->$input(['maxlength' => $column->size])";
            }
        }
    }
    /**
     * Generates column format
     * @param \yii\db\ColumnSchema $column
     * @return string
     */
    public function generateColumnFormat($column)
    {
        if ($column->phpType === 'boolean') {
            return 'boolean';
        } elseif ($column->type === 'text') {
            return 'ntext';
        } elseif (stripos($column->name, 'time') !== false && $column->phpType === 'integer') {
            return 'datetime';
        } elseif (stripos($column->name, 'email') !== false) {
            return 'email';
        } elseif (stripos($column->name, 'url') !== false) {
            return 'url';
        } else {
            return 'text';
        }
    }

}
