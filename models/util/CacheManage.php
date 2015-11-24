<?php
/**
 * @author Allong <xianlong300@sina.com>
 *
 * site data cache manage class
 *
 */
namespace app\models\util;
use Yii;
use yii\base\Model;

class CacheManage extends Model {

    /**
     * allow to set cache key
     * @var array
     */
    public static $cache_key = [
        'site_menu' => 'site_menu',
        'site_option' => 'site_option',
        'index_slide' => 'index_slide',
        'theme_list' => 'theme_list',
        'links' => 'links',
    ];

    public function __get($name) {
        return self::unpackage(Yii::$app->cache->get(self::$cache_key[$name]));
    }

    public function __set($name, $value) {
        $value = self::package($value);
        return Yii::$app->cache->set(self::$cache_key[$name], $value);
    }

    /**
     * data serialize before save to cache
     * @author Allon<xianlong300@sina.com>
     * @dateTime 2015-11-24T10:12:29+0800
     * @param    maxid   $data data want to save
     * @return   string  serialize data
     */
    public static function package($data) {
        return serialize($data);
    }

    /**
     * unserialize data
     * @author Allon<xianlong300@sina.com>
     * @dateTime 2015-11-24T10:13:51+0800
     * @param    string $data   serialize data get from cache
     * @return   maxid data
     */
    public static function unpackage($data) {
        return unserialize($data);
    }

    public static function deleteAll() {
        Yii::$app->cache->gc(true, false);
    }
}
