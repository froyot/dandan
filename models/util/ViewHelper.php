<?php
/**
 * 视图文件辅助操作
 *
 */
namespace app\models\util;
use yii\base\Model;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use Yii;

class ViewHelper extends Model{
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
                $menu['url'] = '#';
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
                elseif(is_string($href))
                {
                    $url = $href;
                    $menu['linkOptions']['target'] = '_blank';
                }
                $menu['url'] = $url;
            }
            $menus[] = $menu;
        }
        return $menus;
    }
}
