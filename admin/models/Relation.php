<?php

namespace app\admin\models;
use Yii;
use app\models\db\Relation as RelationModel;
use yii\helpers\ArrayHelper;


class Relation extends RelationModel
{

    public function updateContentCategory($contentId, $catId, $oldCatId = 0)
    {
        if( $catId == 0 )
            return;
        $relation = null;
        if( $oldCatId != 0 )
        {
            $relation = Relation::findOne([
                'content_id'=>$contentId,
                'params_id'=>$oldCatId
                ]);
        }
        if( !$relation )
        {
            $relation = new Relation();
            $relation->attributes = [
                'content_id'=>$contentId
            ];
        }
        $relation->params_id = $catId;
        return $relation->save();
    }

    public function updateContentSlide( $contentId, $isSlide )
    {
        $slide = Params::findOne(['type'=>'slide']);

        if( !$slide )
        {
            $slide = new Params();
            $slide->attributes = [
                'type'=>'slide',
                'created_by'=>Yii::$app->user->id,
                'name'=>'slide'
            ];
            if( !$slide->save() )
            {
                Yii::error($slide->errors);
                return;
            }
        }

        $relation = Relation::findOne([
                    'content_id'=>$contentId,
                    'params_id'=>$slide->id
                    ]);
        if( $isSlide == 0 && $relation )
        {
            //删除原来的
            return $relation->delete();
        }
        else
        {
            if( !$relation )
            {
                $relation = new Relation();
            }
            $relation->attributes = [
                'content_id'=>$contentId,
                'params_id'=>$slide->id
            ];
            return $relation->save();
        }
    }
}
