<?php
// 地址管理
class AddressAction extends CommonAction {




    public function index(){
	 if (!$_SESSION['user_id']){
      $this->redirect(U('Public/login'));
               }
	 $data['uid']=session('user_id');
	 
	 $Faddress=M('Faddress');
     $adlist=$Faddress->where($data)->order('addtop desc,faddid desc')->select();
	 $this->assign('adlist',$adlist);// 赋值分页输出
	 
	 $this->display();
   }
   
       public function add(){
	
	
     $this->display();
   }
   
   
   //地址保存
       public function save(){
	    if (!$_SESSION['user_id']){
      $this->redirect(U('Public/login'));
               }
	   	$data['name']=I('name');
	    $data['tel']=I('tel');
		$data['address']=I('address');
		$data['uid']=session('user_id');
		
		$data['addtop']=I('istop');
		$data['ctime']=time();
		$Faddress=M('Faddress');
		$topaddress=$Faddress->where('addtop=1 and uid='.$data['uid'])->find();
		if($data['addtop']){
		     if ($topaddress)
			     {
		          //处理一下默认地址逻辑
		          $Faddress->where('faddid='.$topaddress['faddid'])->setField('addtop','0');
		
		         }
		}
		
	    
		
		$Faddress->add($data);
header("location:".$_SERVER["HTTP_REFERER"]);
   }
   
       public function _empty($name){
            //把所有城市的操作解析到city方法
            $this->display('Public:404');
        }
   
   
   //地址删除
       public function del(){
	      if (!$_SESSION['user_id']){
      $this->redirect(U('Public/login'));
               }
	   $data['faddid']=I('id');
	   $data['uid']=session('user_id');
	   
	   $Faddress=M('Faddress');
	   $result=$Faddress->where($data)->delete();
	   if($result){
	   //$this->success('操作成功');//redirect(U(Articlecate/index));
        header("location:".$_SERVER["HTTP_REFERER"]);    
			}else {//错误页面的默认跳转页面是返回前一页，通常不需要设置
                    $this->error('操作失败');}
	
    
   }
   
   
   
   
   //默认地址设置
   
       public function addtop(){
	      if (!$_SESSION['user_id']){
      $this->redirect(U('Public/login'));
               }
	   $data['faddid']=I('id');
	   $data['uid']=session('user_id');
	   
        $Faddress=M('Faddress');
		$topaddress=$Faddress->where('addtop=1 and uid='.$data['uid'])->find();
		
		     if ($topaddress)
			     {
		          //处理一下默认地址逻辑
		          $Faddress->where('faddid='.$topaddress['faddid'])->setField('addtop','0');
		          
		         }
				
	      $Faddress->where($data)->setField('addtop','1');
		
		 header("location:".$_SERVER["HTTP_REFERER"]);  
	   
    
   }
   
    //微信地址维护
   
       public function wadd(){
	    $gid=session('gid');
		
		if ($gid){
	    $Faddress=M('Faddress');
		$addressitem=$Faddress->where('gid='.$gid)->find();
		 $this->assign('addressitem',$addressitem);// 赋值分页输出
	 
		
		}
		else {}
		$this->display();
	   }
	   
	  //微信地址保存
	  
      public function wsave(){
	  $gid=session('gid');
	  $Faddress=M('Faddress');
	  if ($gid){
	   
	   
	    $data['name']=I('name');
	    $data['tel']=I('tel');
		$data['address']=I('address');
		$data['ctime']=time();
		$isadd=$Faddress->where('gid='.$gid)->find();
       if ($isadd){
	   
	   $Faddress->where('gid='.$gid)->save($data);
	   $this->redirect('Cart/index');
	   }	   
	   else {
	   $data['gid']=session('gid');
	   $Faddress->add($data);
	   $this->redirect('Cart/index');
	   }
				
    //header("location:".$_SERVER["HTTP_REFERER"]);
		
		}
		else {
		
		
		
		}
		
		}
		
		
}