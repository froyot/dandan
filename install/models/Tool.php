<?php
namespace app\install\models;
use Yii;

class Tool {
    static function testwrite($d) {
        $tfile = "_test.txt";
        $fp = @fopen($d . "/" . $tfile, "w");
        if (!$fp) {
            return false;
        }
        fclose($fp);
        $rs = @unlink($d . "/" . $tfile);
        if ($rs) {
            return true;
        }
        return false;
    }

    static function _dir_path($path) {
        $path = str_replace('\\', '/', $path);
        if (substr($path, -1) != '/') {
            $path = $path . '/';
        }

        return $path;
    }

    static function dir_create($path, $mode = 0777) {
        if (is_dir($path)) {
            return TRUE;
        }

        $ftp_enable = 0;
        $path = self::dir_path($path);
        $temp = explode('/', $path);
        $cur_dir = '';
        $max = count($temp) - 1;
        for ($i = 0; $i < $max; $i++) {
            $cur_dir .= $temp[$i] . '/';
            if (@is_dir($cur_dir)) {
                continue;
            }

            @mkdir($cur_dir, 0777, true);
            @chmod($cur_dir, 0777);
        }
        return is_dir($path);
    }

    static function dir_path($path) {
        $path = str_replace('\\', '/', $path);
        if (substr($path, -1) != '/') {
            $path = $path . '/';
        }

        return $path;
    }

    static function checkEnvironment() {
        $data = [];
        $data['phpv'] = @phpversion();

        $data['os'] = php_uname();
        $tmp = function_exists('gd_info') ? gd_info() : array();
        $data['server '] = $_SERVER["SERVER_SOFTWARE"];
        $data['host'] = (empty($_SERVER["SERVER_ADDR"]) ? $_SERVER["SERVER_HOST"] : $_SERVER["SERVER_ADDR"]);
        $data['name'] = $_SERVER["SERVER_NAME"];
        $data['max_execution_time'] = ini_get('max_execution_time');
        $data['allow_reference'] = (ini_get('allow_call_time_pass_reference') ? '<font color=green>[√]On</font>' : '<font color=red>[×]Off</font>');
        $data['allow_url_fopen'] = (ini_get('allow_url_fopen') ? '<font color=green>[√]On</font>' : '<font color=red>[×]Off</font>');
        $data['safe_mode'] = (ini_get('safe_mode') ? '<font color=red>[×]On</font>' : '<font color=green>[√]Off</font>');

        $err = 0;
        if (empty($tmp['GD Version'])) {
            $data['gd'] = '<font color=red>[×]Off</font>';
            $err++;
        } else {
            $data['gd'] = '<font color=green>[√]On</font> ' . $tmp['GD Version'];
        }
        if (function_exists('mysql_connect')) {
            $data['mysql'] = '<span class="correct_span">&radic;</span> 已安装';
        } else {
            $data['mysql'] = '<span class="correct_span error_span">&radic;</span> 出现错误';
            $err++;
        }
        if (ini_get('file_uploads')) {
            $data['uploadSize'] = '<span class="correct_span">&radic;</span> ' . ini_get('upload_max_filesize');
        } else {
            $data['uploadSize'] = '<span class="correct_span error_span">&radic;</span>禁止上传';
        }
        if (function_exists('session_start')) {
            $data['session'] = '<span class="correct_span">&radic;</span> 支持';
        } else {
            $data['session'] = '<span class="correct_span error_span">&radic;</span> 不支持';
            $err++;
        }
        return $data;
    }

    static function makeInstallLock() {
        $path = Yii::getAlias('@app') . '/install/install.lock';
        $fp = @fopen($path, 'w+');
        fclose($fp);
    }

}
