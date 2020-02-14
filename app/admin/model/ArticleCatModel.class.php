<?php
class ArticleCatModel extends Model {
	// 自动验证设置

	protected $_validate	 =	 array(
	        
            array('aname','require','分类名称不可以为空'),
			array('dir','require','分类目录名不可以为空'),
			array('dir','','分类目录名已经存在！',0,'unique',1), 
			array('aname','','分类名称已经存在！',0,'unique',1), 
            array('dir','english','分类目录名为英文字符'),　　　　　
         );
	
	
	function ismdir($name){//判定已否已存在模块
	
	   if ($name=='index'||$name=='prouduct'||$name=='shop'||$name=='message'||$name=='contact'||$name=='cart'||$name=='user'||$name=='order')
	   { return false;}
	 
		  else { return true;}
		  
	  
	   }
	
	
	
	
	
	
	function isdir($name){
	$con['dir']=$name;
	$res=$this->where($con)->select();
	   if ($name=='index'||$name=='prouduct'||$name=='shop'||$name=='message'||$name=='contact'||$name=='cart'||$name=='user')
	   { return false;}
	   else {
	      
		  
		  if ($res) {return false;}
		  else { return true;}
		  
	  
	   }
	  
}



	
}
?>