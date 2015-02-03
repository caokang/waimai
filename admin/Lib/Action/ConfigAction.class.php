<?php
	 /**
     * 系统配置
     * 文道20140403
	 *QQ87297326
     */
class ConfigAction extends CommonAction {




  public function index(){
    $cate=$_GET['id'];
	if(!$cate){$cate=0;}
    $Config=M('Config');
	$data=$Config->where('cate='.$cate)->select();//取状态为0的配置，为1为不显示 cate0为基本设置，1为支付设置，2登录设置,3店铺设置,4积分设置
	
        if($data && is_array($data)){
            foreach ($data as $k=>$value) {
			$datas[$k]['title']=$value['title'];
			  $datas[$k]['name']=$value['name'];
			  $datas[$k]['type']=$value['type'];
			  $datas[$k]['remark']=$value['remark'];
			 
			  $datas[$k]['status']=$value['status'];
			  if ($value['type']==3||$value['type']==4){
			  $datas[$k]['extra']=$this->parse( $value['extra']);
			  }
              if ($value['type']==6){
			  $datas[$k]['value']=explode( ',',$value['value']);
			  }
			  else{ $datas[$k]['value']=$value['value'];}
            }			
        }
	//	dump($datas);
     $this->assign('citem',$datas);
	 $this->assign('cate',$cate);
	 $this->assign('data',$data);
     $this->display('index'.$cate);
	}
	
private function parse($value){       
            $array = preg_split('/[,;\r\n]+/', trim($value, ",;\r\n"));
                if(strpos($value,':')){
                    $value  = array();
                    foreach ($array as $val) {
                        list($k, $v) = explode(':', $val);
                        $value[$k]   = $v;
                    }
                }else{
                    $value =    $array;
                }
               
        
        return $value;
    }
	

	
	 /**
     * 批量保存配置
     * 
     */
	    public function add(){

		$cate=I('cate');
       if ($cate==0){//网站基本设置
	   if (!$_FILES["pic"]["name"]){         //判定上传是还口　为空
	
	
     $Config =M('Config');
     
	 $map['title']=$this->_post('title');	 
	 $map['name']=$this->_post('name');
	 $map['key']=$this->_post('key');
	 $map['des']=I('des');
	 $map['url']=$this->_post('url');
	 $map['tj']=$this->_post('tj');
      $map['beian']=$this->_post('beian');
	  	 $map['isorder']=$this->_post('isorder');
	 $map['islogin']=$this->_post('islogin');

	  foreach ($map as $name => $value) {
                $data = array('name' => $name);
                $Config->where($data)->setField('value', $value);
            }
		  $this->success('操作成功');	
		 unset($map);
}
	else
	{
	
	 $upload = new UploadFile();// 实例化上传类
$upload->maxSize  = 3145728 ;// 设置附件上传大小
$upload->allowExts  = array('jpg','gif','png');// 设置附件上传类型
$upload->savePath =  './uploads/logo/';// 设置附件上传目录
$upload->saveRule='';
$upload->uploadReplace=true;
if(!$upload->upload()) {// 上传错误提示错误信息
$this->error($upload->getErrorMsg());
}else {// 上传成功 获取上传文件信息
$info =  $upload->getUploadFileInfo();
}
	 $Config=M('Config');

	 $map['title']=$this->_post('title');	 
	 $map['name']=$this->_post('name');
	 $map['key']=$this->_post('key');
	 $map['des']=$this->_post('des');
	 $map['url']=$this->_post('url');
	 $map['tj']=$this->_post('tj');
	 $map['beian']=$this->_post('beian');
	 $map['isorder']=$this->_post('isorder');
	 $map['islogin']=$this->_post('islogin');

      $map['logo']='/uploads/logo/'.$info[0]['savename'];
	  
	  	 
	  foreach ($map as $name => $value) {
                $data = array('name' => $name);
                $Config->where($data)->setField('value', $value);
            }
	  $this->success('操作成功');	
	  unset($map);
     }				
	
	   }//基本设置处理
	   else{
	   
	   //支付设置处理                      /*pay*/	
   
	   if ($cate==1){
	   
	   	        $Config=M('Config');
	/*alipay*/			
	$pos['status']=I('posvalue');
	$posdata['name']='pos';
    if($pos['status']){	
		
	$Config->where($posdata)->save($pos); 		
	}else{$poss['status']=0;$Config->where($posdata)->save($poss);}
/*pos*/	
/*alipay*/
	
    
	if ($maps['status']) {
	$Config->where($alidata)->save($maps); 
	
	} else {
	$maps['status']=0;
	$Config->where($alidata)->save($maps); 
	}	
	
/*alipay*/
/*qq*/
	 
	 if ($tenmap['status']) {
	$Config->where($tendata)->save($tenmap); 
	
	} else {
	$tenmap['status']=0;
	$Config->where($tendata)->save($tenmap); 
	
	}	
/*qq*/	 

			
	
	 $this->success('操作成功');	
	  unset($map); 
	   
	   
	   
	   
	   
	   
	   }//支付设置处理结束
	   else {
	   //处理登录
	   
	   if($cate==2){
	   $Config=M('Config');
	   $dataa=$Config->field('name')->where('cate=2')->select();
		  foreach ($dataa as $k=>$value) {
		
      }//循环结束	          
		$this->success('操作成功'); 
		 
		 
		 
		 
	   }//处理登录
	   else{
	   //积分处理开始
	   if($cate==4){
	    $Config=M('Config');
	   $data['points']=I('points');
       foreach ($data as $name => $value) {
                $data = array('name' => $name);
                $Config->where($data)->setField('value', $value);
            }
	    $this->success('操作成功');	   
	   }//积分设置结束
	   
	   else{
	    if ($cate==3){
	        $Config=M('Config');

	 $data['address']=I('address');	 
	 $data['tel']=I('tel');	
	 $data['startpay']=I('startpay');	
	 $data['pspay']=I('pspay');	
	 $data['notice']=I('notice');	
     $data['psarea']=I('psarea');	
	  $opentime=I('opentime');
      $endtime=I('endtime');
     $data['opentime']= $opentime.','. $endtime;	  
		
	         foreach ($data as $name => $value) {
                $data = array('name' => $name);
                $Config->where($data)->setField('value', $value);
            }
	     $this->success('操作成功');	
	  	 }
		 
		
	 else {
	  $Config=M('Config');
         $var= $Config->where('type=1')->select();
		 foreach ($var as $value) {
		 $d =I($value['name']);
		 if($d){$data[$value['name']]=$d;}
		 }
		 // dump($data);
	 	  
		
	         foreach ($data as $name => $value) {
                $data = array('name' => $name);
                $Config->where($data)->setField('value', $value);
            }
	     $this->success('操作成功');	
	   
	   }
	   }
	   }//登录处理结束  
	   }//支付设置处理结束              /*pay*/	
	  
	   
	   
	 
	   
	   }	
  
     }


		
	   public function copyright(){
	    $Config=M('Config');
		
	   $appid=$Config->where('name="appid"')->find();
	   $appkey=$Config->where('name="appkey"')->find();
	   $this->assign('appid',$appid['value']);
	   $this->assign('appkey',$appkey['value']);
	    $this->display();
	   
	   
	   
	   }
	 
	  public function copyrightadd(){
	   
	   $appid=I('appid');	
	  
	   $appkey=I('appkey');	
	   
	     $Config=M('Config');
	    $Config->where('name="appid"')->setField('value', $appid);
		$Config->where('name="appkey"')->setField('value', $appkey);
	   
	    $this->success('操作成功');
	   
	   }
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 /**
     * 清除前台缓存
     * 
     */
	 
	 
	    public function unrunfile(){
     //RUNTIME_FILE常量是入口文件中配置的runtimefile的路径及文件名；
	 
	$runflie="./data/~runtime.php";  
if(file_exists($runflie)){
    unlink($runflie); //删除RUNTIME_FILE;
}
 	$runflies="./admin/Runtime/~runtime.php";  
if(file_exists($runflies)){
    unlink($runflies); //删除RUNTIME_FILE;
}






$this->success('清除缓存成功');


	}
	
	
	
	
	
	
}