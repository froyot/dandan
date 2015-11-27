<?php
/**
 * friend link util model
 */
namespace app\models\util;
use app\models\action\Option;
use Yii;
use yii\base\Model;

class LinkOption extends Model {
    /**
     * link name
     * @var string
     */
    public $site_name;

    /**
     * link url
     * @var string
     */
    public $site_url;

    /**
     * link open method
     * @var string, value range is default or _blank
     */
    public $open_type;

    public function attributeLabels() {
        return [
            'site_name' => Yii::t('app', 'site_name'),
            'site_url' => Yii::t('app', 'site_url'),
            'open_type' => Yii::t('app', 'open_type'),
        ];
    }
    /**
     * link option rules
     * @author Allon<xianlong300@sina.com>
     * @dateTime 2015-11-24T10:19:03+0800
     * @return array rules
     */
    public function rules() {
        return [
            [['site_name', 'site_url', 'open_type'], 'string'],
            ['open_type', 'in', 'range' => ['default', '_blank']],
        ];
    }

    /**
     * [getAllLinks description]
     * @author Allon<xianlong300@sina.com>
     * @dateTime 2015-11-24T10:19:41+0800
     * @return   array LikeOption Model array
     */
    public static function getAllLinks() {
        $option = Option::findOne(['option_name' => 'friend_link']);
        if (!$option) {
            return [];
        } else {
            $links = [];
            $option = json_decode($option->option_value, true);
            foreach ($option as $key => $item) {
                $item['id'] = md5($item['site_url'] . $item['site_name']);
                $link = new LinkOption();
                $link->load($item, '');
                $links[$key] = $link;
            }
            return $links;
        }
    }

    /**
     * friend linkoption save
     * @author Allon<xianlong300@sina.com>
     * @dateTime 2015-11-24T12:01:59+0800
     * @return  boolean
     *
     */
    public function save() {
        $isUpdate = false;
        $option = Option::findOne(['option_name' => 'friend_link']);
        $optionValue = [];
        if (!$option) {
            $option = new Option();
            $option->option_name = 'friend_link';
            $optionValue = [];
        } else {
            $optionValue = json_decode($option->option_value, true);
        }

        $value = $this->toArray();
        $optionValue[] = $value;
        $option->option_value = json_encode($optionValue);
        $res = $option->save();
        if ($res) {
            Yii::$app->cacheManage->links = null;
        }
        return $res;
    }

    /**
     * delete friend link option
     * @author Allon<xianlong300@sina.com>
     * @dateTime 2015-11-24T14:01:00+0800
     * @param  int $key index of friend link
     * @return  boolean
     */
    public function delete($key) {
        $option = Option::findOne(['option_name' => 'friend_link']);
        if (!$option) {
            return false;
        } else {
            $optionValue = json_decode($option->option_value, true);

            if (isset($optionValue[$key])) {
                unset($optionValue[$key]);

                $option->option_value = json_encode($optionValue);
                $res = $option->save();
                if ($res) {
                    Yii::$app->cacheManage->links = null;
                }
                return $res;
            }
        }
    }
}
