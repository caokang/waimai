<?php
// 本版本为20140401版本，需要支付功能请联系ＱＱ：87297326
class IndexAction extends CommonAction {



    public function index(){
	
	
   
	
      $Food=M('Food');
	  $foodlist=$Food->limit(15)->order('fid desc')->where('status=0')->select();
	  $this->assign('foodlist',$foodlist);
	  $gid=session('gid');
	  if(!$gid){$gid=$_GET['gid'];
	  session('gid',$gid);}
	 
	   $Link=M('Link');
	$adlist=$Link->where('type=1')->limit(3)->order('lid desc')->select();
	$this->assign('adlist',$adlist);
	  
	 
	$llist=$Link->where('type=0')->limit(30)->order('lid desc')->select();
	$this->assign('llist',$llist);
	 // dump($foodlist);
	  $this->display();
  
   }
   
	
	 public function flist(){
	 $data['fcid']=I('id');//店铺分类
	 $data['status']='0';
    $Foods=D('Foodcat');		
	$foodcatlist=$Foods->select();		
	$this->assign('foodcatlist',$foodcatlist);//输出订单号
	
	
      $Food=M('Food');
	  import('ORG.Util.Page');// 导入分页类
	
	 $count      = $Food->where($data)->count();// 查询满足要求的总记录数
         $Page       = new Page($count,20);// 实例化分页类 传入总记录数和每页显示的记录数
        $show       = $Page->show();// 分页显示输出
          // 进行分页数据查询 注意limit方法的参数要使用Page类的属性
        $foodlist = $Food->where($data)->limit($Page->firstRow.','.$Page->listRows)->select();
		
       $this->assign('foodlist',$foodlist);
	   $this->assign('page',$show);// 赋值分页输出
	 
	 
	 
	  $this->display();
  
   }
   //菜品详情页展示
	public function show(){
	 $data['fid']=I('id');//店铺分类
   
	
      $Food=M('Food');
	  $fooditem=$Food->where($data)->find();
	  $this->assign('fooditem',$fooditem);
	 
	  $this->display();
  
   }
	 
	
	
	
	
   
}