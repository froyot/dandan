<?php
namespace app\common\widgets;
use app\models\action\Post;
use yii\base\Widget;
use yii\helpers\Html;
use app\models\action\Comment;
use app\models\action\User;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use app\models\form\CommentForm;
use yii\helpers\ArrayHelper;
use app\models\util\ViewHelper;
use Yii;
class CommentWidget extends Widget
{

    public $postId;//文章id
    public $postTable;
    public $options = [];

    public function init()
    {
        parent::init();
        if (!isset($this->options['class'])) {
            Html::addCssClass($this->options, 'list-group');
        }
    }

    /**
     * Renders the widget.
     */
    public function run()
    {
        //判断评论是否采用本站评论
        if( ViewHelper::getSiteOption('comment_type') == 0)
        {
            $comments = $this->renderItems();
            \yii\widgets\Pjax::begin();
            echo $comments;
            \yii\widgets\Pjax::end();
            echo $this->renderCommentInputer();
        }
        elseif(ViewHelper::getSiteOption('comment_type') == 1)
        {
            echo '<div id="SOHUCS" sid="'.$this->postId.'" ></div>';
            $this->getView()->registerJsFile('http://changyan.sohu.com/upload/changyan.js');
            $this->getView()->registerJs('
                    window._config = { showScore: true };
                    window.changyan.api.config({
                        appid: "'.ViewHelper::getSiteOption('comment_appid').'",
                        conf: "'.ViewHelper::getSiteOption('commet_key').'"
                    });
            ');
        }

    }

    public function renderItems()
    {
        $commentForm = new CommentForm();
        $data['post_id'] = $this->postId;
        $listDataProvider = $commentForm->search($data);
        $listDataProvider->pagination->setPageSize(5);
        return '<div class="comment"><div>'.Yii::t('app','comment list').'</div>'.$this->render('/content/commentList',['dataProvider'=>$listDataProvider]).'</div>';
    }

    public function renderCommentInputer()
    {
        $model = new Comment();
        $model->post_id = $this->postId;
        return $this->render('/content/commentForm',['model'=>$model]);
    }
}
