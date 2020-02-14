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
   
class ArticlecateAction extends CommonAction {

   
 /*   */   
   
   
 
  public function index(){
  $cat = new Category('Article_cat', array('acid', 'afid', 'aname', 'cname'));
$clist= $cat->getList();              //获取分类结构


$this->assign('clist',$clist);
	
$this->display();
   } 
   
    /*  //增加分类 */  

  public function add(){
  $cat = new Category('Article_cat', array('acid', 'afid', 'aname', 'cname'));
$clist= $cat->getList();              //获取分类结构


$this->assign('clist',$clist);

$this->display();
   } 	
   
    /*  //增加分类 *****************************************************************************/  
   
     public function addsave(){
	 
	 $dir=$this->_post('dir');

 $acat = D('ArticleCat');
 $rs=$acat->isdir($dir);
 if (!$rs){$this->error('分类目录名已存在，请更换个试试');}
	 
	 
	if (!$_FILES["pic"]["name"]){         //判定上传是还口　为空
	
	 $acat = D('ArticleCat');
	 $map['dir']=$this->_post('dir');
	 
	 $map['afid']=$this->_post('afid');
	 $map['sort']=$this->_post('sort');
	 $map['aname']=$this->_post('aname');
	 //$map['apic']=$info[0]["savepath"].$info[0]['savename'];
     $map['acreate_time']=time();
	 
       // dump($map);
	    $res =$acat->create();
          if (!$res){
    // 如果创建失败 表示验证没有通过 输出错误提示信息
	$this->error($acat->getError());     
          } else {// 验证通过 可以进行其他数据操作
	$result = $acat->add($map);              
 if($result){$this->success('新增成功');//redirect(U(Articlecate/index));
             }else {//错误页面的默认跳转页面是返回前一页，通常不需要设置
                    $this->error('新增失败');}
                    } //*******************res判定结束
}
	else
	{
	 
	 
	 
	 $upload = new UploadFile();// 实例化上传类
$upload->maxSize  = 3145728 ;// 设置附件上传大小
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
	 
	 $acat = D('ArticleCat');
	 $map['dir']=$this->_post('dir');
	 $map['afid']=$this->_post('afid');
	 $map['sort']=$this->_post('sort');
	 $map['aname']=$this->_post('aname');
	 $map['apic']=$info[0]["savepath"].$info[0]['savename'];
     $map['acreate_time']=time();
	 

	 	    $res =$acat->create();
          if (!$res){
    // 如果创建失败 表示验证没有通过 输出错误提示信息
	$this->error($acat->getError());     
          } else {// 验证通过 可以进行其他数据操作
	$result = $acat->add($map);              
 if($result){$this->success('新增成功');//redirect(U(Articlecate/index));
             }else {//错误页面的默认跳转页面是返回前一页，通常不需要设置
                    $this->error('新增失败');}
                    } //*******************res判定结束
	
     }


 } 
   
   
     /*  //// ***************************************************************************修改分类**/  
   
     public function edit(){
	 $id=trim($this->_get('id'));
	   $cat = new Category('Article_cat', array('acid', 'afid', 'aname', 'cname'));
$clist= $cat->getList();              //获取分类结构


$this->assign('clist',$clist);
	
	 if(!$id){$this->error('id不可以为空');}
	$Acat=M('Article_cat');
	$item= $Acat->find($id); 

	$this->assign('item',$item);
	
    $this->display();
   }  
   
   
        /*  ////修改分类 *************************************************************************修改后保存数据****/  
  
