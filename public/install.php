<?php

// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
// [ MuuCmf 安装入口文件 ]
header("Content-Type: text/html;charset=utf-8");
if (version_compare(PHP_VERSION, '5.5.0', '<'))
    die('当前PHP版本' . PHP_VERSION . '，最低要求PHP版本5.5.0 <br/><br/>很遗憾，未能达到最低要求。本系统必须运行在PHP5.5 及以上版本。');
// 定义应用目录
define('APP_PATH', __DIR__ . '/../application/');
// 判断是否安装MuuCmf
if (is_file(APP_PATH . './install.lock'))
{
    header("location:./index.php");
    exit;
}
// 安装数据目录
define('INSTALL_PATH', APP_PATH . 'install/data/');

define('INSTALL_APP_PATH', __DIR__ .'/../');

// 加载框架引导文件
require __DIR__ . '/../thinkphp/base.php';

// 绑定到admin模块
\think\Route::bind('install');

// 执行应用
\think\App::run()->send();
