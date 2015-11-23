<?php
/**
 * 缓存管理类
 *
 */
namespace app\models\util;
use yii\base\Model;
use yii\helpers\Url;
use Yii;

class CacheManage extends Model{
    public static $cache_key = [
        'site_menu' => 'site_menu',
        'site_option'=>'site_option',
        'index_slide'=>'index_slide',
        'theme_list'=>'theme_list',
        'links'=>'links'
    ];
    public function __get( $name )
    {
        return self::unpackage(Yii::$app->cache->get(self::$cache_key[ $name ]));
    }

    public function __set( $name, $value )
    {
        $value = self::package($value);
         return Yii::$app->cache->set(self::$cache_key[ $name ], $value);
    }

    public static function package( $data )
    {
        return serialize($data);
    }

    public static function unpackage( $data )
    {
        return unserialize( $data );
    }
}
