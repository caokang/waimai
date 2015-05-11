<?php
//列表页
// 
// 
// 
class ListAction extends CommonAction {


//商品列表页
    public function index(){
	
     $data['fcid']=I('id');//店铺分类
     $Foodcat=D('Foodcat');		
	 $foodcatlist=$Foodcat->select();		
	 $this->assign('foodcatlist',$foodcatlist);//输出订单号
	 $catitem=$Foodcat->where($data)->find();
	 $this->assign('catitem',$catitem);//输出订单号
	 $gid=$_GET['gid'];
	 session('gid',$gid);
	 import('ORG.Util.Page');// 导入分页类
	
	 if ($data['fcid']){
      $Food=M('Food');
	  $data['status']='0';
	 $count      = $Food->where($data)->count();// 查询满足要求的总记录数
         $Page       = new Page($count,12);// 实例化分页类 传入总记录数和每页显示的记录数
        $show       = $Page->show();// 分页显示输出
          // 进行分页数据查询 注意limit方法的参数要使用Page类的属性
        $foodlists = $Food->where($data)->limit($Page->firstRow.','.$Page->listRows)->select();
		
      
	 }
	 else {
	 $Food=M('Food');
	
	 $count      = $Food->where('status=0')->count();// 查询满足要求的总记录数
         $Page       = new Page($count,12);// 实例化分页类 传入总记录数和每页显示的记录数
        $show       = $Page->show();// 分页显示输出
          // 进行分页数据查询 注意limit方法的参数要使用Page类的属性
        $foodlists = $Food->where('status=0')->limit($Page->firstRow.','.$Page->listRows)->select();
		
	 
	 
	 }
	
	  $this->assign('foodlists',$foodlists);
	   $this->assign('page',$show);// 赋值分页输出
	 
	  $this->display();
	
     
   }
   
	
	
	
   
}