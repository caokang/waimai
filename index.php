<?php
//超级外卖2.0光棍节版20141111
/**
 * 定义核心库地址
 */
define('THINK_PATH', './inc/');

define('APP_NAME', 'web');

/**
 * 应用目录设置
 * 安全期间，建议安装调试完成后移动到非WEB目录
 */
define('APP_PATH', './web/');

/**
 * 缓存目录设置
 * 此目录必须可写，建议移动到非WEB目录
 */
define('RUNTIME_PATH', './data/');

define('TMPL_PATH', './templates/');

if(!is_file('db.php')){
	header('Location: ./install/index.php');
	exit;
}

/**
 * 系统调试设置
 * 项目正式部署后请设置为false
 */
//define('APP_DEBUG', 'true');

/**
 * 引入核心入口
 * ThinkPHP亦可移动到WEB以外的目录
 */
require(THINK_PATH."/ThinkPHP.php");

// 版本信息
//const SUPERCMS_VERSION  =   '2.4';
?>