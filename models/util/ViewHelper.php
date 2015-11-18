<?php
/**
 * 视图文件辅助操作
 *
 */
namespace app\models\util;
use yii\base\Model;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use app\models\action\Option;
use app\models\action\Slide;
use Yii;

class ViewHelper extends Model{
    private static $SITEOPTION;
    /**
     * 生成前台导航菜单
     * @return array 数据格式兼容bootstrap nav 扩展
     */
    public static function getSiteMenu()
    {
        $menu = Yii::$app->cacheManage->site_menu;
        if( !$menu )
        {
            $context = new ViewHelper();
            $config = [
                'model'=> 'app\models\action\Nav',
                'parentKey'=>'parentid',
                'primaryKey'=>'id',
                'rootParent'=>0
            ];
            $obj = new Tree( $config );
            $tree = $obj->getTree(true);
            $menu = $context->getMenuChild($tree);
            Yii::$app->cacheManage->site_menu = $menu;
        }
        return $menu;
    }

    /**
     * 递归生成菜单
     * @param  [type] $tree [description]
     * @return [type]       [description]
     */
    private function getMenuChild($tree)
    {
        $menus = [];
        foreach ($tree as $key => $item)
        {
            $menu = [];
            $menu['label'] = $item->model->label;
            $menu['linkOptions'] = ['target'=>$item->model->target];
            $childs = $this->getMenuChild( $item->childs );
            if( $childs )
            {
                $menu['items'] = $childs;
            }
            elseif( !$item->model->href )
            {
                $menu['url'] = '#';
            }
            else
            {

                $href = json_decode($item->model->href,true);
                $url = '#';
                if( is_array( $href ) )
                {
                    if(isset($href['a']) && isset($href['c']))
                    {
                        if(!isset($href['p']))
                        {
                            $href['p'] = [];
                        }

                        $url = Url::to(ArrayHelper::merge(
                            [$href['c'].'/'.$href['a']]
                            ,$href['p']
                            ));
                    }
                }
                elseif( !$href && is_string( $item->model->href ))
                {
                    $url = $item->model->href;
                    if( strpos("http", $item->model->href) === 0 )
                        $menu['linkOptions']['target'] = '_blank';
                }

                $menu['url'] = $url;
            }
            $menus[] = $menu;
        }
        return $menus;
    }

    /**
     * 获取网站配置
     * @param  string $key [description]
     * @return [type]      [description]
     */
    public static function getSiteOption($key = '')
    {
        if( self::$SITEOPTION )
        {
            $site_option = self::$SITEOPTION;
        }
        else
        {
            $site_option = Yii::$app->cacheManage->site_option;
            if( !$site_option )
            {
                $options = Option::getSiteOption();
                if( !$options )
                {
                    $site_option = Yii::$app->params['siteConf'];
                }
                else
                {
                    $site_option = ArrayHelper::merge(
                                                        Yii::$app->params['siteConf'],
                                                        $options
                                                    );
                }
                Yii::$app->cacheManage->site_option = $site_option;
            }
            self::$SITEOPTION = $site_option;
        }
        if( $key )
        {
            return isset($site_option[$key])?$site_option[$key]:null;
        }

        return $site_option;
    }

    public static function getIndexSlide()
    {
        $index_slide = Yii::$app->cacheManage->index_slide;
        if( !$index_slide )
        {
            $index_slide = Slide::find()->where(['slide_cid'=>1])->all();
            if( !$index_slide )
            {
                $index_slide = Yii::$app->params['siteConf']['indexSlide'];
            }
            else
            {
                $index_slide = [];
                foreach($slide as $item)
                {
                    $index_slide[] = [
                        'img'=>$item->slide_pic,
                        'des'=>$item->slide_des,
                        'url'=>Url::to(['post/view','id'=>$item->value])
                    ];
                }

            }
            Yii::$app->cacheManage->index_slide = $index_slide;
        }
        return $index_slide;
    }
}
