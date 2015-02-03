<?php
    class EmptyAction extends Action{
       public function _empty($name){
            //把所有城市的操作解析到city方法
            $this->display('Public:404');
        }
   
		
    }
