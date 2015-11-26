<?php
namespace app\install\models;
use app\models\action\User;
use app\models\util\SiteOption;
use Yii;
use yii\base\Model;

class InstallForm extends Model {
    public $admin;
    public $password;
    public $repeatPassword;
    public $email;

    public $site_name;
    public $site_seo_keywords;
    public $site_seo_description;

    public $dbname = 'dandan';
    public $dbhost = 'localhost';
    public $dbport = 3360;
    public $db_user_name;
    public $db_password;
    public $db_prefix = '';

    public function rules() {
        return [
            [
                ['admin', 'password', 'repeatPassword', 'email', 'site_name',
                    'site_seo_keywords', 'site_seo_description', 'dbname', 'dbhost',
                    'db_user_name', 'db_password', 'db_prefix'], 'string',
            ],
            ['dbport', 'integer'],
            ['email', 'email'],
            [['admin', 'password', 'repeatPassword', 'email', 'site_name',
                'dbname', 'dbhost',
                'db_user_name', 'db_password'], 'required'],
            ['dbhost', 'checkDatabase'],
        ];
    }

    public function attributeLabels() {
        return [
            'admin' => Yii::t('app', 'admin'),
            'password' => Yii::t('app', 'password'),
            'repeatPassword' => Yii::t('app', 'repeatPassword'),
            'email' => Yii::t('app', 'email'),
            'site_name' => Yii::t('app', 'site_name'),
            'site_seo_keywords' => Yii::t('app', 'site_seo_keywords'),
            'site_seo_description' => Yii::t('app', 'site_seo_description'),
            'dbname' => Yii::t('app', 'dbname'),
            'dbhost' => Yii::t('app', 'dbhost'),
            'dbport' => Yii::t('app', 'dbport'),
            'db_user_name' => Yii::t('app', 'db_user_name'),
            'db_password' => Yii::t('app', 'db_password'),
            'db_prefix' => Yii::t('app', 'db_prefix'),
        ];
    }
    public function checkDatabase($attributes, $params) {
        //验证数据库
        if (!$this->hasErrors() && $this->dbname &&
            $this->db_password && $this->db_user_name) {
            $dns = "mysql:host=%s;dbname=%s";
            $dns = sprintf($dns, $this->dbhost, $this->dbname);
            $connection = new \yii\db\Connection([
                'dsn' => $dns,
                'username' => $this->db_user_name,
                'password' => $this->db_password,
                'charset' => 'utf8',
                'tablePrefix' => $this->db_prefix,

            ]);
            if ($connection->open()) {
                $this->addError('dbhost', 'can not connect to database');
            }
        }
    }

    public function save() {
        $adminId = $this->saveAdmin();
        if ($adminId) {
            $this->initPermission($adminId);

        }
        $this->saveSiteOption();
        return true;

    }

    /**
     * create admin config in data base
     * make sure you are create db.config.php file
     * @author Allon<xianlong300@sina.com>
     * @dateTime 2015-11-26T15:58:48+0800
     * @return   [type]                   [description]
     */
    public function saveAdmin() {
        $user = new User();
        $user->attributes = [
            'user_login' => $this->admin,
            'user_email' => $this->email,
            'password' => $this->password,
        ];
        if ($user->save()) {

            return $user->getPrimaryKey();
        } else {

            $this->addError('admin', 'create account error');
        }
    }

    /**
     * save other site option to databse
     * @author Allon<xianlong300@sina.com>
     * @dateTime 2015-11-26T15:59:36+0800
     */
    public function saveSiteOption() {
        $option = new SiteOption();
        $option->attributes = [
            'site_name' => $this->site_name,
            'site_seo_title' => $this->site_name,
            'site_seo_keywords' => $this->site_seo_keywords,
            'site_seo_description' => $this->site_seo_description,
        ];
        $option->save();
    }

