<?php

/**后台管理员视图模型
 */
class FoodorderViewModel extends ViewModel {	
	public $viewFields = array(
     'Foodorder'=>array('*','_type'=>'LEFT'),
     'Faddress'=>array('*', '_on'=>'Foodorder.faddid=Faddress.faddid'),
	 
     
   );

}
?>
