<?php

/**
 * 菜品分类，增加，删除
 */


class FoodcatAction extends CommonAction {

 

    public function index() {
	
	    $Foodcat=M('Foodcat');
		$foodcatlist=$Foodcat->select();

		$this->assign('foodcatlist',$foodcatlist);
		
	
        $this->display();

    }

  
  
  
  /**
 * 桌号分类增加，
 */ 
   public function add() {
	   
	 $this->display();  

}

 public function addsave() {
	    $Foodcat=M('Foodcat');
		$map['fcname']=$_POST['fcname'];
		$map['fcsort']=$_POST['fcsort'];
		$map['ctime']=time();
		if($map['fcname']){
		
		 $result=$Foodcat->add($map);
           if ($result){
                   //成功后返回客户端新增的用户ID，并返回提示信息和操作状态
                    //  $this->success('新增成功','__APP__?m=Food&a=index');
                    $this->redirect('Foodcat/index');
                       }else{
                   //错误后返回错误的操作状态和提示信息
                   $this->error('新增失败');
				   }
		   }
		else {
		$this->error('分类名不可以为空');
		}
	  

}

	
   /**
 * 桌号分类修改，
 */  
     public function edit() {
	   $Foodcat=M('Foodcat');
		$map['fcid']=$_GET['id'];	    
		$foodcatitem=$Foodcat->where($map)->find();
		
		$this->assign('item',$foodcatitem);
	
        $this->display(); 
		
		
    }
	//编辑后数据保存
	     public function editsave() {
		 
		 $Foodcat=M('Foodcat');
		$map['fcid']=$_POST['fcid'];
        $data['fcname']=$_POST['fcname'];
		$data['fcsort']=$_POST['fcsort'];	    
		$foodedititem=$Foodcat->where($map)->save($data);
		
		  if ($foodedititem){
                   //成功后返回客户端新增的用户ID，并返回提示信息和操作状态
                   //  $this->success('修改成功','__APP__?m=Food&a=index');
				   $this->redirect(U('Foodcat/index'));

                       }else{
                   //错误后返回错误的操作状态和提示信息
                   $this->error('新增失败');
				   }
	
	    
		
		
    }
	
	
	
	
	
	
	
	
	
	
	

  /**
 * 桌号分类删除，
 */    
       public function del() {
$Foodcat=M('Foodcat');
		$map['fcid']=$_GET['id'];
		$Foodcat->where($map)->delete(); 
	    
		$this->redirect(U('Foodcat/index'));
		
		
    }

   
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  

}

?>