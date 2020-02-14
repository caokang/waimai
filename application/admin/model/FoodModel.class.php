<?php
class FoodModel extends Model {
	// 自动验证设置
	protected $_validate	 =	 array(
           
            array('fname','require','菜名不可以为空'),
			
        );
	

}
?>