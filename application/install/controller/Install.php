<?php
namespace app\install\controller;

use think\Controller;
use think\Db;

class Install extends Controller
{
    public function _initialize()
    {
        parent::_initialize();
        if (is_file(ROOT_PATH . 'install.lock'))
        {
            // 已经安装过了 执行更新程序
            $msg = '请删除install.lock文件后再运行安装程序!';
            $this->error($msg);
        }
        $Title = "SuperCms企业建站系统－简单实用扩展灵活";
        $Powered = "Powered by SuperCms";
    }

    //安装第一步，检测运行所需的环境设置
    public function step1(){
        include_once("./templates/s1.php");
        return $this->fetch();
    }

    //安装第二步，创建数据库
    public function step2($db = null, $admin = null){
        if (phpversion() < 5) {
            die('本系统需要PHP5+MYSQL >=4.1环境，当前PHP版本为：' . phpversion());
        }

        $phpv = @ phpversion();
        $os = PHP_OS;
        $os = php_uname();
        $tmp = function_exists('gd_info') ? gd_info() : array();
        $server = $_SERVER["SERVER_SOFTWARE"];
        $host = (empty($_SERVER["SERVER_ADDR"]) ? $_SERVER["SERVER_HOST"] : $_SERVER["SERVER_ADDR"]);
        $name = $_SERVER["SERVER_NAME"];
        $max_execution_time = ini_get('max_execution_time');
        $allow_reference = (ini_get('allow_call_time_pass_reference') ? '<font color=green>[√]On</font>' : '<font color=red>[×]Off</font>');
        $allow_url_fopen = (ini_get('allow_url_fopen') ? '<font color=green>[√]On</font>' : '<font color=red>[×]Off</font>');
        $safe_mode = (ini_get('safe_mode') ? '<font color=red>[×]On</font>' : '<font color=green>[√]Off</font>');

        $err = 0;
        if (empty($tmp['GD Version'])) {
            $gd = '<font color=red>[×]Off</font>';
            $err++;
        } else {
            $gd = '<font color=green>[√]On</font> ' . $tmp['GD Version'];
        }
        if (function_exists('mysql_connect')) {
            $mysql = '<span class="correct_span">&radic;</span> 已安装';
        } else {
            $mysql = '<span class="correct_span error_span">&radic;</span> 出现错误';
            $err++;
        }
        if (ini_get('file_uploads')) {
            $uploadSize = '<span class="correct_span">&radic;</span> ' . ini_get('upload_max_filesize');
        } else {
            $uploadSize = '<span class="correct_span error_span">&radic;</span>禁止上传';
        }
        if (function_exists('session_start')) {
            $session = '<span class="correct_span">&radic;</span> 支持';
        } else {
            $session = '<span class="correct_span error_span">&radic;</span> 不支持';
            $err++;
        }
        $folder = array('/',

            'install',
            'data',

        );
        //include_once("./templates/s2.php");
       // exit();
        return view();
    }

    //安装第三步，安装数据表，创建配置文件
    public function step3(){

        if ($_GET['testdbpwd']) {
            $dbHost = $_POST['dbHost'] . ':' . $_POST['dbPort'];
            $conn = @mysql_connect($dbHost, $_POST['dbUser'], $_POST['dbPwd']);
            if ($conn) {
                die("1");
            } else {
                die("");
            }
        }
        include_once("./templates/s3.php");
        exit();

    }


