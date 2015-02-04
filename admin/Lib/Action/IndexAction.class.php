<?php
// 超级外卖后台首页
class IndexAction extends CommonAction {
	
	public  function  index(){
		 $this->redirect('Config/index');
	}
	
	public function index1(){
	 $Config=M('Config');
	 $appi=$Config->where('name="appid"')->find();
	 $appk=$Config->where('name="appkey"')->find();

	 $appid=$appi['value'];
	 $appkey=$appk['value'];
	 $url= $_SERVER['HTTP_HOST'];
	 //$wlefe=file_get_contents("http://union.bijiadao.net/api.php?a=open&appid=".$appid."&appkey=".$appkey."&url=".$url);
	 
	 $wlefe= "";

	 $this->assign('wlefe',$wlefe);
	 $this->assign('url',$url);
	 $this->assign('appid',$appid);
	 $this->assign('appkey',$appkey);
	 //用户数
	 $utotal=M('Members')->count('uid');
	 //订单数
	 $ototal=M('Foodorder')->count('oid');
	 //今天订单数
	 $beginToday=mktime(0,0,0,date('m'),date('d'),date('Y'));

	 $endToday=mktime(0,0,0,date('m'),date('d')+1,date('Y'))-1;
	 $map['order_ctime'] = array(array('gt',$beginToday),array('lt',$endToday)) ;

	 $oidtoday=M('Foodorder')->where($map)->count('oid');
	 //今日订单总数
	 $paytoday=M('Foodorder')->where($map)->count('orderprice');

	 $this->assign('oidtoday',$oidtoday);
	 $this->assign('paytoday',$paytoday);
	 $this->assign('ototal',$ototal);
	 $this->assign('utotal',$utotal);

	 $this->display();


	}






}