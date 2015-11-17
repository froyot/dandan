<?php

namespace app\models\action;

use Yii;
use app\models\db\Nav as NavDb;
use yii\helpers\ArrayHelper;

class Nav extends NavDb
{
    public $href_txt;
    public $href_cat;
    public $href_page;
    public $href_type;


    public function rules()
    {
        return ArrayHelper::merge(parent::rules(),[
                ['href_txt','string'],
                [['href_cat','href_page'],'integer'],
                ['href_type','in','range'=>[0,1,2]],
                ['href_type','default','value'=>0],
            ]);
    }


    public function beforeValidate()
    {
        if(!$this->hasErrors())
        {
            if( $this->href_type == 0 )
            {
                if( $this->href_txt == '' )
                {
                    $this->addError('href_txt',Yii::t('app','not allow empty'));
                }
                $this->href= $this->href_txt;
            }
            elseif( $this->href_type == 1 )
            {
                $this->href_cat = intval( $this->href_cat );
                if( !$this->href_cat )
                {
                    $this->addError('href_cat',Yii::t('app','not allow empty'));
                }
                $this->href= json_encode(['c'=>'post','a'=>'cat','p'=>['id'=>$this->href_cat]]);
            }
            elseif( $this->href_type == 2 )
            {
                $this->href_page = intval( $this->href_page );
                if( !$this->href_page )
                {
                    $this->addError('href_page',Yii::t('app','not allow empty'));
                }
                $this->href= json_encode(['c'=>'page','a'=>'view','p'=>['id'=>$this->href_page]]);
            }
        }

        return true;
    }
    public function init()
    {
        parent::init();
        $this->on(self::EVENT_BEFORE_VALIDATE, 'beforeValidate');
        $this->on(self::EVENT_AFTER_INSERT,[$this,'afterDataSave']);
        $this->on(self::EVENT_AFTER_UPDATE,[$this,'afterDataSave']);
        $this->on(self::EVENT_AFTER_DELETE,[$this,'afterDataDelete']);
    }
    public function attributeLabels()
    {
        $label = parent::attributeLabels();
        foreach( $label as $key => $item )
        {
            $label[$key] = Yii::t('app',$key);
        }
        return $label;
    }


    public function afterDataSave( $event )
    {
        //update path
        if( !$event->sender->parentid )
        {
            $this->parentid = 0;
        }
        $parent = Nav::find()
                    ->where(['id'=>$event->sender->parentid])
                    ->select(['path'])
                    ->one();
        if($parent)
        {
            $event->sender->path = $parent->path.'-'.$event->sender->getPrimaryKey();
        }
        else
        {
            $event->sender->path = '0-'.$event->sender->getPrimaryKey();
        }

        $event->sender->off(self::EVENT_AFTER_INSERT);
        $event->sender->off(self::EVENT_AFTER_UPDATE);
        $event->sender->save();

        //删除菜单缓存
        Yii::$app->cacheManage->site_menu = null;
    }

    public function afterDataDelete()
    {
        //删除菜单缓存
        Yii::$app->cacheManage->site_menu = null;
    }


}
