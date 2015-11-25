<?php
use yii\helpers\Url;
?>

<div class="install-default-index">
<div class="header">
    <h1 class="logo">DanDan Cms</h1>
    <div class="icon_install">安装向导</div>
    <div class="version"></div>
  </div>
  <div class="section">
    <div class="main cc">
      <h2>您已成功安装，尽情享受吧</h2>

      <a href="<?=Url::to(['/fronted/site/index']);?>">前台</a>

      <a href="<?=Url::to(['/admin/site/login']);?>">后台</a>
    </div>
</div>
