<?php
namsespace allon\yii2\ueditor;

class UeditorController extends Controller{

    public function actionIndex()
    {
        $action = Yii::$app->request->get('action');
        switch($action)
        {
            case 'config':
                $CONFIG = json_decode(preg_replace("/\/\*[\s\S]+?\*\//", "", file_get_contents("config.json")), true);
                $result =  json_encode($CONFIG);
                break;
            /* 上传图片 */
            case 'uploadimage':
            /* 上传涂鸦 */
            case 'uploadscrawl':
            /* 上传视频 */
            case 'uploadvideo':
                $result = include("action_upload.php");
                break;
            case 'uploadfile':
                $result = include("action_upload.php");
                break;

            /* 列出图片 */
            case 'listimage':
                $result = include("action_list.php");
                break;
            /* 列出文件 */
            case 'listfile':
                $result = include("action_list.php");
                break;

            /* 抓取远程文件 */
            case 'catchimage':
                $result = include("action_crawler.php");
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
