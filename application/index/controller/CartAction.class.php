<?php
/*购物车模块
*@超级外卖20140406
*@www.bijiadao.net
*@
*@
*/ 
class CartAction extends CommonAction {

	
         function _initialize() {
		 parent::_initialize();	
        header("Content-Type:text/html; charset=utf-8");
		
				
    }


	

  public function index(){

	 $uuid=session('user_id');
	
	if ($uuid){
	  //提取地址列表输出页面
	$Faddress=M('Faddress');
	$addlist=$Faddress->where('uid='.$uuid)->limit(5)->order('addtop desc,faddid desc')->select();
    $this->assign ( 'addlist', $addlist );
   }
	  $this->display();
	
	
	
	}
	
   
   
   public function cartok(){
	$id=trim($_GET['id']);
	 //取订单信息
	 $data['oid']=$id;
	 $pid=$_COOKIE["PHPSESSID"];
	 $data['pid']=$pid;
	// $data['uid']=session('user_id');
	 $Order=D('Foodorder');
	 $oitem=$Order->relation(true)->where($data)->find();
	 
	 if ($oitem){
	
	//dump($pid);
    $this->assign('orderdetail',$oitem);
	$this->assign('payname',C('payname'));//支付宝帐户
	$this->assign('pid',$pid);
	
	$this->display();
	
	}
	else {
	echo "非法操作";}
	
	
	}

	//支付确认页
	 public function cartpay(){
	 $id=trim($_GET['id']);

	
	 
	 //取订单信息
	  $data['pid']=cookie('PHPSESSID');
	 
	 $data['oid']=$id;
	// $data['uid']=session('user_id');
	 $Order=D('Foodorder');
	 $oitem=$Order->relation(true)->where($data)->find();
	 if ($oitem){
	 $pid=$_COOKIE["PHPSESSID"];
	//dump($pid);
    $this->assign('orderdetail',$oitem);
	$this->assign('payname',C('payname'));//支付宝帐户
	$this->assign('pid',$pid);
	
	$this->display ();
	 
	 }
	else {
	echo "非法操作";
	}
	
	
	
	
	}

	
	
	
	
  //订单保存
    
	public function save(){
	$Order=D('Foodorder');
	$itemcount=I('itemCount');
	if(!$itemcount){$this->error('非法操作');}
	for ($i=0;$i<=$itemcount;$i++){
	  $arrname=I('item_name_'.$i);
	  if ($arrname){
	  $arr[$i]['fname']=I('item_name_'.$i);
	  $arr[$i]['fprice']=(I('item_price_'.$i));
	  $arr[$i]['fcount']=I('item_quantity_'.$i);
	  $arr[$i]['prices']=$arr[$i]['fcount'] * $arr[$i]['fprice'];
	  $fid=I('item_options_'.$i);
	  $arr[$i]['fid']=trim(substr($fid,4));
	
	  }
	  
	  
	
	}
	$data['Foodorderext']=$arr;
	$data['uid']=session('user_id');//
	$address=I('address');
	
	if ($data['uid']){
	
	$add=explode(",",$address);
	$data['otel']=$add['0'];//联系手机号
	$data['oman']=$add['1'];//联系人
	$data['oaddress']=$add['2'];//联系址址
	
	
	}
    else {	
    $data['otel']=I('otel');//联系手机号
	$data['oman']=I('oman');//联系人
	$data['oaddress']=I('oaddress');//联系址址
	
	}
	
	$data['pid']=$_COOKIE["PHPSESSID"];
	
	$days=I('days');//吃饭时间
    $times=I('times');//吃饭时间	
	$data['order_dtime']=$days.' '.$times;//吃饭时间
	$data['morecontent']=I('ocontent');//备注	
	if(!$data['oaddress']){$this->error('外卖地址不可以为空');};
	if(!$data['otel']){$this->error('电话不可以为空');};
	$data['orderprice']=I('item_totals');//购物车商品总价格
	$data['ordercount']=I('itemCount');//购物车商品总数量
	$data['order_ctime']=time();//提交时间
	
	$data['shopspay']=I('shopspay');//配送费用
	$data['paytype']=I('paytype');//配送费用
	$data['gid']=session('gid');//
	$data['ordersource']=session('source');//订单来源
	$data['uname']=session('username');//
	$data['orderstatus']=0;//
	
	$result =$Order->relation(true)->add($data);
   //生成订单后处理
   $ctime=date("Y-m-d h:i",$data['order_ctime']);
   
   	   //新增订单系统发邮件给管理员
	   $mailto=C('TO_EMAIL');
	   
	   $mailname=C('name');
	   $mailtitle="新订单提醒：您有订单需要处理";
	   $mailbody="
	   订单号：".$result."<br>
	   订单金额：".$data['orderprice']."<br>
	   下单时间：".$ctime."<br>
	   收货人：".$data['oman']."<br>
	   收货地址：".$data['oaddress']."<br>
	   收货人手机号：".$data['otel']."<br>
	   送货时间：".$data['order_dtime']."<br>
	   订单明细：<br><a href=''>查看详情</a><hr>
	  ";
	   think_send_mail($mailto,$mailname,$mailtitle,$mailbody,'');
	   //发邮件结束
 
   if ($result) {
	   if ($data['paytype']==1){ //货到付款
	
	
	$this->redirect('Cart/cartok','id='.$result);
	   } 
	   else {
	   if ($data['paytype']==2){//在线支付
	   
	   	
	   
	   $this->redirect('Cart/cartpay','id='.$result);
	  // $this->redirect(U('Cart/cartok2'));
	   }	   
	   }
	
	
	}
	
	
	}
//生成订单后处理结束


}