<?php
namespace app\common\helper;
use app\models\front\Config;
class ViewHelper
{
    public static $config;
    private function getConfig()
    {
        if(ViewHelper::$config == null)
            ViewHelper::$config = Config::getConfig();
    }

    public function getLinks()
    {
        ViewHelper::getConfig();
        $links = ViewHelper::$config['links'];
        return $links;
    }

    public function getCopyright()
    {
        ViewHelper::getConfig();
        $copy = ViewHelper::$config['copyRight'];
        return $copy;
    }

    public function getLeftAd($key)
    {
        ViewHelper::getConfig();
        switch($key)
        {
            case 'title':
            case 'tips':
                return ViewHelper::$config['leftAd'][$key];break;
            case 'img':
                if(!ViewHelper::$config['leftAd'][$key])
                {
                    return Yii::$app->baseUrl.'/images/rose.jpg';
                }
                elseif(strpos(ViewHelper::$config['leftAd'][$key],'http://') === 0)
                {
                    return ViewHelper::$config['leftAd'][$key];
                }
                else
                {
                    return Yii::$app->baseUrl.'/'.ViewHelper::$config['leftAd'][$key];
                }
            case 'url':
                if(ViewHelper::$config['leftAd'][$key] == '' || ViewHelper::$config['leftAd'][$key] == '#')
                {
                    return '';
                }
                else
                {
                    return '<a href="'.ViewHelper::$config['leftAd'][$key].'">View</a>';
                }

        }
    }

    public function getFooter($key)
    {
        ViewHelper::getConfig();
        switch($key)
        {
            case 'title':return ViewHelper::$config['footerContent']['title'];break;
            case 'tips':return ViewHelper::$config['footerContent']['tips'];break;
            default : return '';
        }
    }
    public function getSiteName()
    {
        ViewHelper::getConfig();
        if(ViewHelper::$config['sysName'])
        {
            return ViewHelper::$config['sysName'];
        }

        return \Yii::$app->name;
    }
}
