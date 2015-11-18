<?php
namespace app\models\action;

use Yii;
use app\models\db\Slide as SlideDb;
use yii\helpers\ArrayHelper;
use yii\web\UploadedFile;

class Slide extends SlideDb
{
    public function rules()
    {
        return ArrayHelper::merge(parent::rules(),[
                ['slide_pic','file']
            ]);
    }

    public function beforeSave( $insert )
    {
        if (parent::beforeSave($insert)) {

            $image = UploadedFile::getInstance($this,'slide_pic');
            if( $image )
            {
                $ext = $image->getExtension();
                $randName = time() . rand(1000, 9999) . "." . $ext;
                $path = abs(crc32($randName) % 500);
                $rootPath = Yii::$app->params['uploadPath'] . $path . "/";
                if (!is_dir($rootPath)) {
                    mkdir($rootPath,true);
                }
                if( $image->saveAs($rootPath . $randName) )
                {
                    $this->slide_pic = ltrim($rootPath.$randName,'.');
                    return true;
                }
                else
                {
                    if( $insert )
                    {

                        $this->addError('slide_pic','upload file error');
                        return false;
                    }
                    return true;
                }
            }
            else
            {
                if( $insert )
                {

                    $this->addError('slide_pic','upload file error');
                    return false;
                }
                return true;
            }
        }
    }
}
