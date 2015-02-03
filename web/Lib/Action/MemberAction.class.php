<?php
// 本类由系统自动生成，仅供测试用途
//单店铺无会员注册
//
class MemberAction extends CommonAction {


  


  //会员中心页
   
    public function index(){
	 if (!$_SESSION['user_id']){
      $this->redirect(U('Public/login'));
               }
	$data['uid']=session('user_id');
	 $gid=$_GET['gid'];
	  session('gid',$gid);
    //积分数
	$usercredit=M('Credit')->where($data)->sum('crecount');
	 $this->assign('usercredit',$usercredit);
	//订单数
    $ordercount=M('Foodorder')->where($data)->count('oid');
	$this->assign('ordercount',$ordercount);
    //最新活动 
	
		$this->display();
   }
   
   
   
 
   
     public function _empty($name){
            //把所有城市的操作解析到city方法
            $this->display('Public:404');
        }
		

/*** ************************微信订单处理*************************************/ 
 
   
   
   
   
   //微信查看订单
	  public function order(){
	   if (!$_SESSION['user_id']){
      $this->redirect(U('Public/login'));
               }
	   //$data['gid']=session('gid');
	  
	     $Orders=M('Foodorder');// 实例化User对象
        import('ORG.Util.Page');// 导入分页类
		$data['uid']=session('user_id');
		 $gid=$_GET['gid'];
	     session('gid',$gid);
		
		
		
		
        $count      = $Orders->where($data)->count();// 查询满足要求的总记录数
         $Page       = new Page($count,10);// 实例化分页类 传入总记录数和每页显示的记录数
        $show       = $Page->show();// 分页显示输出
          // 进行分页数据查询 注意limit方法的参数要使用Page类的属性
        $orderlist = $Orders->where($data)->limit($Page->firstRow.','.$Page->listRows)->order('oid desc')->select();
		
        $this->assign('orderlist',$orderlist);// 赋值数据集
        $this->assign('page',$show);// 赋值分页输出
        $this->display(); // 输出模板
	  
	
	
	
	}
	
	//订单详情
	
	public function detail(){
	 if (!$_SESSION['user_id']){
      $this->redirect(U('Public/login'));
               }
				$id=I('id');
				$data['oid']=$id;
		        $data['uid']=session('user_id');
         $Orders=D('Foodorder');// 实例化User对象
       
        $orderdetail = $Orders->relation(true)->where($data)->find();
		
        $this->assign('orderdetail',$orderdetail);// 赋值数据集
        
        $this->display(); // 输出模板
		
        
     
        }
		
		
		   public function reorder(){
		    if (!$_SESSION['user_id']){
      $this->redirect(U('Public/login'));
               }
	   		 $data['oid']=I('id');
	   	  $Order=M('Foodorder');
		   $data['uid']=session('user_id');
	     $map['orderstatus']=5;
		 $result=$Order->where($data)->save($map);
	     if($result){$this->success('操作成功');//redirect(U(Articlecate/index));
             }else {//错误页面的默认跳转页面是返回前一页，通常不需要设置
                    $this->error('操作失败');}
   } 





   
/***订单处理*****/  
   
   
   
   
   //电脑查看订单
	  public function worder(){
	  
	   $gid=session('gid');
	   
	  if ($gid){
	     $Orders=M('Foodorder');// 实例化User对象
        import('ORG.Util.Page');// 导入分页类
		$data['gid']=$gid;
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
	
	echo '出错了';
	}
	
	
	}
	
	//订单详情
	
	public function wdetail(){
	
				$id=I('id');
				$data['oid']=$id;
		        
         $data['gid']=session('gid');
	  if ($data['gid']){
		 $Orders=D('Foodorder');// 实例化User对象
       
        $orderdetail = $Orders->relation(true)->where($data)->find();
		
        $this->assign('orderdetail',$orderdetail);// 赋值数据集
        
        $this->display(); // 输出模板
		
        }
     
        }
		
		
		   public function wreorder(){
		    $data['gid']=session('gid');
	  if ($data['gid']){
	   		 $data['oid']=I('id');
	   	  $Order=M('Foodorder');
		   
	     $map['orderstatus']=5;
		 $result=$Order->where($data)->save($map);
	     if($result){$this->success('操作成功');//redirect(U(Articlecate/index));
             }else {//错误页面的默认跳转页面是返回前一页，通常不需要设置
                    $this->error('操作失败');}
					}
   } 
		
	/*** ************************积分查询*************************************/ 
 
   
   public function credit(){
    if (!$_SESSION['user_id']){
      $this->redirect(U('Public/login'));
               }
    $Credit=M('Credit');
	$data['uid']=session('user_id');
	 $gid=$_GET['gid'];
	 session('gid',$gid);
	
    import('ORG.Util.Page');// 导入分页类
	
        $count      = $Credit->where($data)->count();// 查询满足要求的总记录数
         $Page       = new Page($count,10);// 实例化分页类 传入总记录数和每页显示的记录数
        $show       = $Page->show();// 分页显示输出
          // 进行分页数据查询 注意limit方法的参数要使用Page类的属性
        $crelist = $Credit->where($data)->limit($Page->firstRow.','.$Page->listRows)->order('creid desc')->select();
		$this->assign('crelist',$crelist);// 赋值数据集
        $this->assign('page',$show);// 赋值分页输出
        $this->display(); // 输出模板
   
	}
   
   
   /*** ************************密码修改*************************************/ 
  

  
  public function about(){
   if (!$_SESSION['user_id']){
      $this->redirect(U('Public/login'));
               }
  
   $this->display();
   }
     
   //密码保存
   public function passwordsave(){
    if (!$_SESSION['user_id']){
      $this->redirect(U('Public/login'));
               }
   $oldpassword=I('oldpassword');
   if (!$oldpassword){ $this->error('原密码不可以为空');}
   $newpassword=I('newpassword');
   $repassword=I('repassword');
   if ($repassword!=$newpassword){ $this->error('新密码不一致');}
   $data['uid']=session('user_id');
   $data['userpass']=md5($oldpassword);
   $Member=M('Members');
   $muser=$Member->where($data)->find();
   
   if (!$muser){ 
   $this->error('原密码错误');
   }
   else 
   {
   $map['userpass']=md5($repassword);
   $Member->where('uid='.$data['uid'])->save($map);
   $this->success('操作成功');
   }
   
   }
   
   
    /*** ************************我的留言*************************************/ 
  
  
   
     public function message(){
	  if (!$_SESSION['user_id']){
      $this->redirect(U('Public/login'));
               }
	   $data['uid']=session('user_id');
	  $Message=M('Message');
	  	import('ORG.Util.Page');// 导入分页类
        $count      = $Message->where($data)->count();// 查询满足要求的总记录数
        $Page       = new Page($count,10);// 实例化分页类 传入总记录数和每页显示的记录数
        $show       = $Page->show();// 分页显示输出
          // 进行分页数据查询 注意limit方法的参数要使用Page类的属性
        $mslist = $Message->where($data)->limit($Page->firstRow.','.$Page->listRows)->order('msid desc')->select();
		//dump($plist);
        $this->assign('page',$show);// 赋值分页输出
		 
		 $tlist=list_to_tree($mslist, $pk='msid',$pid = 'pid',$child = '_child',$root=0);
		
		
	     $this->assign('mslist',$tlist);// 赋值分页输出
	
	
	    $this->display();
	 
	 
  
   }
   
   
   
   
   
   
   
   
   
	
}