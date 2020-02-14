<?php

/**
 * 菜品分类，增加，删除
 */


class FoodAction extends CommonAction {



    public function index() {

	    $Food=D('FoodView');
		import('ORG.Util.Page');// 导入分页类
        $count      = $Food->count();// 查询满足要求的总记录数
        $Page       = new Page($count,10);// 实例化分页类 传入总记录数和每页显示的记录数
        $show       = $Page->show();// 分页显示输出
          // 进行分页数据查询 注意limit方法的参数要使用Page类的属性
        $foodlist = $Food->limit($Page->firstRow.','.$Page->listRows)->order('fid desc')->select();
        $this->assign('page',$show);// 赋值分页输出

		$this->assign('foodlist',$foodlist);


        $this->display();
    }



 //分类显示
     public function alist(){

     $map['fcid']=$this->_get('id');
	 $Food=D('FoodView');
	 import('ORG.Util.Page');// 导入分页类
        $count      = $Food->where($map)->count();// 查询满足要求的总记录数
        $Page       = new Page($count,10);// 实例化分页类 传入总记录数和每页显示的记录数
        $show       = $Page->show();// 分页显示输出
          // 进行分页数据查询 注意limit方法的参数要使用Page类的属性
        $foodlist= $Food->where($map)->limit($Page->firstRow.','.$Page->listRows)->order('fid desc')->select();
        $this->assign('page',$show);// 赋值分页输出
		$this->assign('foodlist',$foodlist);
        $this->display();

   }


   /**
 * 桌号增加，
 */

     public function add() {
	    $Foodcat=M('Foodcat');
		$foodcatlist=$Foodcat->select();

		$this->assign('foodcatlist',$foodcatlist);

	 $this->display();

	 }






     public function addsave() {

	 if (!$_FILES["pic"]["name"]){ //图片为空不做图片处理


		$Food=D("Food");

		$map['fname']=$_POST['fname'];//菜名
		$map['fcid']=$_POST['fcid'];
		$map['ftitle']=$_POST['ftitle'];//特点
		$map['fcontent']=$_POST['fcontent'];//菜品内容
		$map['fsort']=$_POST['fsort'];
		$map['fprice']=$_POST['fprice'];
		$map['fctime']=time();


if (!$Food->create($map)){
    // 如果创建失败 表示验证没有通过 输出错误提示信息

$this->error($Food->getError());
}else{
    // 验证通过 可以进行其他数据操作
	 $result=$Food->add($map);
	 $this->success('操作成功');
}

	 }//为空处理完成
     else {

	  import('ORG.Net.UploadFile');
       $upload = new UploadFile();// 实例化上传类
       $upload->maxSize  = 2145728 ;// 设置附件上传大小
       $upload->allowExts  = array('jpg');// 设置附件上传类型
       $upload->savePath =  './uploads/fimg/';// 设置附件上传目录
       $upload->thumb = true;
       $upload->thumbMaxWidth = '100,220';
       $upload->thumbMaxHeight ='100,220';
       $upload->thumbPrefix='';
       $upload->thumbSuffix= 's,m';
       $upload->thumbType=0;
       $upload->autoSub=true;
       $upload->subType='date';
       if(!$upload->upload()) {// 上传错误提示错误信息
      $this->error($upload->getErrorMsg());
       }else {// 上传成功 获取上传文件信息
       $info =  $upload->getUploadFileInfo();
       }


	 $Food=D("Food");

		$map['fname']=$_POST['fname'];//菜名
		$map['fcid']=$_POST['fcid'];
		$map['ftitle']=$_POST['ftitle'];//特点
		$map['fcontent']=$_POST['fcontent'];//菜品内容
		$map['fsort']=$_POST['fsort'];
		$map['fprice']=$_POST['fprice'];
		$map['fpic']='/uploads/fimg/'.$info[0]['savename'];
		$map['fctime']=time();


if (!$Food->create($map)){
    // 如果创建失败 表示验证没有通过 输出错误提示信息

$this->error($Food->getError());
}else{
    // 验证通过 可以进行其他数据操作
	 $result=$Food->add($map);
	 $this->success('操作成功');

}



	 }


    }


