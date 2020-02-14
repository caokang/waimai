<?php

/**
 * 本页仅供测试
 */


class FoodorderAction extends CommonAction {



    public function index() {
	    $Orders=D('Foodorder');// 实例化User对象
		$orderlist=$Orders->relation(true)->select();
		
		
        import('ORG.Util.Page');// 导入分页类
        $count      = $Orders->count();// 查询满足要求的总记录数
         $Page       = new Page($count,10);// 实例化分页类 传入总记录数和每页显示的记录数
	

		// $Page=$page->setConfig('next','2');
		



        $show       = $Page->show();// 分页显示输出
          // 进行分页数据查询 注意limit方法的参数要使用Page类的属性
        $orderlist = $Orders->relation(true)->limit($Page->firstRow.','.$Page->listRows)->select();
        $this->assign('orderlist',$orderlist);// 赋值数据集
        $this->assign('page',$show);// 赋值分页输出
        $this->display(); // 输出模板

		
		
		//dump($orderlist);
		
	
	
       
    }

   

}

?>