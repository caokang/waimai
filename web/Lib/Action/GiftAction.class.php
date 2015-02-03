<?php
/*积分礼品列表页
*@积分礼品详情页
*@积分兑换
*@
*@
*/ 
class GiftAction extends CommonAction {

/*公用:此用户有多少积分
*/ 



/*积分礼品列表页
*/ 
     public function index(){
	  $Creditgood=M('Creditgood');
	  $giftlist=$Creditgood->select();
	 $this->assign('giftlist',$giftlist);
	 $this->display();
   }
   
   /*积分礼品列表页
*/ 
     public function detail(){
	  $id=I('id');
	  $data['cgid']=$id;
	  $Creditgood=M('Creditgood');
	  $gitem=$Creditgood->where($data)->find();
	 $this->assign('gitem',$gitem);
	 $this->display();
   }
     /*积分处理
*/ 
     public function add(){
	 //判定用户是否登录
	 if (!$_SESSION['user_id']){
      $this->redirect(U('Public/login'));
               }
	 
	 //判定用户积分与礼品消费积分大小
	$map['uid']=session('user_id');
	
	 $usercredit=M('Credit')->where($map)->sum('crecount');
	 $this->assign('usercredit',$usercredit);
	// dump($usercredit);
	 $id=I('id');
	 $data['cgid']=$id;
	 $Creditgood=M('Creditgood');
	 $gitem=$Creditgood->where($data)->find();
	 $this->assign('gitem',$gitem);
	 
	 //判定用户积分与礼品消费积分大小
	 

	 $this->display();
   }
   
   
    public function addsave(){
	 //将礼品积分数，礼品名称，时间，保存的积分表中，积分数为负值。
	  $goodname=I('goodname');
	  $cgid=I('cgid');
	  $data['typename']='积分兑换：'.$goodname;
	  $data['type']=1;
	  $data['uid']=session('user_id');
	 
	  $count=I('credit');
	  $data['crecount']='-'.$count;
	  $data['ctime']=time();
	  $data['ip']=get_client_ip();
	  $man=I('man');
	  $tel=I('tel');
	  $address=I('address');
	  if(!$man){$this->error('姓名不可以为空');}
	  if(!$tel){$this->error('电话不可以为空');}
	  if(!$address){$this->error('地址不可以为空');}
	  $data['crecontent']='姓名：'.$man.'电话：'.$tel.'地址：'.$address;
	  $Credit=M('Credit');
	  //判定数量是否为空
	  $cgcount=M('Creditgood')->where('cgid='.$cgid)->count('count'); 
	  if ($cgcount=0){$this->error('你下手太慢了，礼品兑换没了');}		
	  
	  $result=$Credit->add($data);
	  $map['cgid']=I('cgid');
	 if($result){
				 //将礼品数量减一　
				M('Creditgood')->where($map)->setDec('count'); 
				
					$this->success('操作成功');
					
					}
		  		   else {
				 $this->error('操作失败');
				   }
	
	 
	 
	 
	 
	 
   }
   
   
   
   
   
   
   
   
   
	
}