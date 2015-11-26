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

        'defaultPermision' => [
            'index post' => 'Index Post',
            'create post' => 'Create Post',
            'update post' => 'Update Post',
            'delete post' => 'Delete Post',

            'index nav' => 'Index Nav',
            'create nav' => 'Create Nav',
            'update nav' => 'Update Nav',
            'delete nav' => 'Delete Nav',

            'index page' => 'Index Page',
            'create page' => 'Create Page',
            'update page' => 'Update Page',
            'delete page' => 'Delete Page',

            'index term' => 'Index Term',
            'create term' => 'Create Term',
            'update term' => 'Update Term',
            'delete term' => 'Delete Term',

            'index slide' => 'Index Slide',
            'create slide' => 'Create Slide',
            'update slide' => 'Update Slide',
            'delete slide' => 'Delete Slide',

            'index slide-cat' => 'Index Slide',
            'create slide-cat' => 'Create Slide',
            'update slide-cat' => 'Update Slide',
            'delete slide-cat' => 'Delete Slide',

            'site setting' => 'Setting Site',
            'links setting' => 'links Setting',
        ],

    ],
    require (__DIR__ . '/view.php')
);
