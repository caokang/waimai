<?php
// 留言管理
/* 留言删除
*留言回复
*
*
*
*
*
*/ 
   
class MessageAction extends CommonAction {
    	
   
 /*   */   
   
   
 
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
		 
		 $tslist=list_to_tree($mslist, $pk='msid',$pid = 'pid',$child = '_child',$root=0);
		
		
	     $this->assign('mslist',$tslist);// 赋值分页输出
	
	
	    $this->display();
   
   } 
   
 
   
  


//留言删除
   
     public function delete(){
	   $Message=M('Message');
	    $id=trim($_GET['id']);
		if (!$id){//判定是否为空
		$this->error('商品不可以为空');
		}
		else{
		
		$data['msid']=$id;
		$result=$Message->where($data)->delete(); 
		
		if($result){
    //设置成功后跳转页面的地址252，默认的返回页面是$_SERVER['HTTP_REFERER']
  $this->success('删除成功');
	
} else {
    //错误页面的默认跳转页面是返回前一页，通常不需要设置
    $this->error('删除失败');
}}
   }   


//留言回复1252
 public function add(){
    $id=I('id');
 $Message=M('Message');
 $mitem=$Message->where('msid='.$id)->find();

 $this->assign('mitem',$mitem);
 $this->display();
 }

 public function save(){
    $data['uid']=I('uid');
	$data['pid']=I('pid');
	$data['mcontent']=I('content');
    $Message=M('Message');
    $Message->add($data);
 header("location:".$_SERVER["HTTP_REFERER"]);
 }




  
 
  
}