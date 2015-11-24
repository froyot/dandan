<?php
namespace app\models\util;
use app\models\action\Option;
use Yii;
use yii\base\Model;

class SiteOption extends Model {
    /**
     * $site_name   site name display in front
     * @var string
     */
    public $site_name;

    /**
     * site_icp     site_icp info
     * @var string
     */
    public $site_icp;

    /**
     * $site_admin_email  site admin email address
     * @var string email
     */
    public $site_admin_email;

    /**
     * site_tongji en html or js code for analysis,raw code
     * @var string
     */
    public $site_tongji;

    /**
     * $site_copyright  site copyright infomation,allow html code
     * @var string
     */
    public $site_copyright;

    /**
     * $site_seo_title   seo title,display in page title
     * @var string
     */
    public $site_seo_title;

    /**
     * $site_seo_keywords   site keywords,explode by ',''
     * @var string
     */
    public $site_seo_keywords;

    /**
     * $site_seo_description  site description
     * @var string
     */
    public $site_seo_description;

    /**
     * $comment_need_check  comment is need to check
     * @var int,1 is need check,0 don't need
     */
    public $comment_need_check;

    /**
     * $comment_time_interval   comment frequence time limit for same post
     * @var int
     */
    public $comment_time_interval;

    /**
     * $comment_type  type of comment,
     * 0 site comment system;
     * 1 changyan comment system,
     * 2 disque comment system
     *
     * @var int
     */
    public $comment_type; //评论类型

    /**
     * comment_appid, the appid for other comment system
     * @var string
     */
    public $comment_appid;

    /**
     * comment_appkey, the appkey for other comment system
     * @var string
     */
    public $comment_appkey;

    /**
     * smtp sender email address
     * @var string
     */
    public $smtp_username;

    /**
     * smtp sender account password
     * @var string
     */
    public $smtp_password;

    /**
     * smtp sender server port
     * @var int
     */
    public $smtp_port;

    /**
     * smtp sender server host
     * @var string
     */
    public $smtp_host;

    /**
     * smtp sender display laebl
     * @var int
     */
    public $smtp_label;

    /**
     * site_themes  site themes floder name
     * @var string
     */
    public $site_themes;

    public function rules() {
        return [
            [['site_name', 'site_icp', 'site_admin_email',
                'site_tongji', 'site_copyright', 'site_seo_title',
                'site_seo_keywords', 'site_seo_description', 'smtp_password',
                'smtp_label', 'smtp_host', 'site_themes'], 'string'],

            [['site_admin_email', 'smtp_username'], 'email'],

            [['comment_need_check'], 'in', 'range' => [0, 1]],

            [
                ['comment_need_check', 'comment_time_interval',
                    'smtp_port'], 'integer',
            ],

            ['comment_type', 'in', 'range' => [0, 1, 2]],

            [
                ['comment_appid', 'comment_appkey', 'comment_type'],
                'validateOtherComment',
            ],

        ];
    }

    /**
     * validate other comment system if appid, appkey is set
     * @author Allon<xianlong300@sina.com>
     * @dateTime 2015-11-24T14:38:03+0800
     * @param    string                   $attribute param name
     * @param    maxid                    $params    param value
     */
    public function validateOtherComment($attribute, $params) {
        if (!$this->hasErrors()) {
            if ($this->comment_type != 0) {
                if (!$this->comment_appid) {
                    $this->addError('comment_appid', 'not allow empty');
                }
                if (!$this->comment_appkey) {
                    $this->addError('comment_appkey', 'not allow empty');
                }
            }
        }
    }

    /**
     * attributeLabel
     * @author Allon<xianlong300@sina.com>
     * @dateTime 2015-11-24T14:39:05+0800
     * @return   array label arrays
     */
    public function attributeLabels() {
        return [
            'site_name' => Yii::t('app', 'site_name'),
            'site_icp' => Yii::t('app', 'site_icp'),
            'site_admin_email' => Yii::t('app', 'site_admin_email'),
            'site_tongji' => Yii::t('app', 'site_tongji'),
            'site_copyright' => Yii::t('app', 'site_copyright'),
            'site_seo_title' => Yii::t('app', 'site_seo_title'),
            'site_seo_keywords' => Yii::t('app', 'site_seo_keywords'),
            'site_seo_description' => Yii::t('app', 'site_seo_description'),
            'comment_need_check' => Yii::t('app', 'comment_need_check'),
            'comment_time_interval' => Yii::t('app', 'comment_time_interval'),
            'comment_type' => Yii::t('app', 'comment_type'),
            'comment_appid' => Yii::t('app', 'comment_appid'),
            'comment_appkey' => Yii::t('app', 'comment_appkey'),
            'smtp_username' => Yii::t('app', 'smtp_username'),
            'smtp_password' => Yii::t('app', 'smtp_password'),
            'smtp_port' => Yii::t('app', 'smtp_port'),
            'stmm_label' => Yii::t('app', 'stmm_label'),
            'smtp_host' => Yii::t('app', 'smtp_host'),
            'smtp_label' => Yii::t('app', 'smtp_label'),
            'site_themes' => Yii::t('app', 'site_themes'),
        ];
    }

    /**
     * make site option model to string
     * @author Allon<xianlong300@sina.com>
     * @dateTime 2015-11-24T14:39:40+0800
     * @return   string         site option model json string
     */
    public function toString() {
        return json_encode($this->toArray());
    }

    /**
     * save site option model
     * @author Allon<xianlong300@sina.com>
     * @dateTime 2015-11-24T14:40:30+0800
     * @return   boolean
     */
    public function save() {
        if (!$this->validate()) {
            return false;
        }

        $option = Option::findOne(['option_name' => 'site_options']);
        if (!$option) {
            $option = new Option();
            $option->option_name = 'site_options';
        }
        $option->option_value = $this->toString();
        $res = $option->save();
        if ($res) {
            Yii::$app->cacheManage->site_option = null;
        }
        return $res;
    }
}
