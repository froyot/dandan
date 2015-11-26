<?php
/**
 * 用户操作类，所有对用户的基本操作在该文件中实现
 */
namespace app\models\action;
use app\models\db\AuthAssignment;
use app\models\db\Users as UserDb;
use Yii;
use yii\base\InvalidParamException;
use yii\helpers\ArrayHelper;

class User extends UserDb implements \yii\web\IdentityInterface {
    public $role;
    public function init() {
        parent::init();
        $this->on(self::EVENT_AFTER_INSERT, [$this, 'afterDataInsert']);
        $this->on(self::EVENT_AFTER_UPDATE, [$this, 'afterDataUpdate']);
        $this->on(self::EVENT_AFTER_DELETE, [$this, 'afterDataDelete']);
    }
    /**
     * unencode password
     * @var string
     */
    public $password;

    public function rules() {
        return ArrayHelper::merge(parent::rules(), [
            ['password', 'string'],
            ['role', 'string'],
            ['user_status', 'default', 'value' => 1],
        ]);
    }

    public function afterDataInsert($event) {
        //更新权限
        $role = Yii::$app->authManager->getRole($event->sender->role);
        if ($role) {
            Yii::$app->authManager->assign($role, $event->sender->getPrimaryKey());
        }

    }

    public function afterDataUpdate($event) {

        //更新权限
        $role = Yii::$app->authManager->getRole($event->sender->role);
        $olderRoles = Yii::$app->authManager->getRolesByUser($event->sender->getPrimaryKey());
        //角色没变化
        if (isset($olderRoles[$event->sender->role])) {
            return true;
        } elseif ($role) {
            //删除原来的角色分配
            Yii::$app->authManager->revokeAll($event->sender->getPrimaryKey());
            Yii::$app->authManager->assign($role, $event->sender->getPrimaryKey());
        }
    }
    public function afterDataDelete($event) {

        Yii::$app->authManager->revokeAll($event->sender->getPrimaryKey());

    }
    public function attributeLabels() {
        $label = parent::attributeLabels();
        foreach ($label as $key => $item) {
            $label[$key] = Yii::t('app', $key);
        }
        return $label;
    }
    /**
     * @inheritdoc
     */
    public static function findIdentity($id) {
        return self::findOne($id);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null) {
        return null;
    }

    /**
     * @inheritdoc
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey() {
        return '';
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey) {
        return false;
    }

    /**
     * Validates password
     *
     * @param  string  $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password) {
        return Yii::$app->security->validatePassword($password, $this->user_pass);
    }

    public function getAuthAssignment() {
        return $this->hasOne(AuthAssignment::className(), ['user_id' => 'id']);
    }

    /**
     * 保存前数据处理
     * @return [type] [description]
     */
    public function beforeSave($insert) {
        if (parent::beforeSave($insert)) {
            //设置默认用户昵称
            $this->user_nicename = $this->user_login;
            //判断用户密码是否编码
            if ($this->password) {
                $this->user_pass =
                Yii::$app->security->generatePasswordHash($this->password);
            } elseif ($insert) {
                throw new InvalidParamException(
                    'Password must be a string and cannot be empty.'
                );
            }

            //插入前数据处理
            if ($insert) {
                $this->create_time = date('Y-m-d H:i:s');
                $this->last_login_time = date('Y-m-d H:i:s');
                $hash = rand(100, 999);
                $this->user_activation_key =
                substr(md5($hash), 0, 16) .
                substr(md5(rand(100, 999) . time()), 0, 16) . $hash;
            }
            return true;
        }
    }

    /**
     * 静态方法，判断用户名是否存在
     * @param  string  $name 用户名
     * @return boolean  存在true,不存在false
     */
    public static function checkUserNameExist($name) {
        return (boolean) self::find()
            ->where(['user_login' => $name])
            ->select('id')
            ->one();
    }

    /**
     * 静态方法，判断用户名是否存在
     * @param  string  $name 用户名
     * @return boolean  存在true,不存在false
     */
    public static function checkEmailExist($email) {
        return (boolean) self::find()
            ->where(['user_email' => $email])
            ->select('id')
            ->one();
    }

    /**
     * 获取用户激活码
     * @return [type] [description]
     */
    public function getActiveCode() {
        return $this->user_activation_key;
    }

    public static function activeUser($code) {
        $user = User::findOne(['user_activation_key' => $code]);
        if ($user) {
            //标注激活状态
            $user->user_status = 1;
            return $user->save();
        }
        return false;
    }

    public function getNickName() {
        if ($this->user_nicename) {
            return $this->user_nicename;
        } else {
            return $this->user_login;
        }

    }
}
