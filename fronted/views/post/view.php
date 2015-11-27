<?php

use app\common\widgets\CommentWidget;

/* @var $this yii\web\View */
/* @var $model app\models\action\Post */

$this->title = $post->post_title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'post list'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
if ($post->post_excerpt) {
    $this->registerMetaTag(['name' => 'description', 'content' => $post->post_excerpt]);
} else {
    $this->registerMetaTag([
        'name' => 'description',
        'content' => ViewHelper::getSiteOption('site_seo_description') . ',' . $post->post_title]);
}

$this->registerMetaTag(['name' => 'keywords', 'content' => implode(',', explode(' ', $post->post_title))]);
?>
<div class="post-page-view">
    <?php if ($post->post_type == 'post'): ?>
        <p style="TEXT-ALIGN: center" align="center"><font size="3"><b><?=$post->post_title;?></b><span lang="EN-US" xml:lang="EN-US">&nbsp;<wbr></span></font></p>

        <p style="TEXT-ALIGN: center" align="center"><font size="3"><?=$post->author->user_login;?>
            <span lang="EN-US" xml:lang="EN-US">&nbsp;<wbr></span></font></p>
    <?php endif;?>
    <?=$post->post_content;?>
</div>
<?php

echo CommentWidget::widget([
    'postId' => $post->id,
    'postTable' => 'posts',
]);
?>
