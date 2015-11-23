<?php
namespace app\models\util;
use yii\base\Model;
use app\models\action\Option;
use Yii;

class LinkOption extends Model{
    public $site_name;
    public $site_url;
    public $open_type;

    public function rules()
    {
        return[
            [['site_name','site_url','open_type'],'string'],
            ['open_type','in','range'=>['default','_blank']]
        ];
    }

    public static function getAllLinks()
    {
        $option = Option::findOne(['option_name'=>'friend_link']);
        if( !$option )
        {
            return [];
        }
        else
        {
            $links = [];
            $option = json_decode($option->option_value,true);
            foreach ($option as $key => $item)
            {
                $item['id'] = md5($item['site_url'].$item['site_name']);
                $link = new LinkOption();
                $link->load($item,'');
                $links[$key] = $link;
            }
            return $links;
        }
    }

    public function save()
    {
        $isUpdate = false;
        $option = Option::findOne(['option_name'=>'friend_link']);
        $optionValue = [];
        if( !$option )
        {
            $option = new Option();
            $option->option_name = 'friend_link';
            $optionValue = [];
        }
        else
        {
            $optionValue = json_decode($option->option_value, true);
        }

        $value = $this->toArray();
        $optionValue[] = $value;
        $option->option_value = json_encode($optionValue);
        return $option->save();
    }

    public function delete($key)
    {
        $option = Option::findOne(['option_name'=>'friend_link']);
        if( !$option )
        {
            return false;
        }
        else
        {
            $optionValue = json_decode($option->option_value, true);

            if( isset($optionValue[$key]) )
            {
                unset($optionValue[$key]);

                $option->option_value = json_encode($optionValue);
                return $option->save();
            }
        }
    }
}