    public function step4(){
        if (intval($_GET['install'])) {
            $n = intval($_GET['n']);
            $arr = array();

            $dbHost = trim($_POST['dbhost']);
            $dbPort = trim($_POST['dbport']);
            $dbName = trim($_POST['dbname']);
            $dbHost = empty($dbPort) || $dbPort == 3306 ? $dbHost : $dbHost . ':' . $dbPort;
            $dbUser = trim($_POST['dbuser']);
            $dbPwd = trim($_POST['dbpw']);
            $dbPrefix = empty($_POST['dbprefix']) ? 'sn_' : trim($_POST['dbprefix']);

            $username = trim($_POST['manager']);
            $password = trim($_POST['manager_pwd']);
            $email = trim($_POST['manager_email']);
            //网站名称
            $name = addslashes(trim($_POST['sitename']));
            //网站域名
            $url = trim($_POST['siteurl']);
            //附件地址
            // $sitefileurl = $site_url . "data/upload/";
            //描述
            $des = addslashes(trim($_POST['siteinfo']));
            //关键词
            $key = addslashes(trim($_POST['keywords']));

            $conn = @ mysql_connect($dbHost, $dbUser, $dbPwd);
            if (!$conn) {
                $arr['msg'] = "连接数据库失败!";
                echo json_encode($arr);
                exit;
            }
            mysql_query("SET NAMES 'utf8'"); //,character_set_client=binary,sql_mode='';
            $version = mysql_get_server_info($conn);
            if ($version < 4.1) {
                $arr['msg'] = '数据库版本太低!';
                echo json_encode($arr);
                exit;
            }

            if (!mysql_select_db($dbName, $conn)) {
                //创建数据时同时设置编码
                if (!mysql_query("CREATE DATABASE IF NOT EXISTS `" . $dbName . "` DEFAULT CHARACTER SET utf8;", $conn)) {
                    $arr['msg'] = '数据库 ' . $dbName . ' 不存在，也没权限创建新的数据库！';
                    echo json_encode($arr);
                    exit;
                }
                if (empty($n)) {
                    $arr['n'] = 1;
                    $arr['msg'] = "成功创建数据库:{$dbName}<br>";
                    echo json_encode($arr);
                    exit;
                }
                mysql_select_db($dbName, $conn);
            }

            //读取数据文件
            $sqldata = file_get_contents(SITEDIR . 'install/' . $sqlFile);
            $sqlFormat = sql_split($sqldata, $dbPrefix);


            /**
             * 执行SQL语句
             */
            $counts = count($sqlFormat);

            for ($i = $n; $i < $counts; $i++) {
                $sql = trim($sqlFormat[$i]);

                if (strstr($sql, 'CREATE TABLE')) {
                    preg_match('/CREATE TABLE `([^ ]*)`/', $sql, $matches);
                    mysql_query("DROP TABLE IF EXISTS `$matches[1]");
                    $ret = mysql_query($sql);
                    if ($ret) {
                        $message = '<li><span class="correct_span">&radic;</span>创建数据表' . $matches[1] . '，完成</li> ';
                    } else {
                        $message = '<li><span class="correct_span error_span">&radic;</span>创建数据表' . $matches[1] . '，失败</li>';
                    }
                    $i++;
                    $arr = array('n' => $i, 'msg' => $message);
                    echo json_encode($arr);
                    exit;
                } else {
                    $ret = mysql_query($sql);
                    $message = '';
                    $arr = array('n' => $i, 'msg' => $message);
                    //echo json_encode($arr); exit;
                }
            }

            if ($i == 999999)
                exit;
            //更新配置信息
            /*   $site_options=<<<helllo
            {
                     "name":"name",
                     "url":"url"
                     "title":"$name",
                     "key":"$key",
                     "des":"$des"
         }
 helllo;*/
            //$query ="UPDATE `{$dbPrefix}config` SET  `value` = '{$url}' WHERE rname='url' ";

            mysql_query("UPDATE `{$dbPrefix}config` SET  `value` = '{$url}' WHERE name='url' ");
            mysql_query("UPDATE `{$dbPrefix}config` SET  `value` = '{$name}' WHERE name='name' ");
            mysql_query("UPDATE `{$dbPrefix}config` SET  `value` = '{$name}' WHERE name='title'");
            mysql_query("UPDATE `{$dbPrefix}config` SET  `value` = '{$key}' WHERE name='key'");
            mysql_query("UPDATE `{$dbPrefix}config` SET  `value` = '{$des}' WHERE name='des'");

            //读取配置文件，并替换真实配置数据
            $strConfig = file_get_contents(SITEDIR . 'install/' . $configFile);
            $strConfig = str_replace('#DB_HOST#', $dbHost, $strConfig);
            $strConfig = str_replace('#DB_NAME#', $dbName, $strConfig);
            $strConfig = str_replace('#DB_USER#', $dbUser, $strConfig);
            $strConfig = str_replace('#DB_PWD#', $dbPwd, $strConfig);
            $strConfig = str_replace('#DB_PORT#', $dbPort, $strConfig);
            $strConfig = str_replace('#DB_PREFIX#', $dbPrefix, $strConfig);
            $strConfig = str_replace('#AUTHCODE#', sp_random_string(18), $strConfig);
            $strConfig = str_replace('#COOKIE_PREFIX#', sp_random_string(6) . "_", $strConfig);
            @chmod(SITEDIR . '/db.php', 0777);
            @file_put_contents(SITEDIR . '/db.php', $strConfig);

            //插入管理员
            //生成随机认证码
            $verify = sp_random_string(6);
            $time = time();
            $create_date = date("Y-m-d h:i:s");
            $ip = get_client_ip();
            $ip = empty($ip) ? "0.0.0.0" : $ip;
            $password = md5($password);
            $query = "INSERT INTO `{$dbPrefix}members` (uid,username,userpass,userpic,useremail,usertel,nickname,userqq,usersex,usergroup,last_login_ip,last_login_time,create_time,userlevel,userpoint,userstatus) VALUES ('1', '{$username}', '{$password}', '', '{$email}', '', '', '', '1', '0', '$ip','$create_date','','99','','');";
            mysql_query($query);

            $message = '成功添加管理员<br />成功写入配置文件<br>安装完成．';
            $arr = array('n' => 999999, 'msg' => $message);
            echo json_encode($arr);
            exit;
        }

        include_once("./templates/s4.php");
        exit();

    }

    public function step5(){
        $ip = get_client_ip();
        $host = $_SERVER['HTTP_HOST'];
        include_once("./templates/s5.php");
        @touch('./install.lock');
        exit();
    }

    public function tip($info,$title='很遗憾，安装失败，失败原因'){
        $this->assign('info',$info);// 提示信息
        $this->assign('title',$title);
        return view('error');exit;
    }
}