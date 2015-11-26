<?php

return
array_merge(
    [
        'adminEmail' => 'admin@example.com',
        'uploadPath' => './upload/',
        'siteConf' => [
            'site_admin_email' => '1035308417@qq.com',
            'site_name' => 'DanDan CMS',
            'site_icp' => '',
            'site_seo_title' => 'DanDan CMS, Yii2 CMS',
            'site_seo_keywords' => 'DanDan,CMS,Yii2,PHP',
            'site_seo_description' => 'DanDan CMS, Powerful Yii Framework CMS',
            'comment_need_check' => 0,
            'comment_time_interval' => 100,
            'copyright' => '<a href="http://froyot.github.io" target="_blank">Allon</a>2014-',
            'powerBy' => ' Power By Allon with YiiFramwork ',
            'comment_type' => 1, //0本站，1畅言，2

            'stmp_host' => 'test@qq.com',
            'stmp_username' => 'test',
            'stmp_password' => 'xxxxxxx',
            'stmp_port' => '21',
            'stmp_label' => 'admin',

            'indexSlide' => [
                ['img' => 'http://bpic.588ku.com/back_pic/00/01/77/51/6adf978d27fc92e165a5be81395d366f.jpg',
                    'des' => '测试slide1',
                    'url' => '#'],
                ['img' => 'http://bpic.588ku.com/back_pic/00/02/66/92561a01eff094e.jpg',
                    'des' => '测试slide2',
                    'url' => '#'],
                ['img' => 'http://bpic.588ku.com/back_pic/00/00/69/40/a17c0b224a1ed6a21597aa892f553c06.jpg!qianku1198',
                    'des' => '测试slide3',
                    'url' => '#'],
            ],
        ],
    ],
    require (__DIR__ . '/view.php')
);
