<?php

namespace app\models\front;

use Yii;
use app\models\db\Config as ConfigModel;
use yii\helpers\ArrayHelper;

class Config extends ConfigModel
{
    private static $config;

    /**
     * 获取配置信息，如果有缓存直接读缓存，没有则读数据库
     * @return [type] [description]
     */
    public function getConfig()
    {
        $config = Yii::$app->cache->get('siteConfig');
        if( $config )
        {
            return unserialize($config);
        }
        Config::$config = Config::find()->asArray()->all();
        Config::$config = ArrayHelper::map(Config::$config,'key','value');
        Config::handelData();
        Yii::$app->cache->set('siteConfig',serialize(Config::$config));
        return Config::$config;
    }

    /**
     * 对数据库读取的配置进行处理
     * @return [type] [description]
     */
    private function handelData()
    {
        foreach( Config::$config as $key => $config)
        {
            switch( $key )
            {
                case 'leftAd':
                    Config::handelAd();
                    break;
                case 'footerContent':
                    Config::handelFooter();
                    break;
                case 'links':
                    Config::handelLinks();
                    break;
            }
        }
        Config::handelCopyRight();
    }

    /**
     * 站点copryRight 配置生成
     * @return [type] [description]
     */
    private function handelCopyRight()
    {
        if( isset(Config::$config['copyRight']) )
        {
            $config  = Config::$config['copyRight'];
        }
        else
        {
            $config = null;
        }
        $copys = '';
        if( $config )
            $copys = $config;
        else
        {


            if( isset( Config::$config['author'] ) )
            {
                if( !isset( Config::$config['sysName'] ) )
                {
                    $copys .= "<a href='".Yii::$app->request->hostInfo.
                                "'>".Config::$config['author']."</a>";
                }
                else
                {
                    $copys .= Config::$config['author'];
                }
                $copys .= "&nbsp;&nbsp;";
            }
            if( isset( Config::$config['sysName'] ) )
            {
                $copys .= "<a href='".Yii::$app->request->hostInfo."'>".
                            Config::$config['sysName']."</a>";
            }
        }
        if( !$copys )
        {
            $copys = Yii::$app->params['copyRight'];
        }
        $copys = "Copyright &copy;".date('Y')."&nbsp " .$copys;

        Config::$config['copyRight'] = $copys;
    }

    /**
     * 处理网站底部设置
     * @return [type] [description]
     */
    private function handelFooter(  )
    {
        $config  = json_decode(Config::$config['footerContent'],true);
        $default = Yii::$app->params['footer'];

        if( !isset($config['title'] ) )
            $config['title'] = $default['title'];
        if( !isset($config['tips'] ) )
            $config['tips'] = $default['tips'];
        Config::$config['footerContent'] = $config;
    }

    /**
     * 处理侧边广告设置
     * @return [type] [description]
     */
    private function handelAd(  )
    {
        $config  = json_decode(Config::$config['leftAd'],true);
        $default = Yii::$app->params['leftAd'];
        if( !isset($config['title'] ) )
            $config['title'] = $default['title'];
        if( !isset($config['img'] ) )
            $config['img'] = $default['img'];
        if( !isset($config['url'] ) )
            $config['url'] = $default['url'];
        if( !isset($config['tips'] ) )
            $config['tips'] = $default['tips'];
        Config::$config['leftAd'] = $config;
    }

    /**
     * 友情链接处理
     * @return [type] [description]
     */
    private function handelLinks(  )
    {
        $config  = json_decode(Config::$config['links'],true);
        $default = Yii::$app->params['links'];
        if( is_array( $config ) )
        {
            foreach( $config as $k => $v )
            {
                if( !(is_array($v) && isset( $v['text'] ) && isset( $v['link'] ) ) )
                {
                    unset( $config[$k] );
                }
            }
        }
        if( !$config )
        {
            $config = $default;
        }
        Config::$config['links'] = $config;
    }

}
