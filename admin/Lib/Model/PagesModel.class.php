<?php
class PagesModel extends Model {
	// 自动验证设置

	protected $_validate	 =	 array(
            array('page_title','require','标题不可以为空'),
			array('pagedir','require','分类目录名不可以为空'),
			array('pagedir','','分类目录名已经存在！',0,'unique',1),
			array('pagedir','english','分类目录名为英文字符'),
         );
	

	  




	
}
?>