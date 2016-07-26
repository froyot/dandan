<?php
namespace admin\models\helpers;
use Yii;
class ArrayFileHelper
{
    public static function flushToFile($datas,$file='')
    {
        $content ="<?php\r\nreturn [\r\n";
        foreach($datas as $k=>$data)
        {
            $content .="'".$k."'=>[\r\n";
            if(is_array($data))
            {
                foreach($data as $key=>$value){
                    $content .= "'".$key."'=>'".$value."',\r\n";
                }
            }
            else
            {
                $content .= "'".$k."'=>'".$data."',\r\n";
            }
            $content .= "],\r\n";

        }
        $content .= "];\r\n";

        $path = Yii::getAlias('@admin/runtime/'.$file);
        file_put_contents($path, $content);
    }
}
