<?php
// 本类由系统自动生成，仅供测试用途
class LinkAction extends CommonAction {






    public function index(){
     $Link=M('Link');
	 $configitem=$Link->where('type=0')->select();
	 //dump($configitem);
    

     $this->assign('linklist',$configitem);
     $this->display();

	}
	
	public function add(){
   
     $this->display();

	}
	
	    public function addsave(){
     $Link=M('Link');
	 $map['linkname']=$this->_post('linkname');
	 $map['link']=$this->_post('link');
     $map['create_time']=time();
	
	 
	 
	 $result =$Link->add($map); 
	 
	 if($result){$this->success('更新成功');//redirect(U(Articlecate/index));
             }else {//错误页面的默认跳转页面是返回前一页，通常不需要设置
                    $this->error('更新失败');}
                   
    




	}
	
	
	
	
	
	
	    public function aindex(){
     $Link=M('Link');
	 $configitem=$Link->where('type=1')->select();
	 //dump($configitem);
    

     $this->assign('linklist',$configitem);
     $this->display();

	}
	
	
		    public function aadd(){

     $this->display();

	}
	
	
	
	
	
	    public function aaddsave(){


	 
	 
	 
	 $upload = new UploadFile();// 实例化上传类
$upload->maxSize  = 3145728 ;// 设置附件上传大小
$upload->allowExts  = array('jpg','gif','png');// 设置附件上传类型
$upload->savePath =  './uploads/aimg/';// 设置附件上传目录
$upload->thumb = true;
$upload->thumbMaxWidth = '100';
$upload->thumbMaxHeight ='100';
$upload->thumbPrefix='';
$upload->thumbSuffix= 's';
//$upload->thumbType=0;
//$upload->autoSub=true;
//$upload->subType='date';
$upload->saveRule='';
$upload->uploadReplace=true;
if(!$upload->upload()) {// 上传错误提示错误信息
$this->error($upload->getErrorMsg());
}else {// 上传成功 获取上传文件信息
$info =  $upload->getUploadFileInfo();
}
	 
	  $Link=M('Link');
	 $map['linkname']=$this->_post('linkname');
	 $map['link']=$this->_post('link');
     $map['create_time']=time();
	  $map['type']=1;
	$map['linkpic']=$info[0]["savepath"].$info[0]['savename'];
	 
	 
	 $result =$Link->add($map); 
	 
	 if($result){$this->success('更新成功');//redirect(U(Articlecate/index));
             }else {//错误页面的默认跳转页面是返回前一页，通常不需要设置
                    $this->error('更新失败');}
                   
      
	 
	
 		
					
					


	}
	
	
	public function delete(){
	 $Link=M('Link');
	    $id=trim($_GET['id']);
		if (!$id){//判定是否为空
		$this->error('商品不可以为空');
		}
		else{
		
		$data['lid']=$id;
		$result=$Link->where($data)->delete(); 
		
		if($result){
    //设置成功后跳转页面的地址，默认的返回页面是$_SERVER['HTTP_REFERER']
   $this->success('删除成功');
	//$this->redirect(U('Product/index'));
} else {
    //错误页面的默认跳转页面是返回前一页，通常不需要设置
    $this->error('删除失败');
}}
   }    
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	

	
	
	
	
	
}