<?php
// 登录文件
//超级外卖:20140406
class PublicAction extends CommonAction {
    public function header(){
      
    $this->display();
   }
       public function head(){
      
    $this->display();
   }
       public function foot(){
	
	
    $this->display();
   }
   
   
          public function _mpty($name){
            //把所有城市的操作解析到city方法
            $this->display('Public:404');
        }
   
 	
Public function verify(){
   import('ORG.Util.Image');//本地用
   //import("@.ORG.Image");//去服务器用
    //Image::buildImageVerify();
	
	Image::buildImageVerify(5,1,png,50,26);
	
}

Public function checkverify(){
  if($_SESSION['verify'] != md5($_POST['param'])) {
   	echo '{
			"info":"请输入正确的验证码",
			"status":"n"
		 }'; 
}

else{	echo '{
			"info":"",
			"status":"y"
		 }'; }
}

 /**
 * 用户注册
 */  
     	public function register() {
	    
          if ($_SESSION['user_id']){
      $this->redirect(U('Member/index'));}

	   
		$this->display();
		}
		
		//注册验证

       public function doregister() {
	   C('TOKEN_ON',false);
	   
         			  session('username',null);
				      cookie('nickname',null);
					  cookie('userpic',null);
					  session('user_id',null);
	     $Member=D('Members');
		 $map['username']=$_POST['username'];
		 $map['userpass']=md5($_POST['userpass']);
		 $map['useremail']=$_POST['useremail'];
		 $map['create_time']=time();
		 $map['usergroup']=1;
		 $result = $Member->create($map);

	     if (!$result){
    // 如果创建失败 表示验证没有通过 输出错误提示信息
exit($Member->getError());
}else{
    // 验证通过 可以进行其他数据操作
	$Member->add($map);
			$con['username']=$map['username'];
		$useruid = $Member->where($con)->field('uid,userpass,nickname,username')->find();
		 //用户登录成功
				      session('username',$useruid["username"]);
				      cookie('nickname',$useruid["nickname"]);
					  session('user_id',$useruid["uid"]);
					  					   
				         $data = array(
    						'last_login_time' => time(),
    						'last_login_ip' => get_client_ip(),
    				);
    				M('Members')->where("uid=".$useruid["uid"])->save($data);
	$this->redirect(U('Member/index'));
}

	  

	   
		
		}		     


 /**
 * 用户名,邮箱重复验证
 */  

Public function checkuser(){
    $Member=M('Members');
	$data['username']=$_POST["param"];
	$reusername=$Member->where($data)->select();
	
  if(empty($reusername)) {
   
		 echo '{
			"info":"",
			"status":"y"
		 }'; 
}

else{		echo '{
			"info":"用户名已存在，请更换个试试",
			"status":"n"
		 }'; 
}

}
//邮箱重复验证
Public function checkemail(){


     $Member=M('Members');
	$data['useremail']=$_POST["param"];
	$reuseremail=$Member->where($data)->select();
	
  if(empty($reuseremail)) {
   
		 echo '{
			"info":"",
			"status":"y"
		 }'; 
}

else{		echo '{
			"info":"该邮箱已注册，请更换其他邮箱！",
			"status":"n"
		 }'; 
}
}





	  
	  
/**
 * 用户登录
 */  
     	public function login() {
		
	    if ($_SESSION['user_id']){
      $this->redirect(U('Member/index'));}
         $reurl =urlencode($_GET['reurl']);	
		 
		$this->assign('reurl',$reurl);
	   
		$this->display();
		}
		
		//验证用户名通过后跳转到源URL

       public function dologin() {
	              			  session('username',null);
				      cookie('nickname',null);
					  cookie('userpic',null);
					  session('user_id',null);
		 $Member=D('Members');     
		
		$username =	$_POST['username'];	
		$password =	$_POST['password'];	
        $reurl =	$_GET['reurl'];			
		
		if(!$username){$this->error('用户名不可以为空');} //判定用户名否为空
		if(!$password){$this->error('密码不可以为空');}//判定密码是否为空
		$con['username']=$username;
		$useruid = $Member->where($con)->field('uid,userpass,nickname,username,userstatus')->find();
		
        if($useruid['userstatus']==2){$this->error('禁止登录');}
		if(!$useruid){$this->error('用户不存在');}
		else {
		        if ($useruid["userpass"]!=md5($password)){$this->error('密码错误');}
				  else{

				       //用户登录成功
				      session('username',$useruid["username"]);
				      cookie('nickname',$useruid["nickname"]);
					  session('user_id',$useruid["uid"]);
					  					   
				         $data = array(
    						'last_login_time' => time(),
    						'last_login_ip' => get_client_ip(),
    				);
    				M('Members')->where("uid=".$useruid["uid"])->save($data);
    				//$this->success("登录验证成功！",$reurl);
					//header("location:U("M/index")");
					 header("location:".$reurl);
					   }
		      
		
		}
		

		}		

/**
 * 用户退出
 */  
	 public function logout(){
    	session_destroy();
		         
				      cookie('nickname',null);
					  cookie('userpic',null);
					  
    	$this->redirect("/index");
    }	
		
		
		
		
		
		
		
		
		
		

/**
 * 第三方数据登录
 */  

		
		
		
		
		
		
		
	


















 
}