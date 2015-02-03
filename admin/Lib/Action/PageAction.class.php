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

  */ 
   
class PageAction extends CommonAction {
    	
 /*   */   
   
   
 
  public function index(){
  
    	 $pages=M('Pages');
	 import('ORG.Util.Page');// 导入分页类
        $count      = $pages->count();// 查询满足要求的总记录数
        $Page       = new Page($count,10);// 实例化分页类 传入总记录数和每页显示的记录数
        $show       = $Page->show();// 分页显示输出
          // 进行分页数据查询 注意limit方法的参数要使用Page类的属性
        $plist = $pages->limit($Page->firstRow.','.$Page->listRows)->order('pagid desc')->select();

        $this->assign('page',$show);// 赋值分页输出
	    $this->assign('list',$plist);
        $this->display();
	

   } 
   
    /*  //增加分类 */  

  public function add(){
  

$this->display();
   } 	
   
    /*  //增加分类 *****************************************************************************/  
   
     public function addsave(){
	 
	 $dir=$this->_post('pagedir');

     $acat = D('ArticleCat');
     $rs=$acat->isdir($dir);
     if (!$rs){$this->error('目录名已存在，请更换个试试');}

	 
	if (!$_FILES["pic"]["name"]){         //判定上传是还口　为空
	
	
		 $map['pagedir']=$this->_post('pagedir');
	 $map['page_fid']=$this->_post('page_fid');
	// $map['sort']=$this->_post('sort');
	 $map['page_title']=$this->_post('page_title');
	// $map['pic']=$info[0]["savepath"].$info[0]['savename'];
	 $map['page_content']=htmlspecialchars(stripslashes($_POST['content']));
     //$map['page_header']=htmlspecialchars(stripslashes($_POST['header'])); 
     //$map['page_footer']=htmlspecialchars(stripslashes($_POST['footer'])); 	 
     $map['create_time']=time();
	  $Pages =D('Pages');
      
	 	    $res =$Pages->create($map);
       
	           if (!$res){
    // 如果创建失败 表示验证没有通过 输出错误提示信息
	$this->error($Pages->getError()); 

    
          } else {// 验证通过 可以进行其他数据操作
	$result = $Pages->add($map);              
 if($result){$this->success('新增成功');//redirect(U(Articlecate/index));
             }else {//错误页面的默认跳转页面是返回前一页，通常不需要设置
                    $this->error('新增失败');}
                    } //*******************res判定结束
	   
}
	else
	{
	 
	   import('ORG.Net.UploadFile');	  
       $upload = new UploadFile();// 实例化上传类
       $upload->maxSize  = 2145728 ;// 设置附件上传大小
       $upload->allowExts  = array('jpg');// 设置附件上传类型
       $upload->savePath =  './uploads/aimg/';// 设置附件上传目录
       $upload->thumb = true;
       $upload->thumbMaxWidth = '100,320,640';
       $upload->thumbMaxHeight ='100,240,480';
       $upload->thumbPrefix='';
       $upload->thumbSuffix= 's,m,b';
       $upload->thumbType=0;
       $upload->autoSub=true;
       $upload->subType='date';
       if(!$upload->upload()) {// 上传错误提示错误信息
      $this->error($upload->getErrorMsg());
       }else {// 上传成功 获取上传文件信息
       $info =  $upload->getUploadFileInfo();
       }
	   
	 $Pages = D('Pages');
	 $map['pagedir']=$this->_post('pagedir');
	 $map['page_fid']=$this->_post('page_fid');
	// $map['sort']=$this->_post('sort');
	 $map['page_title']=$this->_post('page_title');
	 $map['pic']=$info[0]["savepath"].$info[0]['savename'];
	 $map['page_content']=htmlspecialchars(stripslashes($_POST['content']));
     //$map['page_header']=htmlspecialchars(stripslashes($_POST['header'])); 
     //$map['page_footer']=htmlspecialchars(stripslashes($_POST['footer'])); 	 
     $map['create_time']=time();
	 

	 	    $res =$Pages->create();
          if (!$res){
    // 如果创建失败 表示验证没有通过 输出错误提示信息
	$this->error($Pages->getError());     
          } else {// 验证通过 可以进行其他数据操作
	$result = $Pages->add($map);              
 if($result){$this->success('新增成功');//redirect(U(Articlecate/index));
             }else {//错误页面的默认跳转页面是返回前一页，通常不需要设置
                    $this->error('新增失败');}
                    } //*******************res判定结束
	
     }


 } 
   
   
     /*  //// ***************************************************************************修改分类**/  
   
     public function edit(){
	 $id=trim($this->_get('id'));
	
	 if(!$id){$this->error('id不可以为空');}
	$Pages=M('Pages');
	$item= $Pages->find($id); 

	$this->assign('item',$item);
	
    $this->display();
   }  
   
   
        /*  ////修改分类 *************************************************************************修改后保存数据****/  
  
