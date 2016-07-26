<?php
namespace admin\behaviors;

use Yii;
use yii\db\ActiveRecord;
use admin\behaviors\ArrayFileHelper;
/**
 * key value make php array file
 * @inheritdoc
 */
class FileConfig extends \yii\base\Behavior
{
    /** @var  string */
    public $dataKey;
    public $fileName ='params.php';



    public function attach($owner)
    {
        parent::attach($owner);

        // if(!$this->dataKey) $this->dataKey = get_class($owner)."_CONFIG";
    }

    public function events()
    {
        return [
            ActiveRecord::EVENT_AFTER_INSERT => 'save',
            ActiveRecord::EVENT_AFTER_UPDATE => 'save',
            ActiveRecord::EVENT_AFTER_DELETE => 'remove',
        ];
    }

    private function saveData($key,$value)
    {
        $path = Yii::getAlias('@admin/runtime/'.$this->fileName);
        $data =  require($path);
        if($this->dataKey)
        {
            $data[$this->dataKey][$key] = $value;
        }
        else
        {
            $data[$key] = $value;
        }

        ArrayFileHelper::flushToFile($data,$this->fileName);
    }



    /**
     * Flush cache
     */
    public function save()
    {
        $model = $this->owner;
        $this->saveData($model->key,$model->value);
    }

    public function remove()
    {
        $model = $this->owner;
        $path = Yii::getAlias('@admin/runtime/'.$this->fileName);
        $data =  require($path);
        $tmpData = isset($this->dataKey)?$data[$this->dataKey]:$data;
        if(isset($tmpData[$model->key]))
        {
            if( isset($this->dataKey))
            {
               unset($data[$this->dataKey][$model->key]);
            }else
            {
              unset($data[$model->key]);
            }
            ArrayFileHelper::flushToFile($data,$this->fileName);
        }

    }
}
