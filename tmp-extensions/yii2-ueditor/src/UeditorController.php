<?php
namespace allon\yii2\ueditor;
use Yii;
use yii\web\Controller;
class UeditorController extends Controller{

    public $enableCsrfValidation = false;
    public function actionIndex()
    {
        $basePath = __DIR__."/ueditor/php/";
        $action = Yii::$app->request->get('action');
        $CONFIG = json_decode(preg_replace("/\/\*[\s\S]+?\*\//", "", file_get_contents($basePath."config.json")), true);
        $CONFIG['imageUrlPrefix'] = Yii::getAlias('@web');
        $CONFIG['scrawlUrlPrefix'] = Yii::getAlias('@web');
        $CONFIG['fileUrlPrefix'] = Yii::getAlias('@web');
        switch($action)
        {
            case 'config':

                $result =  json_encode($CONFIG);
                break;
            /* 上传图片 */
            case 'uploadimage':
            /* 上传涂鸦 */
            case 'uploadscrawl':
            /* 上传视频 */
            case 'uploadvideo':
                $result = include($basePath."action_upload.php");
                break;
            case 'uploadfile':
                $result = include($basePath."action_upload.php");
                break;

            /* 列出图片 */
            case 'listimage':
                $result = include($basePath."action_list.php");
                break;
            /* 列出文件 */
            case 'listfile':
                $result = include($basePath."action_list.php");
                break;

            /* 抓取远程文件 */
            case 'catchimage':
                $result = include($basePath."action_crawler.php");
                break;

            default:
                $result = json_encode(array(
                    'state'=> '请求地址出错'
                ));
                break;
        }
        /* 输出结果 */
        if (Yii::$app->request->get("callback")) {
            if (preg_match("/^[\w_]+$/", Yii::$app->request->get("callback")))
            {
                echo htmlspecialchars(Yii::$app->request->get("callback")) . '(' . $result . ')';
            } else {
                echo json_encode(array(
                    'state'=> 'callback参数不合法'
                ));
            }
        } else {
            echo $result;
        }
    }
}
