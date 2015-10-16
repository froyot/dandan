<?php

namespace app\models\front;

use Yii;
use app\models\db\Content as ContentModel;
use app\models\form\Content as ContentForm;

/**
 * This is the model class for table "{{%content}}".
 *
 * @property integer $id
 * @property string $created_at
 * @property string $update_at
 * @property string $title
 * @property string $content
 * @property integer $create_by
 * @property string $others
 */
class Content extends ContentModel
{
    public function getIndexContent()
    {
        $contentForm = new ContentForm();
        //获取slide文章
        $params['Content'] = [
            'isSlide'=>true
        ];
        $data = $contentForm->search($params);
        $data->pagination->setPageSize(5, true);
        $slide = $data->getModels();

        //获取前几篇文章
        $params['Content'] = [
            'isSlide'=>false
        ];
        $data = $contentForm->search($params);
        $data->pagination->setPageSize(3, true);
        $indexData = $data->getModels();

        return [$slide, $indexData];
    }





    private function getPost()
    {

    }
}
