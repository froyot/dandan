<?php
namespace admin\behaviors;

use Yii;
use yii\db\ActiveRecord;

/**
 * key value make php array file
 * @inheritdoc
 */
class FileConfig extends \yii\base\Behavior
{
    /** @var  string */
    public $dataKey;
    public $createdAtAttribute = 'created_at';


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
        $path = Yii::getAlias('@admin/runtime/params.php');
        $data =  require($path);
        $data[$this->dataKey][$key] = $value;
        $this->flushToFile($data);
    }

    private function flushToFile($datas)
    {
        $content ="<?php\r\nreturn [\r\n";
        foreach($datas as $k=>$data)
        {
            $content .="'".$k."'=>[\r\n";
            foreach($data as $key=>$value){
                $content .= "'".$key."'=>'".$value."',\r\n";
            }
            $content .= "],\r\n";

        }
        $content .= "];\r\n";
        $path = Yii::getAlias('@admin/runtime/params.php');
        file_put_contents($path, $content);
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
        $path = Yii::getAlias('@admin/runtime/params.php');
        $data =  require($path);
        if(isset($data[$this->dataKey]) && isset($data[$this->dataKey][$model->key]))
        {
            unset($data[$this->dataKey][$model->key]);
            $this->flushToFile($data);
        }

    }
}
