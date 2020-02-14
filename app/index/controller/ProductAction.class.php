<?php
// 后台开启动单品单独页
// 
// 
// 
class ProductAction extends CommonAction {


//商品单独页面
    public function index(){
	
	 $data['fid']=I('id');//店铺分类
   
	
      $Food=M('Food');
	  $fooditem=$Food->where($data)->find();
	  $this->assign('fooditem',$fooditem);
	 
	  $this->display();
   
	
     
   }
   
	
	
	
	
	
   
}