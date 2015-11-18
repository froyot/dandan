<?php
namespace app\common\widgets;
use app\models\action\Post;
use yii\base\Widget;
use yii\helpers\Html;

class PostWidget extends Widget
{

    public  $condition;
    public  $count = 5;
    public  $order;
    public $options = [];

    public function init()
    {
        parent::init();

        $postTableName = Post::tableName();
        $condition = [$postTableName.'.post_type'=>'post'];

        foreach ($this->condition as $key => $value)
        {
            $condition[$postTableName.'.'.$key] = $value;
        }

        $this->condition = $condition;

        if (!isset($this->options['class'])) {
            Html::addCssClass($this->options, 'list-group');
        }
    }

    /**
     * Renders the widget.
     */
    public function run()
    {
        echo $this->renderItems();
    }

    public function renderItems()
    {
        $this->order[] = 'post_date desc';
        $order = array_unique($this->order);
        $order = implode($order, ',');
        $posts = Post::find()
                ->where($this->condition)
                ->orderBy($order)
                ->limit($this->count)
                ->all();
        $str = '';
        foreach($posts as $post)
        {
            $str .= $this->render('/content/listitem',['model'=>$post]);
        }
        return $str;
    }
}
