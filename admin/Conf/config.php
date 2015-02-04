<?php
$config = require './db.php';
$array =array(
	//'配置项'=>'配置值'
	'URL_HTML_SUFFIX'=>'',
	'URL_MODEL'=>0,
	'DEFAULT_THEME'=> '',
	'DB_BACKUP'=> './data/databak/',
	 
	"web_title"=> '超级外买SuperCms',
	"web_url"=> '',
	 
	'TMPL_ACTION_ERROR'     => APP_PATH.'Tpl/404/jump.html', // 默认错误跳转对应的模板文件
	'TMPL_ACTION_SUCCESS'   => APP_PATH.'Tpl/404/jump.html', // 默认成功跳转对应的模板文件
	'TMPL_EXCEPTION_FILE'   => APP_PATH.'Tpl/404/think_exception.tpl',// 异常页面的模板文件
	
	//'TOKEN_ON'=>true,  // 是否开启令牌验证
	'TOKEN_NAME'=>'__hash__',    // 令牌验证的表单隐藏字段名称
	'TOKEN_TYPE'=>'md5',  //令牌哈希验证规则 默认为MD5
	'TOKEN_RESET'=>true,  //令牌验证出错后是否重置令牌 默认为true
	'VAR_FILTERS'=>'htmlspecialchars,stripslashes,strip_tags,trim',

);
return array_merge($config,$array);
?>