    /**
     * write databse config to db.config.php
     * @author Allon<xianlong300@sina.com>
     * @dateTime 2015-11-26T15:59:56+0800
     * @return   boolean   is write success
     */
    public function writeDatabseConfig() {
        $configFormat =
        "<?php\n" .
        "return [\n" .
        "'class' => 'yii\db\Connection',\n" .
        "'dsn' => 'mysql:host=%s;dbname=%s',\n" .
        "'username' => '%s',\n" .
        "'password' => '%s',\n" .
        "'charset' => 'utf8',\n" .
        "'tablePrefix' => '%s'\n" .
        "];\n";

        $config = sprintf(
            $configFormat,
            $this->dbhost, $this->dbname,
            $this->db_user_name, $this->db_password,
            $this->db_prefix
        );
        $dbConfigPath = Yii::getAlias('@app') . '/config/db.config.php';

        $fp = @fopen($dbConfigPath, "w");
        if (!$fp) {
            return false;
        }
        $res = fwrite($fp, $config);
        fclose($fp);
        return $res;
    }

    /**
     * init users permission
     * @author Allon<xianlong300@sina.com>
     * @dateTime 2015-11-26T16:00:28+0800
     * @param    int                   $adminId super admin user id
     */
    private function initPermission($adminId) {
        $auth = Yii::$app->authManager;
        $auth->removeAll();
        $initRbac = $auth->createPermission('initRbac');
        $initRbac->description = 'Init rbac';
        $auth->add($initRbac);

        $manageRbac = $auth->createPermission('manageRbac');
        $manageRbac->description = 'Manage rbac';
        $auth->add($manageRbac);

        $author = $auth->createRole('user');
        $auth->add($author);
        $editor = $auth->createRole('editor');
        $auth->add($editor);

        $admin = $auth->createRole('admin');
        $auth->add($admin);
        $auth->addChild($admin, $manageRbac);
        $auth->addChild($admin, $initRbac);
        $auth->addChild($admin, $author);
        $auth->addChild($admin, $editor);

        $defaultPemission = Yii::$app->controller->module->params['defaultPermision'];

        foreach ($defaultPemission as $key => $description) {
            $permission = $auth->createPermission($key);
            $permission->description = $description;
            $auth->add($permission);
            $auth->addChild($admin, $permission);
        }
        $auth->assign($admin, $adminId);
    }

    /**
     * load data from install/data/data.sql file
     * @author Allon<xianlong300@sina.com>
     * @dateTime 2015-11-26T16:01:02+0800
     * @param    integer                  $id index of sql command
     */
    public function installData($id = 0) {
        $conn = @mysql_connect($this->dbhost, $this->db_user_name, $this->db_password);
        if (!$conn) {
            $this->addError('tips', '连接数据库失败!');
            return null;
        }

        if (!mysql_select_db($this->dbname, $conn)) {
            //创建数据时同时设置编码
            if (!mysql_query(
                "CREATE DATABASE IF NOT EXISTS `" .
                $this->dbname . "` DEFAULT CHARACTER SET utf8;", $conn)) {
                $this->addError(
                    'tips', '数据库 ' . $this->dbname .
                    ' 不存在，也没权限创建新的数据库！');
                return null;
            }
            mysql_select_db($dbName, $conn);
        }
        //读取数据文件
        $sqldata = file_get_contents(Yii::getAlias('@app') . '/install/data/data.sql');
        $sqls = explode(";\r", $sqldata);
        if ($id < count($sqls)) {
            $sql = $sqls[$id];
            $pattern = '/DROP TABLE IF\sEXISTS `(.*?)`/is';
            $patternCreate = '/CREATE TABLE `(.*?)`/is';
            $patternReference = '/REFERENCES `(.*?)`/';
            $patternConstraint = '/CONSTRAINT `(.*?)`/';
            if (preg_match($pattern, $sql, $match)) {
                $sql = 'DROP TABLE IF EXISTS `' . $this->db_prefix . $match[1] . '`;';
            } else {
                $sql = preg_replace_callback($patternCreate, function ($match) {
                    return str_replace($match[1], $this->db_prefix . $match[1], $match[0]);
                }, $sql);

                $sql = preg_replace_callback($patternReference, function ($match) {

                    return str_replace($match[1], $this->db_prefix . $match[1], $match[0]);
                }, $sql);
                $sql = preg_replace_callback($patternConstraint, function ($match) {

                    return str_replace($match[1], $this->db_prefix . $match[1], $match[0]);
                }, $sql);

                $sql .= ";";
            }
            $res = mysql_query($sql);
            $next = $id < count($sqls) - 1 ? $id + 1 : $id;
            return [$next, $sql];
        }

    }
}
