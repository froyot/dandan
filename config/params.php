<?php

return
array_merge(
[
    'adminEmail' => 'admin@example.com',
    'siteConf' =>[
        'site_name'=>'DanDan CMS',
        'site_icp'=>'',
        'site_seo_title'=>'DanDan CMS, Yii2 CMS',
        'site_seo_keywords'=>'DanDan,CMS,Yii2,PHP',
        'site_seo_description'=>'DanDan CMS, Powerful Yii Framework CMS',
        'comment_need_check'=>0,
        'comment_need_interval'=>100,
        'copyright'=>'<a href="http://froyot.github.io" target="_blank">Allon</a>2014-',
        'powerBy'=>' Power By Allon with YiiFramwork ',
    ]

],
require(__DIR__.'/view.php')
);

