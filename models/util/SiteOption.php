<?php
namespace app\models\util;
use yii\base\Model;
use app\models\action\Option;
use Yii;

class SiteOption extends Model{
    public $site_name;
    public $site_host;
    public $site_root;
    public $site_icp;
    public $site_admin_email;
    public $site_tongji;
    public $site_copyright;
    public $site_seo_title;
    public $site_seo_keywords;
    public $site_seo_description;

    public $comment_need_check;
    public $comment_time_interval;

    public function rules()
    {
        return[
        [['site_name','site_host','site_root','site_icp','site_admin_email',
          'site_tongji','site_copyright','site_seo_title','site_seo_keywords',
          'site_seo_description'],'string'],
        ['site_admin_email','email'],
        [['comment_need_check'],'in','range'=>[0,1]],
        [['comment_need_check','comment_time_interval'],'integer'],
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
