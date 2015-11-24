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

    public $dbname;
    public $dbhost;
    public $dbport;
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
        if ($this->writeDatabseConfig()) {
            $this->saveAdmin();
            $this->saveSiteOption();
            return true;
        }
        return false;

    }

    public function saveAdmin() {
        $user = new User();
        $user->attributes = [
            'user_login' => $this->admin,
            'user_email' => $this->email,
            'password' => $this->password,
        ];
        if ($user->save()) {

            return true;
        } else {

            $this->addError('admin', 'create account error');
        }
    }

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
        if ($res) {
            $this->installSqlData();
        }
        return $res;
    }

    private function installSqlData() {
        $conn = @mysql_connect($this->dbhost, $this->db_user_name, $this->db_password);
        if (!$conn) {
            $arr['msg'] = "连接数据库失败!";
            echo json_encode($arr);
            exit;
        }

        if (!mysql_select_db($this->dbname, $conn)) {
            //创建数据时同时设置编码
            if (!mysql_query("CREATE DATABASE IF NOT EXISTS `" . $this->dbname . "` DEFAULT CHARACTER SET utf8;", $conn)) {
                $arr['msg'] = '数据库 ' . $this->dbname . ' 不存在，也没权限创建新的数据库！';
                echo json_encode($arr);
                exit;
            }
            if (empty($n)) {
                $arr['n'] = 1;
                $arr['msg'] = "成功创建数据库:{$this->dbname}<br>";
                echo json_encode($arr);
                exit;
            }
            mysql_select_db($dbName, $conn);
        }
        //读取数据文件
        $sqldata = file_get_contents(Yii::getAlias('@app') . '/install/data/data.sql');
        $sqls = explode(";\r", $sqldata);
        foreach ($sqls as $key => $sql) {
            $pattern = '/DROP TABLE IF\sEXISTS `(.*?)`/is';
            $patternCreate = '/CREATE TABLE `(.*?)`/is';
            $patternReference = '/REFERENCES `(.*?)`/';
            if (preg_match($pattern, $sql, $match)) {
                $sql = 'DROP TABLE IF EXISTS `' . $this->db_prefix . $match[1] . '`;';
            } else {
                $sql = preg_replace_callback($patternCreate, function ($match) {
                    return str_replace($match[1], $this->db_prefix . $match[1], $match[0]);
                }, $sql);

                $sql = preg_replace_callback($patternReference, function ($match) {

                    return str_replace($match[1], $this->db_prefix . $match[1], $match[0]);
                }, $sql);
                $sql .= ";";
            }
            $res = mysql_query($sql);

        }

    }
}
