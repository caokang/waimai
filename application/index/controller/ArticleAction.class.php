<?php
// 本类由系统自动生成，仅供测试用途
class ArticleAction extends CommonAction {

    public function l(){
	$rid = $this->_get('id');
	$Articlecat=M('Article_cat');
	$con['acid']=$rid;
	$aresult=$Articlecat->where($con)->find();
	
	
	$Article=M('Article');
	$map['acid']=$aresult["acid"];
		import('ORG.Util.Page');// 导入分页类
        $count      = $Article->where($map)->count();// 查询满足要求的总记录数
        $Page       = new Page($count,10);// 实例化分页类 传入总记录数和每页显示的记录数
        $show       = $Page->show();// 分页显示输出
          // 进行分页数据查询 注意limit方法的参数要使用Page类的属性
        $list = $Article->where($map)->limit($Page->firstRow.','.$Page->listRows)->order('aid desc')->select();
		//dump($plist);
        $this->assign('page',$show);// 赋值分页输出
	    
	

	$this->assign('aitem',$aresult);
	
	$this->assign('list',$list);
	$this->display();
	
    
   }
       public function s(){
	 $id = $this->_get('id');
	 
	$Article=M('Article');
	$map['aid']=$id;
	$item=$Article->where($map)->find();
	$this->assign('item',$item);
	$this->display('show');
    
   }
   
   
          public function _empty($name){
            //把所有城市的操作解析到city方法
            $this->display('Public:404');
        }
   
   
}