       public function editsave(){
	
	 $id=$this->_post('pagid');
	 $data["pagid"] =$id;
	 $dir=$this->_post('pagedir');

     $acat = D('ArticleCat');
     $rs=$acat->isdir($dir);
     if (!$rs){$this->error('目录名已存在，请更换个试试');}

	 
	if (!$_FILES["pic"]["name"]){         //判定上传是还口　为空
	
	  $Pages =D('Pages');
	  $pageitem=$Pages->where($data)->find();
	  
	  if ($pageitem['pagedir']==$this->_post('pagedir')) {     
	       } else{
		   $map['pagedir']=$this->_post('pagedir');		   
		   }
	      
	  
		 
	 $map['page_fid']=$this->_post('page_fid');
	// $map['sort']=$this->_post('sort');
	 $map['page_title']=$this->_post('page_title');
	// $map['pic']=$info[0]["savepath"].$info[0]['savename'];
	 $map['page_content']=htmlspecialchars(stripslashes($_POST['content']));
     //$map['page_header']=htmlspecialchars(stripslashes($_POST['header'])); 
     //$map['page_footer']=htmlspecialchars(stripslashes($_POST['footer'])); 	 
     $map['create_time']=time();
	  
      
	 	    $res =$Pages->create($map);
       
	           if (!$res){
    // 如果创建失败 表示验证没有通过 输出错误提示信息
	$this->error($Pages->getError()); 

    
          } else {// 验证通过 可以进行其他数据操作
	$result = $Pages->where($data)->save($map);              
 if($result){$this->success('修改成功',U('Page/index'));//redirect(U(Articlecate/index));
             }else {//错误页面的默认跳转页面是返回前一页，通常不需要设置
                    $this->error('修改失败');}
                    } //*******************res判定结束
	   
}
	else
	{
	 
	   import('ORG.Net.UploadFile');	  
       $upload = new UploadFile();// 实例化上传类
       $upload->maxSize  = 2145728 ;// 设置附件上传大小
       $upload->allowExts  = array('jpg');// 设置附件上传类型
       $upload->savePath =  './uploads/aimg/';// 设置附件上传目录
       $upload->thumb = true;
       $upload->thumbMaxWidth = '100,320,640';
       $upload->thumbMaxHeight ='100,240,480';
       $upload->thumbPrefix='';
       $upload->thumbSuffix= 's,m,b';
       $upload->thumbType=0;
       $upload->autoSub=true;
       $upload->subType='date';
       if(!$upload->upload()) {// 上传错误提示错误信息
      $this->error($upload->getErrorMsg());
       }else {// 上传成功 获取上传文件信息
       $info =  $upload->getUploadFileInfo();
       }
	   
	 $Pages = D('Pages');
	 $pageitem=$Pages->where($data)->find();
	 if ($pageitem['pagedir']==$this->_post('pagedir')) {     
	       } else{
		   $map['pagedir']=$this->_post('pagedir');		   
		   }
	 
	 $map['page_fid']=$this->_post('page_fid');
	// $map['sort']=$this->_post('sort');
	 $map['page_title']=$this->_post('page_title');
	 $map['pic']=$info[0]["savepath"].$info[0]['savename'];
	 $map['page_content']=htmlspecialchars(stripslashes($_POST['content']));
     //$map['page_header']=htmlspecialchars(stripslashes($_POST['header'])); 
     //$map['page_footer']=htmlspecialchars(stripslashes($_POST['footer'])); 	 
     $map['create_time']=time();
	 

	 	    $res =$Pages->create($map);
          if (!$res){
    // 如果创建失败 表示验证没有通过 输出错误提示信息
	$this->error($Pages->getError());     
          } else {// 验证通过 可以进行其他数据操作
	$result = $Pages->where($data)->save($map);              
 if($result){$this->success('修改成功',U('Page/index'));//redirect(U(Articlecate/index));
             }else {//错误页面的默认跳转页面是返回前一页，通常不需要设置
                    $this->error('修改失败');}
                    } //*******************res判定结束
	
     }
	
	
	
	
	
	}
	
	
	
	
	
	
	

   
   
   
   
   
   
   
   
   
   
   
/*  //// *************************************************************************删除数据****/  
   
     public function delete(){
	$Pages=M('Pages');
	    $id=$this->_get('id');
		if (!$id){//判定是否为空
		$this->error('商品不可以为空');
		}
		else{
		
		$data['pagid']=$id;
		$result=$Pages->where($data)->delete();
		if($result){
    //设置成功后跳转页面的地址，默认的返回页面是$_SERVER['HTTP_REFERER']
   // $this->success('删除成功');
	$this->redirect(U('Page/index'));
} else {
    //错误页面的默认跳转页面是返回前一页，通常不需要设置
    $this->error('删除失败');
}}

   }   
   
   
   
   
   
   
   
   
   
   
   
   
   //导航显示
     public function updatetop(){
	 $Pages=M('Pages');
	    $id=trim($_GET['id']);
		if (!$id){//判定是否为空
		$this->error('商品不可以为空');
		}
		else{
		
		$map['pagid']=$id;
		$data['page_top']=1;
		$result=$Pages->where($map)->save($data); 
		
		if($result){
    //设置成功后跳转页面的地址，默认的返回页面是$_SERVER['HTTP_REFERER']
   // $this->success('删除成功');
	$this->redirect(U('Page/index'));
} else {
    //错误页面的默认跳转页面是返回前一页，通常不需要设置
    $this->error('推荐失败');
}}
   } 

   
  //撤销首页推荐
     public function deletetop(){
	  $Pages=M('Pages');
	    $id=trim($_GET['id']);
		if (!$id){//判定是否为空
		$this->error('商品不可以为空');
		}
		else{
		
		$map['pagid']=$id;
		$data['page_top']=0;
		$result=$Pages->where($map)->save($data); 
		
		if($result){
    //设置成功后跳转页面的地址，默认的返回页面是$_SERVER['HTTP_REFERER']
   // $this->success('删除成功');
	$this->redirect(U('Page/index'));
} else {
    //错误页面的默认跳转页面是返回前一页，通常不需要设置
    $this->error('撤销导航失败');
}}
   }  
  



   
   
   
   
  
   
   
   
   
   
   
   
   
   
}