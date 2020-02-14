<?php
// 产品分类显示，增加，修改，删除
/*  

   import("@.ORG.Category");
$cat = new Category('Category', array('cid', 'fid', 'name', 'fullname'));
$s = $cat->getList();               //获取分类结构
$s = $cat->getList('', 1);          //获取fid=1的子分类结构
$s = $cat->getList($condition, 1);  //$condition为查询条件，获取fid=1的子分类结构
$s = $cat->getPath(3);              //获取分类id=3的路径
$data = array("fid" => 0, "name" => "新分类名称");
$s = $cat->add($data);              //添加分类，$data需要包含上级分类fid
$data = array("cid" => 2, "name" => "修改后分类名称");
$s = $cat->edit($data);             //修改分类,$data需要包含分类ID
$s = $cat->del(10);                 //删除分类id=10的分类
	  //*******************自动验证模板/  
	  $res =$acat->create();
          if (!$res){$this->error($acat->getError());    
             } else {
			       $result = $acat->add($map);              
                   if($result){$this->success('新增成功');}
				  else {$this->error('新增失败');}
                  }
     //*******************自动验证模板结束/  	

  */ 
   
class ArticleAction extends CommonAction {
    	
 /*   */   
   
   
 
  public function index(){
  

	 $Article=M('Article');
	 import('ORG.Util.Page');// 导入分页类
        $count      = $Article->count();// 查询满足要求的总记录数
        $Page       = new Page($count,10);// 实例化分页类 传入总记录数和每页显示的记录数
        $show       = $Page->show();// 分页显示输出
          // 进行分页数据查询 注意limit方法的参数要使用Page类的属性
        $plist = $Article->limit($Page->firstRow.','.$Page->listRows)->order('aid desc')->select();
        $this->assign('page',$show);// 赋值分页输出
	    $this->assign('alist',$plist);
        $this->display();
     
   } 
   //分类显示
     public function alist(){
  
     $map['acid']=$this->_get('id');
	 $Article=M('Article');
	 import('ORG.Util.Page');// 导入分页类
        $count      = $Article->where($map)->count();// 查询满足要求的总记录数
        $Page       = new Page($count,10);// 实例化分页类 传入总记录数和每页显示的记录数
        $show       = $Page->show();// 分页显示输出
          // 进行分页数据查询 注意limit方法的参数要使用Page类的属性
        $plist = $Article->where($map)->limit($Page->firstRow.','.$Page->listRows)->order('aid desc')->select();
        $this->assign('page',$show);// 赋值分页输出
	    $this->assign('alist',$plist);
        $this->display();
     
   } 
   
   
   
   
   
   
    /**
     * 文章　增加页面
     * 
	 * 
	 * 
	 * 
     */
   
     public function add(){
           import("ORG.Util.Category");
      $cat = new Category('Article_cat', array('acid', 'afid', 'aname', 'cname'));
      $clist= $cat->getList();               //获取分类结构
	 $this->assign('clist',$clist);
	 $this->display();
   } 
   
   
   
   
   
   
     public function addsave(){
		
	
	  $Article=D('Article');
	 $map['acid']=I('acid');
	 $map['atitle']=I('atitle');
	
	 $map['create_time']=time();

	 $map['alink']=I('alink');
	 
	
	  $map['content']=htmlspecialchars(stripslashes($_POST['content'])); 
	  //*******************自动验证模板/  
	  $res =$Article->create($map);
          if (!$res){$this->error($Article->getError());    
             } else {
			       $result = $Article->add($map);              
                   if($result){$this->success('新增成功');}
				  else {$this->error('新增失败');}
                  }
     //*******************自动验证模板结束/  
	  
	  
	  

	  
		  
   } 
   
 
    //*******************修改开始**************/  
     public function edit(){
	 $id=$this->_get('id');
	$Article=M('Article');
	$item= $Article->find($id); 
	//dump($item);
	
	 import("ORG.Util.Category");
      $cat = new Category('Article_cat', array('acid', 'afid', 'aname', 'cname'));
      $clist= $cat->getList();               //获取分类结构
	 $this->assign('clist',$clist);

	$this->assign('item',$item);
	 
    $this->display();
   }  
   
   
   
  
       public function editsave(){
	   $id=I('aid');
	   if(!$id){$this->error('文章id不可以为空');}//判定ＩＤ是否为空
	   $data["aid"] =$id;
	   
	     	$Article=D('Article');
	        $map['acid']=I('acid');
	        $map['atitle']=I('atitle');
	        $map['create_time']=time();
			$map['sort']=I('sort');
				 $mallid=I('mallid');
	 
	        $map['content']=htmlspecialchars(stripslashes($_POST['content'])); 
	      //*******************自动验证模板/  
	       $res =$Article->create();
            if (!$res){$this->error($Article->getError());    
               } else {
		 	       $result = $Article->where($data)->save($map);               
                    if($result){$this->success('修改成功',U('Article/index'));}
		  		   else {$this->error('新增失败');}
                   }
     //*******************自动验证模板结束/  
	   
	  

   }  
   
   
   
   
   
   
     //*******************修改结束**************/     
     //*******************删除开始**************/  
   
     public function delete(){
	$Article=M('Article');
	    $id=$this->_get('id');
		if (!$id){//判定是否为空
		$this->error('商品不可以为空');
		}
		else{
		
		$data['aid']=$id;
		$result=$Article->where($data)->delete();
		if($result){
    //设置成功后跳转页面的地址，默认的返回页面是$_SERVER['HTTP_REFERER']
   // $this->success('删除成功');
	$this->redirect(U('Article/index'));
} else {
    //错误页面的默认跳转页面是返回前一页，通常不需要设置
    $this->error('删除失败');
}}

   }   
  
  
  
     //*******************修改结束**************/     
     //*******************推荐开始**************/  
     public function updatetop(){
	 	$Article=M('Article');
	    $id=$this->_get('id');

		if (!$id){//判定是否为空
		$this->error('文章id不可以为空');
		}
		else{
		
		$map['aid']=$id;
		$data['top']=1;
		$result=$Article->where($map)->save($data); 
		
		if($result){
   // $this->success('删除成功');
	$this->redirect(U('Article/index'));
} else {
    //错误页面的默认跳转页面是返回前一页，通常不需要设置
    $this->error('推荐失败');
}}
   } 

   
  //撤销首页推荐
     public function deletetop(){
	 	$Article=M('Article');
	    $id=$this->_get('id');

		if (!$id){//判定是否为空
		$this->error('文章id不可以为空');
		}
		else{
		
		$map['aid']=$id;
		$data['top']=0;
		$result=$Article->where($map)->save($data); 
		
		if($result){
   // $this->success('删除成功');
	$this->redirect(U('Article/index'));
} else {
    //错误页面的默认跳转页面是返回前一页，通常不需要设置
    $this->error('推荐失败');
}}
   }  



   
   
   
   
  
   
   
   
   
   
   
   
   
   
}