   /**
 * 桌号修改，
 */

    public function edit() {
        $Food=M('Food');
		$map['fid']=$_GET['id'];
		$fooditem=$Food->where($map)->find();
		$Foodcat=M('Foodcat');
		$foodcatlist=$Foodcat->select();

		$this->assign('foodcatlist',$foodcatlist);

		$this->assign('item',$fooditem);

        $this->display();


    }

	//编辑后保存
      public function editsave() {
       $id=$this->_post('fid');
	   if(!$id){$this->error('文章id不可以为空');}//判定ＩＤ是否为空
	   $data["fid"] =$id;
	    $maps['fid']  = array('neq',$id);
         if (!$_FILES["pic"]["name"]){ //图片为空不做图片处理


		$Food=D("Food");

		$map['fname']=$_POST['fname'];//菜名
		$map['fcid']=$_POST['fcid'];
		$map['ftitle']=$_POST['ftitle'];//特点
		$map['fcontent']=$_POST['fcontent'];//菜品内容
		$map['fsort']=$_POST['fsort'];
		$map['fprice']=$_POST['fprice'];
		$map['fctime']=time();


if (!$Food->where($maps)->create($map)){
    // 如果创建失败 表示验证没有通过 输出错误提示信息

$this->error($Food->getError());
}else{
    // 验证通过 可以进行其他数据操作
	 $result=$Food->where($data)->save($map);
	  $this->success('操作成功',U('Food/index'));
}

	 }//为空处理完成
     else {

	  import('ORG.Net.UploadFile');
       $upload = new UploadFile();// 实例化上传类
       $upload->maxSize  = 2145728 ;// 设置附件上传大小
       $upload->allowExts  = array('jpg');// 设置附件上传类型
       $upload->savePath =  './uploads/fimg/';// 设置附件上传目录
       $upload->thumb = true;
       $upload->thumbMaxWidth = '100,220';
       $upload->thumbMaxHeight ='100,220';
       $upload->thumbPrefix='';
       $upload->thumbSuffix= 's,m';
       $upload->thumbType=0;
       $upload->autoSub=true;
       $upload->subType='date';
       if(!$upload->upload()) {// 上传错误提示错误信息
      $this->error($upload->getErrorMsg());
       }else {// 上传成功 获取上传文件信息
       $info =  $upload->getUploadFileInfo();
       }


	 $Food=D("Food");

		$map['fname']=$_POST['fname'];//菜名
		$map['fcid']=$_POST['fcid'];
		$map['ftitle']=$_POST['ftitle'];//特点
		$map['fcontent']=$_POST['fcontent'];//菜品内容
		$map['fsort']=$_POST['fsort'];
		$map['fprice']=$_POST['fprice'];
		$map['fpic']='/uploads/fimg/'.$info[0]['savename'];
		$map['fctime']=time();



if (!$Food->where($maps)->create($map)){
    // 如果创建失败 表示验证没有通过 输出错误提示信息

$this->error($Food->getError());
}else{
    // 验证通过 可以进行其他数据操作
	 $result=$Food->where($data)->save($map);
	  $this->success('操作成功',U('Food/index'));
}



	 }


    }


      /**
 * 桌号删除，
 */
     public function del() {

		$Food=M('Food');
		$map['fid']=$_GET['id'];
		$Food->where($map)->delete();

		$this->redirect(U('Food/index'));


    }





        /**
 * 上架，
 */
     public function down() {

		$Food=M('Food');
		$map['fid']=$_GET['id'];
		$Food->where($map)->setField('status','1');


		$this->redirect(U('Food/index'));


    }


          /**
 * 下架，
 */
     public function up() {

		$Food=M('Food');
		$map['fid']=$_GET['id'];
		$Food->where($map)->setField('status','0');

		$this->redirect(U('Food/index'));


    }






















}

?>