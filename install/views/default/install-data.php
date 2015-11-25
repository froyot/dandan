<?php
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

?>

<div class="install-default-index">
<div class="header">
    <h1 class="logo">DanDan Cms</h1>
    <div class="icon_install">安装向导</div>
    <div class="version"></div>
</div>
<section class="section">
    <div class="step">
      <ul>
        <li><em>1</em>检测环境</li>
        <li><em>2</em>创建数据</li>
        <li  class="current"><em>3</em>完成安装</li>
      </ul>
    </div>
    <div class="main cc">
      <pre class="pact" readonly="readonly"></pre>
      <div id="tips"></div>
    </div>
    <div class="bottom tac"> <a href="<?=Url::to(['/fronted/site/index']);?>" class="btn">前台</a> <a href="<?=Url::to(['/admin/site/login']);?>" class="btn">后台</a>
    </div>

</section>
</div>
<?php
$this->registerJs('
var url = "' . Url::to(['install-data']) . '";
var configUrl = "' . Url::to(['install-config']) . '";
installData(0);
function installConfig()
{

  $.ajax({
    "url":configUrl,
    "type":"post",
    "dataType":"json",
    "success":function(data){
      if(data.status == true)
      {
        $("#tips").append("配置完成");

      }
    }

  });

}
function installData(id)
{
  $.ajax({
    "url":url,
    "type":"post",
    "dataType":"json",
    "data":{"id":id},
    "success":function(data){
      if(data.status == true)
      {
        if( data.next > id )
        {
          $("pre").append(data.msg);
          installData( data.next );
        }
        else
        {
          installConfig();
          $("#tips").append("数据库安装完成<br/>");
        }
      }
    }

  });
}

');?>
