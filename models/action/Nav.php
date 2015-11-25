<?php
/**
 * front menu manage model
 */
namespace app\models\action;

use app\models\db\Nav as NavDb;
use Yii;
use yii\helpers\ArrayHelper;

class Nav extends NavDb {
    /**
     * $href_txt direct link or other
     * @var [type]
     */
    public $href_txt;

    /**
     * $href_cat category id
     * @var int
     */
    public $href_cat;

    /**
     * $href_page page id
     * @var int
     */
    public $href_page;

    /**
     * $href_type href type
     * 0 direct link
     * 1 category
     * 2 page
     * @var int
     */
    public $href_type;

    const CAT_NAV = 1;
    const PAGE_NAV = 2;
    const DEFAULT_NAV = 0;

    public function rules() {
        return ArrayHelper::merge(parent::rules(), [
            ['href_txt', 'string'],
            [['href_cat', 'href_page'], 'integer'],
            ['href_type', 'in', 'range' => [0, 1, 2]],

        ]);
    }

    public function attributeLabels() {
        $label = parent::attributeLabels();
        foreach ($label as $key => $item) {
            $label[$key] = Yii::t('app', $key);
        }
        return $label;
    }

    //band event in init
    public function init() {
        parent::init();
        $this->on(self::EVENT_AFTER_FIND, [$this, 'afterDataFind']);
        $this->on(self::EVENT_BEFORE_VALIDATE, 'beforeValidate');
        $this->on(self::EVENT_AFTER_INSERT, [$this, 'afterDataSave']);
        $this->on(self::EVENT_AFTER_UPDATE, [$this, 'afterDataSave']);
        $this->on(self::EVENT_AFTER_DELETE, [$this, 'afterDataDelete']);
    }
    //handle data before validate
    public function beforeValidate() {
        if (!$this->hasErrors()) {
            if ($this->href_type !== null && $this->href_type == self::DEFAULT_NAV) {
                if ($this->href_txt == '') {
                    $this->addError('href_txt', Yii::t('app', 'not allow empty'));
                }
                $this->href = $this->href_txt;

            } elseif ($this->href_type == self::CAT_NAV) {
                $this->href_cat = intval($this->href_cat);
                if (!$this->href_cat) {
                    $this->addError('href_cat', Yii::t('app', 'not allow empty'));
                }

                $this->href = json_encode([
                    'c' => 'post',
                    'a' => 'cat',
                    'p' => ['id' => $this->href_cat],
                    't' => self::CAT_NAV,
                ]);
            } elseif ($this->href_type == self::PAGE_NAV) {

                $this->href_page = intval($this->href_page);

                if (!$this->href_page) {
                    $this->addError('href_page', Yii::t('app', 'not allow empty'));
                }

                $this->href = json_encode([
                    'c' => 'post',
                    'a' => 'view',
                    'p' => ['id' => $this->href_page],
                    't' => self::PAGE_NAV,
                ]);
            }
        }

        return true;
    }

    /**
     * event handler after data find
     * to filter data before show to user
     * @author Allon<xianlong300@sina.com>
     * @dateTime 2015-11-24T15:14:37+0800
     * @param    EventModel                  $event event model
     */
    public function afterDataFind($event) {
        $href = json_decode($event->sender->href, true);
        if ($href && is_array($href) && isset($href['t'])) {
            if ($href['t'] == self::PAGE_NAV) {
                $this->href_type = self::PAGE_NAV;
                $this->href_page = $href['p']['id'];
            } elseif ($href['t'] == self::CAT_NAV) {
                $this->href_type = self::CAT_NAV;
                $this->href_cat = $href['p']['id'];
            }
        } else {
            $this->href_type = self::DEFAULT_NAV;
            $this->href_txt = $event->sender->href;
        }
    }

    /**
     * afterDataSave  event handler after data changed
     * @author Allon<xianlong300@sina.com>
     * @dateTime 2015-11-24T15:15:35+0800
     * @param    [type]                   $event [description]
     */
    public function afterDataSave($event) {
        //删除菜单缓存
        Yii::$app->cacheManage->site_menu = null;
    }

    /**
     * afterDataDelete event handler after data delete
     * to clear data cache
     * @author Allon<xianlong300@sina.com>
     * @dateTime 2015-11-24T15:16:42+0800
     */
    public function afterDataDelete() {
        //删除菜单缓存
        Yii::$app->cacheManage->site_menu = null;
    }

}
