<?php
// 本类由系统自动生成，仅供测试用途
//单店铺无会员注册
//
class MembersAction extends CommonAction {

  //会员中心页
   
    public function index(){
	
 
        $this->display();
   }
   
   
   
   //订单查询页
   
    public function search(){
	
 
        $this->display();
   }
   
   
     public function _empty($name){
            //把所有城市的操作解析到city方法
            $this->display('Public:404');
        }
		

	
    public function myorders(){
		 $otel=I('id');
		 session('otel',$otel);
		 $pid=I('pid');
		 session('pid',$pid);
		 
		 if ($otel){
		  $Orders=M('Foodorder');// 实例化User对象
        import('ORG.Util.Page');// 导入分页类
		
		$data['otel']=$otel;
        $count      = $Orders->where($data)->count();// 查询满足要求的总记录数
         $Page       = new Page($count,10);// 实例化分页类 传入总记录数和每页显示的记录数
        $show       = $Page->show();// 分页显示输出
          // 进行分页数据查询 注意limit方法的参数要使用Page类的属性
        $orderlist = $Orders->where($data)->limit($Page->firstRow.','.$Page->listRows)->order('oid desc')->select();
        $this->assign('orderlist',$orderlist);// 赋值数据集
        $this->assign('page',$show);// 赋值分页输出
        $this->display(); // 输出模板		 
		 
		 }
		 else {
		 
		    if ($pid){
			
			  $Orders=M('Foodorder');// 实例化User对象
        import('ORG.Util.Page');// 导入分页类
		
		$data['pid']=$pid;
        $count      = $Orders->where($data)->count();// 查询满足要求的总记录数
         $Page       = new Page($count,10);// 实例化分页类 传入总记录数和每页显示的记录数
        $show       = $Page->show();// 分页显示输出
          // 进行分页数据查询 注意limit方法的参数要使用Page类的属性
        $orderlist = $Orders->where($data)->limit($Page->firstRow.','.$Page->listRows)->order('oid desc')->select();
        $this->assign('orderlist',$orderlist);// 赋值数据集
        $this->assign('page',$show);// 赋值分页输出
        $this->display(); // 输出模板	
			
			
			}
			
		else {
		
		$this->redirect('Member/index');
		
		}
		 
		 }
        
		
        
     
        }	



	
	//我的订单列表查看
	
	    public function myorder(){
		
         $Orders=M('Foodorder');// 实例化User对象
        import('ORG.Util.Page');// 导入分页类
		
		
        $count      = $Orders->where($data)->count();// 查询满足要求的总记录数
         $Page       = new Page($count,10);// 实例化分页类 传入总记录数和每页显示的记录数
        $show       = $Page->show();// 分页显示输出
          // 进行分页数据查询 注意limit方法的参数要使用Page类的属性
        $orderlist = $Orders->where($data)->limit($Page->firstRow.','.$Page->listRows)->select();
        $this->assign('orderlist',$orderlist);// 赋值数据集
        $this->assign('page',$show);// 赋值分页输出
        $this->display(); // 输出模板
		
        
     
        }	
		
		public function orderdetail(){
				$id=I('id');
				$data['oid']=$id;
				
				
				
	         $otel=session('otel');
			 if ($otel){$data['otel']=session('otel');}
             $pid=session('pid');
			 if ($pid){$data['pid']=session('pid');}
			 
			 $Orders=D('Foodorder');// 实例化User对象
       
        $orderdetail = $Orders->relation(true)->where($data)->find();
		if ($orderdetail){
		 $this->assign('orderdetail',$orderdetail);// 赋值数据集
        
        $this->display(); // 输出模板
		
		} else
		{
		echo "无记录";
		}
		
       
		
        
     
        }
		

     
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
	
}