<?php

namespace app\controllers;

use Yii;


interface BaseControllerInterface
{

     function afterCreate( $model );

     function afterUpdate( $model );

     function afterDelete( $model );

     function beforeRenderEdit( &$model );
}
