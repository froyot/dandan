<?php
namespace app\models\util;
use yii\base\Model;
use app\models\action\Option;
use Yii;

class SiteOption extends Model{
    public $site_name;
    public $site_icp;
    public $site_admin_email;
    public $site_tongji;
    public $site_copyright;
    public $site_seo_title;
    public $site_seo_keywords;
    public $site_seo_description;

    public $comment_need_check;
    public $comment_time_interval;

    public $comment_type;//评论类型
    public $comment_appid;
    public $comment_appkey;

    public $smtp_username;
    public $smtp_password;
    public $smtp_port;
    public $smtp_host;
    public $smtp_label;

    public $site_themes;

    public function rules()
    {
        return[
        [['site_name','site_icp','site_admin_email',
          'site_tongji','site_copyright','site_seo_title','site_seo_keywords',
          'site_seo_description','smtp_password','smtp_label','smtp_host','site_themes'],'string'],
        [['site_admin_email','smtp_username'],'email'],
        [['comment_need_check'],'in','range'=>[0,1]],
        [['comment_need_check','comment_time_interval','smtp_port'],'integer'],
        ['comment_type','in','range'=>[0,1,2]],
        [['comment_appid','comment_appkey','comment_type'],'validateOtherComment'],

        ];
    }

    public function validateOtherComment( $attribute, $params )
    {
        if( !$this->hasErrors() )
        {
            if($this->comment_type !=0 )
            {
                if( !$this->comment_appid )
                {
                    $this->addError('comment_appid', 'not allow empty');
                }
                if( !$this->comment_appkey )
                {
                    $this->addError('comment_appkey', 'not allow empty');
                }
            }
        }
    }
    public function attributeLabels()
    {
        return [
            'site_name' => Yii::t('app','site_name'),
            'site_icp' => Yii::t('app','site_icp'),
            'site_admin_email' => Yii::t('app','site_admin_email'),
            'site_tongji' => Yii::t('app','site_tongji'),
            'site_copyright' => Yii::t('app','site_copyright'),
            'site_seo_title' => Yii::t('app','site_seo_title'),
            'site_seo_keywords' => Yii::t('app','site_seo_keywords'),
            'site_seo_description' => Yii::t('app','site_seo_description'),
            'comment_need_check' => Yii::t('app','comment_need_check'),
            'comment_time_interval' => Yii::t('app','comment_time_interval'),
            'comment_type'=>Yii::t('app','comment_type'),
            'comment_appid'=>Yii::t('app','comment_appid'),
            'comment_appkey'=>Yii::t('app','comment_appkey'),
            'smtp_username'=>Yii::t('app','smtp_username'),
            'smtp_password'=>Yii::t('app','smtp_password'),
            'smtp_port'=>Yii::t('app','smtp_port'),
            'stmm_label'=>Yii::t('app','stmm_label'),
            'smtp_host'=>Yii::t('app','smtp_host'),
            'smtp_label'=>Yii::t('app','smtp_label'),
            'site_themes'=>Yii::t('app','site_themes')
        ];
    }

    public function toString()
    {
        return json_encode( $this->toArray() );
    }

    public function save()
    {
        if( !$this->validate() )
        {
            return false;
        }

        $option = Option::findOne(['option_name'=>'site_options']);
        if( !$option )
        {
            return false;
        }
        $option->option_value = $this->toString();
        $res = $option->save();
        if( $res )
        {
            Yii::$app->cacheManage->site_option = null;
        }
        return $res;
    }
}
