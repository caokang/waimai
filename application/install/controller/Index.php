<?php
namespace app\install\controller;

use think\Controller;
use think\Config;

class Index extends Controller
{
    //安装首页
    public function index(){

        if (is_file(ROOT_PATH . 'install.lock'))
        {
            // 已经安装过了 执行更新程序
            $msg = '请删除install.lock文件后再运行安装程序!';
            $this->error($msg);
        }


        if (file_exists('./install.lock')) {
            echo '
		<html>
        <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        </head>
        <body>
        你已经安装过该系统，如果想重新安装，请先删除站点install目录下的 install.lock 文件，然后再安装。
        </body>
        </html>';
            exit;
        }
        @set_time_limit(1000);
        if (phpversion() <= '5.3.0')
            set_magic_quotes_runtime(0);
        if ('5.2.0' > phpversion())
            exit('您的php版本过低，不能安装本软件，请升级到5.2.0或更高版本再安装，谢谢！');

        date_default_timezone_set('PRC');
        error_reporting(E_ALL & ~E_NOTICE);
        header('Content-Type: text/html; charset=UTF-8');
        //define('SITEDIR', _dir_path(substr(dirname(__FILE__), 0, -8)));
        define("SIMPLEWIND_CMF_VERSION", '20140214');

//数据库
        $sqlFile = 'supercms.sql';
        $configFile = 'config.php';
        $Title = "SuperCms企业建站系统－简单实用扩展灵活";
        $Powered = "Powered by SuperCms";
        $steps = array(
            '1' => '安装许可协议',
            '2' => '运行环境检测',
            '3' => '安装参数设置',
            '4' => '安装详细过程',
            '5' => '安装完成',
        );
        $step = isset($_GET['step']) ? $_GET['step'] : 1;

//地址
        $scriptName = !empty($_SERVER["REQUEST_URI"]) ? $scriptName = $_SERVER["REQUEST_URI"] : $scriptName = $_SERVER["PHP_SELF"];
        $rootpath = @preg_replace("/\/(I|i)nstall\/index\.php(.*)$/", "", $scriptName);
        $domain = empty($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : $_SERVER['SERVER_NAME'];
        if ((int)$_SERVER['SERVER_PORT'] != 80) {
            $domain .= ":" . $_SERVER['SERVER_PORT'];
        }
        $domain = $domain . $rootpath;

        switch ($step) {

            case '1':


            case '2':

            case '3':


            case '4':

            case '5':

        }

        return view();
    }



    function testwrite($d)
    {
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

    function sql_execute($sql, $tablepre)
    {
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

    function sql_split($sql, $tablepre)
    {

        if ($tablepre != "sn_")
            $sql = str_replace("sn_", $tablepre, $sql);
        $sql = preg_replace("/TYPE=(InnoDB|MyISAM|MEMORY)( DEFAULT CHARSET=[^; ]+)?/", "ENGINE=\\1 DEFAULT CHARSET=utf8", $sql);

        if ($r_tablepre != $s_tablepre)
            $sql = str_replace($s_tablepre, $r_tablepre, $sql);
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
                if ($str1 != '#' && $str1 != '-')
                    $ret[$num] .= $query;
            }
            $num++;
        }
        return $ret;
    }

    function _dir_path($path)
    {
        $path = str_replace('\\', '/', $path);
        if (substr($path, -1) != '/')
            $path = $path . '/';
        return $path;
    }

// 获取客户端IP地址
    function get_client_ip()
    {
        static $ip = NULL;
        if ($ip !== NULL)
            return $ip;
        if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $arr = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
            $pos = array_search('unknown', $arr);
            if (false !== $pos)
                unset($arr[$pos]);
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

    function dir_create($path, $mode = 0777)
    {
        if (is_dir($path))
            return TRUE;
        $ftp_enable = 0;
        $path = dir_path($path);
        $temp = explode('/', $path);
        $cur_dir = '';
        $max = count($temp) - 1;
        for ($i = 0; $i < $max; $i++) {
            $cur_dir .= $temp[$i] . '/';
            if (@is_dir($cur_dir))
                continue;
            @mkdir($cur_dir, 0777, true);
            @chmod($cur_dir, 0777);
        }
        return is_dir($path);
    }

    function dir_path($path)
    {
        $path = str_replace('\\', '/', $path);
        if (substr($path, -1) != '/')
            $path = $path . '/';
        return $path;
    }

    function sp_password($pw, $pre)
    {
        $decor = md5($pre);
        $mi = md5($pw);
        return substr($decor, 0, 12) . $mi . substr($decor, -4, 4);
    }

    function sp_random_string($len = 6)
    {
        $chars = array(
            "a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k",
            "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v",
            "w", "x", "y", "z", "A", "B", "C", "D", "E", "F", "G",
            "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R",
            "S", "T", "U", "V", "W", "X", "Y", "Z", "0", "1", "2",
            "3", "4", "5", "6", "7", "8", "9"
        );
        $charsLen = count($chars) - 1;
        shuffle($chars);    // 将数组打乱
        $output = "";
        for ($i = 0; $i < $len; $i++) {
            $output .= $chars[mt_rand(0, $charsLen)];
        }
        return $output;
    }


}