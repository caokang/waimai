<?php

// [ 应用入口文件 ]
namespace think;

//单入口模式
define('APP_NAME', 'admin');
define('APP_PATH', __DIR__ . '/../application/');

if(!is_file('db.php')){
	header('Location: ./install/index.php');
	exit;
}

/**
 * 系统调试设置
 * 项目正式部署后请设置为false
 */
//define('APP_DEBUG', 'true');
require __DIR__ . '/../thinkphp/base.php';
// 绑定当前入口文件到admin模块
Route::bind('admin');
// 关闭admin模块的路由
App::route(false);
// 执行应用
App::run()->send();

?>