       public function editsave(){
	
	 $id=$this->_post('acid');
	 $data["acid"] =$id;
	  //***************/判定目录是否已存/*******************/ 
$dir=$this->_post('dir');
 $acat = D('ArticleCat');
 $rs=$acat->ismdir($dir);
 if (!$rs){$this->error('分类目录名已存在，请更换个试试');}
	//***************/判定目录结束/*******************/ 
	
	 
	if (!$_FILES["pic"]["name"]){ 
	
	$acat = D('ArticleCat');
	 $map['dir']=$this->_post('dir');
	 $map['afid']=$this->_post('afid');
	 $map['sort']=$this->_post('sort');
	 $map['aname']=$this->_post('aname');
	 //$map['apic']=$info[0]["savepath"].$info[0]['savename'];
     $map['acreate_time']=time();
	 

	   $res =$acat->create();
          if (!$res){
    // 如果创建失败 表示验证没有通过 输出错误提示信息
	$this->error($acat->getError());     
          } else {// 验证通过 可以进行其他数据操作
	$result = $acat->where($data)->save($map);              
 if($result){$this->success('修改成功');//redirect(U(Articlecate/index));
             }else {//错误页面的默认跳转页面是返回前一页，通常不需要设置
                    $this->error('修改失败');}
                    } //*******************res判定结束
	

	
  
	
	}
	else
	{
	 
	 
	 
	 $upload = new UploadFile();// 实例化上传类
$upload->maxSize  = 3145728 ;// 设置附件上传大小
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
}else{// 上传成功 获取上传文件信息
$info =  $upload->getUploadFileInfo();
}
	 
	$acat = D('ArticleCat');
	 $map['dir']=$this->_post('dir');
	 $map['afid']=$this->_post('afid');
	 $map['sort']=$this->_post('sort');
	 $map['aname']=$this->_post('aname');
	 $map['apic']=$info[0]["savepath"].$info[0]['savename'];
     $map['acreate_time']=time();
	 

	 
	
    $res =$acat->create();
          if (!$res){
    // 如果创建失败 表示验证没有通过 输出错误提示信息
	$this->error($acat->getError());     
          } else {// 验证通过 可以进行其他数据操作
	$result = $acat->where($data)->save($map);              
 if($result){$this->success('修改成功');//redirect(U(Articlecate/index));
             }else {//错误页面的默认跳转页面是返回前一页，通常不需要设置
                    $this->error('修改失败');}
                    } //*******************res判定结束
	
	
	
	
	
	
	}
	
	
	
	
	
	
	
	
	
   }  
   
   
   
   
   
   
   
   
   
   
   
/*  //// *************************************************************************删除数据****/  
   
     public function delete(){
	 $acat = new Category('Article_cat', array('acid', 'afid', 'aname', 'cname'));
	    $id=trim($this->_get('id'));
	$result=$acat->del($id); 
		if($result){
    //设置成功后跳转页面的地址，默认的返回页面是$_SERVER['HTTP_REFERER']
   // $this->success('删除成功');
	$this->redirect(U('Articlecate/index'));
} else {
    //错误页面的默认跳转页面是返回前一页，通常不需要设置
    $this->error('删除失败');
}

	

   }   
  


 
   //导航显示
     public function updatetop(){
	 $Articlecat=M('Article_cat');
	    $id=trim($_GET['id']);
		if (!$id){//判定是否为空
		$this->error('商品不可以为空');
		}
		else{
		
		$map['acid']=$id;
		$data['atop']=1;
		$result=$Articlecat->where($map)->save($data); 
		
		if($result){
    //设置成功后跳转页面的地址，默认的返回页面是$_SERVER['HTTP_REFERER']
   // $this->success('删除成功');
	$this->redirect(U('Articlecate/index'));
} else {
    //错误页面的默认跳转页面是返回前一页，通常不需要设置
    $this->error('推荐失败');
}}
   } 

   
  //撤销首页推荐
     public function deletetop(){
	  $Articlecat=M('Article_cat');
	    $id=trim($_GET['id']);
		if (!$id){//判定是否为空
		$this->error('商品不可以为空');
		}
		else{
		
		$map['acid']=$id;
		$data['atop']=0;
		$result=$Articlecat->where($map)->save($data); 
		
		if($result){
    //设置成功后跳转页面的地址，默认的返回页面是$_SERVER['HTTP_REFERER']
   // $this->success('删除成功');
	$this->redirect(U('Articlecate/index'));
} else {
    //错误页面的默认跳转页面是返回前一页，通常不需要设置
    $this->error('撤销推荐失败');
}}
   }  
  
   
   
   
   
  
   
   
   
   
   
   
   
   
   
}