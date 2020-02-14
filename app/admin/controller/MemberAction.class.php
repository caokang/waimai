<?php
// 产品分类显示，增加，修改，删除

   
class MemberAction extends CommonAction {

   

   
 
 
   //所有用户
       public function index() {
	$Members = M('Members');
	
	 import('ORG.Util.Page');// 导入分页类
        $count      = $Members->where('userstatus = 0')->count();// 查询满足要求的总记录数
        $Page       = new Page($count,20);// 实例化分页类 传入总记录数和每页显示的记录数
        $show       = $Page->show();// 分页显示输出
          // 进行分页数据查询 注意limit方法的参数要使用Page类的属性
        $userlist= $Members->where('userstatus = 0')->limit($Page->firstRow.','.$Page->listRows)->order('uid desc')->select();
		$this->assign('page',$show);// 赋值分页输出
		
		$this->assign('userlist',$userlist);
        $this->display();
    }
   
   
   //用户查询
   
    public function indexs() {
	 $da=I('id');
	$Members = M('Members');
	//$map['username'] = array('like','%'.$da.'%');
	//$map['gid'] = array('like','%'.$da.'%');
	//$map['usertel'] = array('like','%'.$da.'%');
    $map['_string'] = ' (username like "%'.$da.'%") OR (usertel like "%'.$da.'%")OR (gid like "%'.$da.'%")' ;
	
	$map['userstatus'] = 0;
    
	 import('ORG.Util.Page');// 导入分页类
        $count      = $Members->where($map)->count();// 查询满足要求的总记录数
        $Page       = new Page($count,20);// 实例化分页类 传入总记录数和每页显示的记录数
        $show       = $Page->show();// 分页显示输出
          // 进行分页数据查询 注意limit方法的参数要使用Page类的属性
        $userlist= $Members->where($map)->limit($Page->firstRow.','.$Page->listRows)->select();
		
		$this->assign('page',$show);// 赋值分页输出
		
		$this->assign('userlist',$userlist);
        $this->display();
    }
	
	
	   //所有用户
       public function indexw() {
	$Members = M('Members');
	
	 import('ORG.Util.Page');// 导入分页类
        $count      = $Members->where('userstatus = 2')->count();// 查询满足要求的总记录数
        $Page       = new Page($count,20);// 实例化分页类 传入总记录数和每页显示的记录数
        $show       = $Page->show();// 分页显示输出
          // 进行分页数据查询 注意limit方法的参数要使用Page类的属性
        $userlist= $Members->where('userstatus = 2')->limit($Page->firstRow.','.$Page->listRows)->order('uid desc')->select();
		$this->assign('page',$show);// 赋值分页输出
		
		$this->assign('userlist',$userlist);
        $this->display();
    }
	
	
	
	
	//用户详情查看
	
	
	public function udetail() {
	 $da=I('id');
	$Members = M('Members');
    $uitem=$Members->find($da);

		
		$this->assign('uitem',$uitem);
        $this->display();
    }
	
	
	
	//用户加入黑名单
	
	
	public function undelete() {
	 $da['uid']=I('id');
	$Members = M('Members');
   

		$map["userstatus"]=2;
	$Member=M('Members');
	$result= $Member->where($da)->save($map);  
    		if($result){
    //设置成功后跳转页面的地址，默认的返回页面是$_SERVER['HTTP_REFERER']
  $this->success('操作成功');
	
} else {
    //错误页面的默认跳转页面是返回前一页，通常不需要设置
    $this->error('修改失败');
}
    }
	
	
	
	//用户取消黑名单
	
	
	public function undel() {
	 $da['uid']=I('id');
	$Members = M('Members');
   

		$map["userstatus"]=0;
	$Member=M('Members');
	$result= $Member->where($da)->save($map);  
    		if($result){
    //设置成功后跳转页面的地址，默认的返回页面是$_SERVER['HTTP_REFERER']
  $this->success('操作成功');
	
} else {
    //错误页面的默认跳转页面是返回前一页，通常不需要设置
    $this->error('修改失败');
}
    }
	
	
	
	
		public function delete() {
	 $da['uid']=I('id');

   

	$Member=M('Members');
	$result= $Member->where($da)->delete();  
    		if($result){
    //设置成功后跳转页面的地址，默认的返回页面是$_SERVER['HTTP_REFERER']
  $this->success('操作成功');
	
} else {
    //错误页面的默认跳转页面是返回前一页，通常不需要设置
    $this->error('修改失败');
}
    }
	
	
	
	
	
	
	
	
	


   
   //管理员*************************************************************************************************管理员******
	
	
	 public function adminindex(){
    //获取分类结构
      $Member=M('Members');
      $adminlist=$Member->where('usergroup=99')->select();
     
      $this->assign('adminlist',$adminlist);
	
      $this->display();
   } 
	
	
	
	
	  public function admindelete(){
	 $Member=M('Members');
	    $id=trim($_GET['id']);
	$result=$Member->delete($id); 
		if($result){
    //设置成功后跳转页面的地址，默认的返回页面是$_SERVER['HTTP_REFERER']
   // $this->success('删除成功');
	$this->redirect(U('Member/adminindex'));
} else {
    //错误页面的默认跳转页面是返回前一页，通常不需要设置
    $this->error('删除失败');
}

	
	}
   
   
   
   public function adminadd(){
   
   
   $this->display();
   }
   
   
   
   
   
   
   public function adminaddsave(){
	    
	
	$map["username"] =trim($_POST['username']); 
	if (!$map["username"]){ $this->error('用户名不可以为空');}
	$map["userpass"]=md5(trim($_POST['password']));
	$repassword=md5(trim($_POST['repassword']));
	if (!$map["userpass"]){ $this->error('密码不可为空');}
	if($map["userpass"]!=$repassword){$this->error('二次输入的密码不一样');}
	$map["create_time"]=time();
	$map["usergroup"]=99;
	
	$Member=M('Members');
	$result= $Member->add($map);  
    		if($result){
    //设置成功后跳转页面的地址，默认的返回页面是$_SERVER['HTTP_REFERER']
   // $this->success('删除成功');
	$this->redirect(U('Member/adminindex'));
} else {
    //错误页面的默认跳转页面是返回前一页，通常不需要设置
    $this->error('修改失败');
}

   }    
   
   
   
   
   
   
   
   
   
   
   
 public function adminedit(){ 
   $id=trim($_GET['id']);
	$Member=M('Members');
	$item= $Member->find($id); 
	//dump($item);
	$this->assign('item',$item);
	
    $this->display();
	}
   
   
   public function admineditsave(){
	    
	$data["uid"] =trim($_POST['uid']); 
	$map["username"] =trim($_POST['username']); 
	if (!$map["username"]){ $this->error('用户名不可以为空');}
	$map["userpass"]=md5(trim($_POST['password']));
	$repassword=md5(trim($_POST['repassword']));
	if (!$map["userpass"]){ $this->error('密码不可为空');}
	if($map["userpass"]!=$repassword){$this->error('二次输入的密码不一样');}
	$map["create_time"]=time();
	$map["usergroup"]=99;
	$Member=M('Members');
	$result= $Member->where($data)->save($map);  
    		if($result){
    //设置成功后跳转页面的地址，默认的返回页面是$_SERVER['HTTP_REFERER']
   // $this->success('删除成功');
	$this->redirect(U('Member/adminindex'));
} else {
    //错误页面的默认跳转页面是返回前一页，通常不需要设置
    $this->error('修改失败');
}

   }   
    
   
   
   
   
   
}