<?php

/**后台管理员视图模型
 */
class FoodcatModel extends RelationModel{
    protected $_link = array(
            'Food'=>array(
            'mapping_type'    =>HAS_MANY,
                  'class_name'=>'Food',

				  'foreign_key'=>'fcid',
				   

             
             ),
         );
}



?>
