<?php

namespace app\models\db;

use Yii;

/**
 * This is the model class for table "{{%posts}}".
 *
 * @property string $id
 * @property string $post_author
 * @property string $post_keywords
 * @property string $post_date
 * @property string $post_content
 * @property string $post_title
 * @property string $post_excerpt
 * @property integer $comment_status
 * @property string $post_modified
 * @property string $post_content_filtered
 * @property string $post_parent
 * @property integer $post_type
 * @property string $post_mime_type
 * @property string $comment_count
 * @property integer $istop
 * @property integer $recommended
 */
class Posts extends \yii\db\ActiveRecord {
    /**
     * @inheritdoc
     */
    public static function tableName() {
        return '{{%posts}}';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['post_author', 'post_status', 'comment_status', 'post_parent', 'comment_count', 'istop', 'recommended'], 'integer'],
            [['post_date', 'post_modified'], 'default', 'value' => date('Y-m-d H:i:s')],
            [['post_content', 'post_title', 'post_excerpt', 'post_content_filtered', 'post_type'], 'string'],

        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'post_author' => 'Post Author',
            'post_date' => 'Post Date',
            'post_content' => 'Post Content',
            'post_title' => 'Post Title',
            'post_excerpt' => 'Post Excerpt',
            'post_status' => 'Post Status',
            'comment_status' => 'Comment Status',
            'post_modified' => 'Post Modified',
            'post_content_filtered' => 'Post Content Filtered',
            'post_parent' => 'Post Parent',
            'post_type' => 'Post Type',
            'post_mime_type' => 'Post Mime Type',
            'comment_count' => 'Comment Count',
            'istop' => 'Istop',
            'recommended' => 'Recommended',
        ];
    }
}
