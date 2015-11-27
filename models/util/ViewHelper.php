<?php
/**
 * display helper model,
 * all method called by static method
 *
 */
namespace app\models\util;
use app\models\action\Option;
use app\models\action\Slide;
use Yii;
use yii\base\Model;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

class ViewHelper extends Model {
    private static $SITEOPTION;
    /**
     * create front menu array data
     * @return array can used in yii2 nav
     */
    public static function getSiteMenu() {
        $menu = Yii::$app->cacheManage->site_menu;
        if (!$menu) {
            $context = new ViewHelper();
            $config = [
                'model' => 'app\models\action\Nav',
                'parentKey' => 'parentid',
                'primaryKey' => 'id',
                'rootParent' => 0,
                'orderBy' => 'listorder desc',
            ];
            $obj = new Tree($config);
            $tree = $obj->getTree(true);
            $menu = $context->getMenuChild($tree);
            Yii::$app->cacheManage->site_menu = $menu;
        }
        return $menu;
    }

    /**
     * make menu item in tree
     * @param  Model $tree tree mode
     * @return array       menu item array
     */
    private function getMenuChild($tree) {
        $menus = [];
        foreach ($tree as $key => $item) {
            $menu = [];
            $menu['label'] = $item->model->label;
            $menu['linkOptions'] = ['target' => $item->model->target];
            $childs = $this->getMenuChild($item->childs);
            if ($childs) {
                $menu['items'] = $childs;
            } elseif (!$item->model->href) {
                $menu['url'] = '#';
            } else {

                $href = json_decode($item->model->href, true);
                $url = '#';
                if (is_array($href)) {

                    if (isset($href['a']) && isset($href['c'])) {
                        if (!isset($href['p'])) {
                            $href['p'] = [];
                        }

                        $url = ArrayHelper::merge(
                            [$href['c'] . '/' . $href['a']],
                            $href['p']
                        );
                    }
                } elseif (!$href && is_string($item->model->href)) {
                    $url = $item->model->href;
                    if (strpos("http", $item->model->href) === 0) {
                        $menu['linkOptions']['target'] = '_blank';
                    }

                }

                $menu['url'] = $url;
            }
            $menus[] = $menu;
        }
        return $menus;
    }

    /**
     * get site option,
     * if key is empty,will return all options array
     * @param  string $key the key want to get
     * @return maxid    site option
     */
    public static function getSiteOption($key = '') {
        if (self::$SITEOPTION) {
            $site_option = self::$SITEOPTION;
        } else {
            $site_option = Yii::$app->cacheManage->site_option;
            if (!$site_option) {
                $options = Option::getSiteOption();
                if (!$options) {
                    $site_option = Yii::$app->params['siteConf'];
                } else {
                    $site_option = ArrayHelper::merge(
                        Yii::$app->params['siteConf'],
                        $options
                    );
                }
                Yii::$app->cacheManage->site_option = $site_option;
            }
            self::$SITEOPTION = $site_option;
        }
        if ($key) {
            return isset($site_option[$key]) ? $site_option[$key] : null;
        }

        return $site_option;
    }

    /**
     * index slider info
     * @return array slide info
     */
    public static function getIndexSlide() {
        $index_slide = Yii::$app->cacheManage->index_slide;
        if (!$index_slide) {
            $slides = Slide::find()->where(['slide_cid' => 1])->orderBy('listorder desc')->all();
            if (!$slides) {
                $index_slide = Yii::$app->params['siteConf']['indexSlide'];
            } else {
                $index_slide = [];
                foreach ($slides as $item) {
                    $index_slide[] = [
                        'img' => $item->slide_pic,
                        'des' => $item->slide_des,
                        'url' => Url::to(
                            ['post/view', 'id' => $item->slide_value]
                        ),
                    ];
                }

            }
            Yii::$app->cacheManage->index_slide = $index_slide;
        }
        return $index_slide;
    }

    /**
     * get site theme
     * @return string theme floder
     */
    public static function getThemeList() {
        $themeList = Yii::$app->cacheManage->theme_list;
        if ($themeList) {
            return $themeList;
        }

        $themeList = ['' => 'default'];
        $themeDir = Yii::getAlias('@app') . '/themes';
        if ($handle = opendir($themeDir)) {
            while (($file = readdir($handle)) !== false) {
                if ($file != ".." && $file != ".") {
                    if (is_dir($themeDir . "/" . $file)) {
                        $themeList[$file] = $file;
                    }
                }
            }
            closedir($handle);
            Yii::$app->cacheManage->theme_list = $themeList;
        }
        return $themeList;

    }

    /**
     * get site friend links
     * @return array
     */
    public static function getLinks() {
        $links = Yii::$app->cacheManage->links;
        if ($links) {
            return $links;
        }

        $links = LinkOption::getAllLinks();
        if ($links) {
            Yii::$app->cacheManage->links = $links;
        }
        return $links;
    }

}
