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

    static function sql_execute($sql, $tablepre) {
        $sqls = sql_split($sql, $tablepre);
        if (is_array($sqls)) {
            foreach ($sqls as $sql) {
                if (trim($sql) != '') {
                    mysql_query($sql);
                }
            }
        } else {
            mysql_query($sqls);
        }
        return true;
    }

    static function sql_split($sql, $tablepre) {

        if ($tablepre != "sp_") {
            $sql = str_replace("sp_", $tablepre, $sql);
        }

        $sql = preg_replace("/TYPE=(InnoDB|MyISAM|MEMORY)( DEFAULT CHARSET=[^; ]+)?/", "ENGINE=\\1 DEFAULT CHARSET=utf8", $sql);

        // if ($r_tablepre != $s_tablepre) {
        //     $sql = str_replace($s_tablepre, $r_tablepre, $sql);
        // }

        $sql = str_replace("\r", "\n", $sql);
        $ret = array();
        $num = 0;
        $queriesarray = explode(";\n", trim($sql));
        unset($sql);
        foreach ($queriesarray as $query) {
            $ret[$num] = '';
            $queries = explode("\n", trim($query));
            $queries = array_filter($queries);
            foreach ($queries as $query) {
                $str1 = substr($query, 0, 1);
                if ($str1 != '#' && $str1 != '-') {
                    $ret[$num] .= $query;
                }

            }
            $num++;
        }
        return $ret;
    }

    static function _dir_path($path) {
        $path = str_replace('\\', '/', $path);
        if (substr($path, -1) != '/') {
            $path = $path . '/';
        }

        return $path;
    }

// 获取客户端IP地址
    static function get_client_ip() {
        static $ip = NULL;
        if ($ip !== NULL) {
            return $ip;
        }

        if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $arr = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
            $pos = array_search('unknown', $arr);
            if (false !== $pos) {
                unset($arr[$pos]);
            }

            $ip = trim($arr[0]);
        } elseif (isset($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (isset($_SERVER['REMOTE_ADDR'])) {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        // IP地址合法验证
        $ip = (false !== ip2long($ip)) ? $ip : '0.0.0.0';
        return $ip;
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

    static function sp_password($pw, $pre) {
        $decor = md5($pre);
        $mi = md5($pw);
        return substr($decor, 0, 12) . $mi . substr($decor, -4, 4);
    }

    static function sp_random_string($len = 6) {
        $chars = array(
            "a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k",
            "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v",
            "w", "x", "y", "z", "A", "B", "C", "D", "E", "F", "G",
            "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R",
            "S", "T", "U", "V", "W", "X", "Y", "Z", "0", "1", "2",
            "3", "4", "5", "6", "7", "8", "9",
        );
        $charsLen = count($chars) - 1;
        shuffle($chars); // 将数组打乱
        $output = "";
        for ($i = 0; $i < $len; $i++) {
            $output .= $chars[mt_rand(0, $charsLen)];
        }
        return $output;
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
