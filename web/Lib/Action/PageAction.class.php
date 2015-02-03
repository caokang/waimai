<?php
// 本类由系统自动生成，仅供测试用途
class PageAction extends CommonAction {
    public function i(){
	$rid = I('id');
	$Pages=M('Pages');
	$con['pagedir']=$rid;
	$item=$Pages->where($con)->find();

	$list=$Pages->select();
	$this->assign('item',$item);
	$this->assign('list',$list);
	$this->display('index');
	

   }
   
   
       public function _empty($name){
            //把所有城市的操作解析到city方法
            $this->display('Public:404');
        }
   
   
   
}