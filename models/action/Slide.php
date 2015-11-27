<?php
namespace app\models\action;

use app\models\db\Slide as SlideDb;
use Yii;
use yii\helpers\ArrayHelper;
use yii\web\UploadedFile;

class Slide extends SlideDb {
    /**
     * 添加文件验证
     * @return [type] [description]
     */
    public function rules() {
        return ArrayHelper::merge(parent::rules(), [
            ['slide_pic', 'file'],
        ]);
    }

    /**
     * 绑定数据变更事件
     * @return [type] [description]
     */
    public function init() {
        parent::init();
        $this->on(self::EVENT_AFTER_INSERT, [$this, 'afterDataChange']);
        $this->on(self::EVENT_AFTER_UPDATE, [$this, 'afterDataChange']);
        $this->on(self::EVENT_AFTER_DELETE, [$this, 'afterDataChange']);
    }

    /**
     * 数据变更操作
     * @param  [type] $event [description]
     * @return [type]        [description]
     */
    public function afterDataChange($event) {
        Yii::$app->cacheManage->index_slide = null;
    }

    /**
     * label语言使用语言包
     * @return [type] [description]
     */
    public function attributeLabels() {
        $label = parent::attributeLabels();
        foreach ($label as $key => $item) {
            $label[$key] = Yii::t('app', $key);
        }
        return $label;
    }

    /**
     * 保存前数据处理
     * @param  [type] $insert [description]
     * @return [type]         [description]
     */
    public function beforeSave($insert) {
        if (parent::beforeSave($insert)) {

            $image = UploadedFile::getInstance($this, 'slide_pic');
            if ($image) {
                $ext = $image->getExtension();
                $randName = time() . rand(1000, 9999) . "." . $ext;
                $path = abs(crc32($randName) % 500);
                $rootPath = Yii::$app->params['uploadPath'] . $path . "/";
                if (!is_dir($rootPath)) {
                    mkdir($rootPath, true);
                }
                if ($image->saveAs($rootPath . $randName)) {
                    $this->slide_pic = ltrim($rootPath . $randName, '.');
                    return true;
                } else {
                    if ($insert) {

                        $this->addError('slide_pic', 'upload file error');
                        return false;
                    }
                    return true;
                }
            } else {
                if ($insert) {

                    $this->addError('slide_pic', 'upload file error');
                    return false;
                }
                return true;
            }
        }
    }
}
