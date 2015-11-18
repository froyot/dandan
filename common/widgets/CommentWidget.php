<?php
namespace app\common\widgets;
use app\models\action\Post;
use yii\base\Widget;
use yii\helpers\Html;
use app\models\action\Comment;
use app\models\action\User;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use Yii;
class CommentWidget extends Widget
{

    public $commentUrl;
    public $postId;
    public $postTable;
    private $renderContent;
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
        $comments = $this->renderItems();
        return $comments.$this->renderCommentContent();
    }

    public function renderItems( $parent = 0, $parentUser = null)
    {
        $cmTbl = Comment::tableName();
        $userTbl = User::tableName();
        $comments = Comment::find()->where([
            $cmTbl.'.post_table'=>$this->postTable,
            $cmTbl.'.post_id'=>$this->postId,
            $cmTbl.'.parentid'=>$parent
            ])
            ->joinWith(['user'])->orderBy($cmTbl.'.createTime desc')->all();
        $str =  '';
        foreach( $comments as $comment)
        {
            $str .= $this->render('/content/commentItem',[
                                'model'=>$comment,
                                'parentUser'=>$parentUser
                            ]);
            $str .= $this->renderItems( $comment->id, $comment->user );
        }
        return $str;
    }

    public function renderCommentContent()
    {
        $model = new Comment();
        $model->post_id = $this->postId;
        return $this->render('/content/commentForm',['model'=>$model,'commentUrl'=>$this->commentUrl]);
        // $str .= ActiveForm::end();
       // return $str;
    }
}
