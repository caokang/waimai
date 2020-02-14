<?php

/**后台管理员视图模型
 */
class ArticleViewModel extends ViewModel {	
	public $viewFields = array(
     'Article'=>array('*'),
     'Article_cat'=>array('*', '_on'=>'Article_cat.acid=Article.acid'),
     
   );

}
?>
