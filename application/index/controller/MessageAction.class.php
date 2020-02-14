<?php
// 用户在线留言显示
//用户在线发布留言
class MessageAction extends CommonAction {
    public function index(){
	  $Message=M('Message');
	  	import('ORG.Util.Page');// 导入分页类
        $count      = $Message->count();// 查询满足要求的总记录数
        $Page       = new Page($count,10);// 实例化分页类 传入总记录数和每页显示的记录数
        $show       = $Page->show();// 分页显示输出
          // 进行分页数据查询 注意limit方法的参数要使用Page类的属性
        $mslist = $Message->limit($Page->firstRow.','.$Page->listRows)->order('msid desc')->select();
		//dump($plist);
        $this->assign('page',$show);// 赋值分页输出
		 
		 $tlist=list_to_tree($mslist, $pk='msid',$pid = 'pid',$child = '_child',$root=0);
		
		
	     $this->assign('mslist',$tlist);// 赋值分页输出
	
	
	    $this->display();
	}
	 public function save(){
	
	 $Message=D('Message');
	 $map['mcontent']=I('content');
	 $map['uid']=session('user_id');
	 $map['uname']=session('username');
	 $map['create_time']=time();
	 
	 $result = $Message->add($map);              
      if($result){
	  //$this->success('提交成功');
	  $this->redirect(U('Message/Index'));
	  }
	  else {$this->error('新增失败');}
	
	
	}
	
	
	
	
	
	
	
}