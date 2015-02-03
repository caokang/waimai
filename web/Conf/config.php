<?php

$config = require './db.php';

$array =array(
	//'配置项'=>'配置值'
//'LOG_RECORD' => true, // 开启日志记录
//'SHOW_PAGE_TRACE' =>true, 
 'DEFAULT_THEME'         => 'mall',

	'TOKEN_ON'=>true,  // 是否开启令牌验证
'TOKEN_NAME'=>'__hash__',    // 令牌验证的表单隐藏字段名称
'TOKEN_TYPE'=>'md5',  //令牌哈希验证规则 默认为MD5
'TOKEN_RESET'=>true,  //令牌验证出错后是否重置令牌 默认为true
'VAR_FILTERS'=>'htmlspecialchars,stripslashes,strip_tags,trim',
	
   'URL_CASE_INSENSITIVE'  => true,   // 默认false 表示URL区分大小写 true则表示不区分大小写
 'URL_MODEL'             => 0,       // URL访问模式,可选参数0、1、2、3,代表以下四种模式：
    'TMPL_ACTION_ERROR'     => './Public/404/jump.html', // 默认错误跳转对应的模板文件
 'TMPL_ACTION_SUCCESS'   => './Public/404/jump.html', // 默认成功跳转对应的模板文件
//'TMPL_EXCEPTION_FILE'   => './Public/404/think_exception.tpl',// 异常页面的模板文件
  

	



	
	
	
	
);

return array_merge($config,$array);




?>