<?php

/**后台管理员视图模型
 */
class FoodViewModel extends ViewModel {	
	public $viewFields = array(
     'Food'=>array('*'),
     'Foodcat'=>array('fcname', '_on'=>'Foodcat.fcid=Food.fcid'),
     
   );

}
?>
