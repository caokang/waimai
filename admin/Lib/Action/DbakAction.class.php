<?php
// 本类由系统自动生成，仅供测试用途

class DbakAction extends CommonAction{
    private $ds = "\n\r\n\r";
    // 每条sql语句的结尾符
    public $sqlEnd = ";";
	
		
	
	
    public function index(){
        $M = M();
        $tabs = $M->query('SHOW TABLE STATUS');
        $total = 0;
        foreach ($tabs as $k => $v) {
            $tabs[$k]['size'] = byteFormat($v['Data_length'] + $v['Index_length']);
            $total+=$v['Data_length'] + $v['Index_length'];
        }
		
	//dump($tabs);
        //echo __APP__."/Public/data/";
   // echo  $this->export($tablename="");
 //  echo $this->restore("./Public/backup/20130704091642_tao_group_v1.sql");
        $this->assign("list", $tabs);
        $this->assign("total", byteFormat($tota));
        $this->assign("tables", count($tabs));
        $this->display();
    }
    public function import(){
        //echo C("DB_BACKUP");
        //print_r(glob(C("DB_BACKUP")."*.sql"))
        foreach (glob(C("DB_BACKUP")."*.sql") as $filename) {
    $arr[]=array("filename"=>$filename,"size"=>filesize($filename));
 }
// if(!empty($_GET["file"])){
//     $this->restore(I("file"));
// }

        $this->assign("list", $arr);
     $this->display();    
    }
    public function truncate(){
        $table=I("table");
        if(!empty($table)){
        $M = M();
         $result = $M->query('TRUNCATE TABLE '.$table);
       
        if(empty($result)){
            $this->success("清空表成功！");
        }else{
            $this->error("清空表失败！");
          }
        }
    }
    public function delete(){
        $table=I("table");
        if(!empty($table)){
        $M = M();
         $result = $M->query('DROP TABLE '.$table);
       
        if($result){
            $this->success("删除表成功！");
        }else{
            $this->error("删除表失败！");
          }
        }
    }
    /**
     * getTables 获取数据库表列表
     * @return array $tables      返回结果数组    
     */
    public function getTables() {
        $M = M();
        $res = $M->query ( "SHOW TABLES;" );
        $tables = array ();
        foreach ( $res as $row ) {
            
            foreach ($row as $v){
                $tables[]=$v;
            }
        }
        return $tables;
    }
    /**
     * 插入数据库备份基础信息
     *
     * @return string
     */
    private function _base() {
        $value = '';
        $value .= '-- MySQL database dump' . $this->ds;
        $value .= '-- Created by DBAction class, Power By TaoTao. ' . $this->ds;
        $value .= '-- http://blog.kisscn.com ' . $this->ds;
        $value .= '--' . $this->ds;
        $value .= '-- 主机: ' . $this->host . $this->ds;
        $value .= '-- 生成日期: ' . date ( 'Y' ) . ' 年  ' . date ( 'm' ) . ' 月 ' . date ( 'd' ) . ' 日 ' . date ( 'H:i' ) . $this->ds;
        $value .= '-- MySQL版本: ' . mysql_get_server_info () . $this->ds;
        $value .= '-- PHP 版本: ' . phpversion () . $this->ds;
        $value .= $this->ds;
        $value .= '--' . $this->ds;
        $value .= '-- 数据库: `' . C("DB_NAME") . '`'. $this->ds;
        $value .= '--' . $this->ds ;
        $value .= '-- -------------------------------------------------------';
        $value .= $this->ds . $this->ds;
        return $value;
    }
    /**
     * 插入表结构
     *
     * @param unknown_type $table            
     * @return string
     */
    private function _insert_table_structure($table) {
        $sql = '';
        $sql .= "--" . $this->ds;
        $sql .= "-- 表的结构" . $table .$this->ds."--" .$this->ds;
         $M = M();
        // 如果存在则删除表
        $sql .= "DROP TABLE IF EXISTS `" . $table . '`' . $this->sqlEnd . $this->ds;
        // 获取详细表信息
        $res = $M->query ( 'SHOW CREATE TABLE `' . $table . '`' );
        $sql .= $res [0]["Create Table"];
        $sql .= $this->sqlEnd . $this->ds;
        // 加上
        $sql .= $this->ds;
        $sql .= "--" . $this->ds;
        $sql .= "-- 转存表中的数据 " . $table . $this->ds;
        $sql .= "--" . $this->ds;
        $sql .= $this->ds;
        return $sql;
    }

    /**
     * 插入语句构造
     *
     * @param string $table                     
     * @return string
     */
    private function _insert_record($table) {
        // sql字段逗号分割

        $M=M();
        $res = $M->query ( 'select * FROM `' . $table . '`' );    
        // 循环每个子段下面的内容
            foreach ($res as $val){
        $comma = 0;
                $insert .= "INSERT INTO `" . $table . "` VALUES(";
                foreach ($val as $v){
        $insert.=$comma == 0 ? "" : ",";
            $insert.= ( "'" . mysql_escape_string ( $v ) . "'");
                        $comma++;
            
            }
            $insert .= ");" . $this->ds;
            
    }
        
        return $insert;
    }

    /**
     * 写入文件
     *
     * @param string $sql            
     * @param string $filename            
     * @param string $dir            
     * @return boolean
     */
    private function _write_file($sql, $filename, $dir) {
          $dir = C("DB_BACKUP");
        // 创建目录
        if (! is_dir ( $dir )) {
            mkdir ( $dir, 0777, true );
        }
        $re = true;
        if (! @$fp = fopen ( $dir . $filename, "w+" )) {
            $re = false;
            $msg .= "打开文件失败！";
        }
        if (! @fwrite ( $fp, $sql )) {
            $re = false;
            $msg .= "写入文件失败，请文件是否可写";
        }
        if (! @fclose ( $fp )) {
            $re = false;
            $msg .= "关闭文件失败！";
        }
        return $re;
    }
    /**
     * 数据库备份
     * 参数：备份哪个表(可选),备份目录(可选，默认为backup),分卷大小(可选,默认2048，即2M)
     *
     * @param string $dir            
     * @param int $size            
     * @param array $tablename            
     */
    public function export() {
        $tablename=I("table");
         $dir = C("DB_BACKUP");
        // 创建目录
        if (! is_dir ( $dir )) {
            mkdir ( $dir, 0777, true ) or die ( '创建文件夹失败' );
        }
        $size = C("DB_BACKUP_SIZE");
        $sql = '';
        $tables=explode(",", $tablename);
        //print_r($tables);
        $M=M();
        if(!empty($tablename)){
        foreach ($tables as $value) {
            $msg .= '正在备份表' . $value . '<br />';
            // 插入文件头信息
            $sql = $this->_base ();
            // 插入表结构信息
            $sql .= $this->_insert_table_structure ( $value );
            // 文件名前缀
            $filename = date ( 'YmdHis' ) . "_" . $value;
            // 分卷标识
            $p = 1;
            $sql .= $this->_insert_record ( $value);
                        // 如果大于分卷大小，则写入文件
                        //$msg.="文件大小为：".strlen ( $sql );
                if (strlen ( $sql ) >= $size * 1024) {
                    $file = $filename . "_v" . $p . ".sql";
                    if ($this->_write_file ( $sql, $file, $dir )) {
                        $msg .= "表-" . $value . "-卷-" . $p . '<br />';
                        $msg.= "-数据备份完成,生成备份文件 <span style='color:#f00;'>$dir$filename</span><br />";
                    } else {
                        $msg .= "备份表-" . $value . "-失败<br />";
                        return false;
                    }
                    // 下一个分卷
                    $p ++;
                    // 重置$sql变量为空，重新计算该变量大小
                    $sql = "";
                }else{
                            // sql大小不够分卷大小
            if ($sql != "") {
                $filename .=  ".sql";
                if ($this->_write_file ( $sql, $filename, $dir )) {
                    $msg .= "表-" . $value . "-卷-" . $p. '<br />'. "-数据备份完成,生成备份文件 <span style='color:#f00;'>$dir$filename</span><br />";
                } else {
                    $msg .= "备份卷-" . $p . "-失败<br />";
                    return false;
                }
            }
                }
        }
        }else{
                    // 备份全部表
            if ($tables = $M->query( "show table status from " . C("DB_NAME") )) {
                $msg .= "读取数据库结构成功！<br />";
            } else {
                exit ( "读取数据库结构失败！<br />" );
            }
            // 插入dump信息
            $sql .= $this->_base ();
            // 文件名前面部分
            $filename = date ( 'YmdHis' ) . "_all";
            // 查出所有表
            $tables = $M->query ( 'SHOW TABLES' );
            // 第几分卷
            $p = 1;
            // 循环所有表
            foreach  ( $tables as $value) {
                foreach ($value as $v) {
                
                // 获取表结构
                $sql .= $this->_insert_table_structure ( $v );
                    // 单条记录
                    $sql .= $this->_insert_record ( $v );
                  }

            }
                  // 如果大于分卷大小，则写入文件
                    if (strlen ( $sql ) >= $size * 1024) {

                        $file = $filename . "_v" . $p . ".sql";
                        // 写入文件
                        if ($this->_write_file ( $sql, $file, $dir )) {
                            $this->msg .= "-卷-" . $p . "-数据备份完成,生成备份文件<span style='color:#f00;'>$dir$file</span><br />";
                        } else {
                            $this->msg .= "备份卷-" . $p . "-失败<br />";
                            return false;
                        }
                        // 下一个分卷
                        $p ++;
                        // 重置$sql变量为空，重新计算该变量大小
                        //$sql = "";
                    }
                // sql大小不够分卷大小
            if ($sql != "") {
                $filename .=  ".sql";
                if ($this->_write_file ( $sql, $filename, $dir )) {
                    $msg .= "数据库-" . C("DB_NAME") . "-卷-" . $p. '<br />'. "-数据备份完成,生成备份文件 <span style='color:#f00;'>$dir$filename</span><br />";
                } else {
                    $msg .= "备份卷-" . $p . "-失败<br />";
                    return false;
                }
            }
        }
       // echo $msg; 
		$this->assign('msg',$msg);
		$this->display();
    }

    /**
     * 导入备份数据
     * 说明：分卷文件格式20120516211738_all_v1.sql
     * 参数：文件路径(必填)
     *
     * @param string $sqlfile            
     */
    function restore($file) {
        $sqlfile=C("DB_BACKUP").$file;

        // 检测文件是否存在
        if (! file_exists ( $sqlfile )) {
            exit ( "文件不存在！请检查" );
        }
        $this->lock ( C("DB_NAME") );
        // 获取数据库存储位置
        $sqlpath = pathinfo ( $sqlfile );
    //    $this->sqldir = $sqlpath ['dirname'];
        // 检测是否包含分卷，将类似20120516211738_all_v1.sql从_v分开,有则说明有分卷
        $volume = explode ( "_v", $sqlfile );
        $volume_path = $volume [0];
        $msg .= "请勿刷新及关闭浏览器以防止程序被中止，如有不慎！将导致数据库结构受损<br />";
        $msg .= "正在导入备份数据，请稍等！<br />";
        if (empty ( $volume [1] )) {
             $msg .= "正在导入sql：<span style='color:#f00;'>" . $sqlfile . '</span><br />';
            // 没有分卷
            if ($this->_import ( $sqlfile )) {
            echo    $msg .= "数据库导入成功！";
        //$this->success("数据库导入成功！");
            } else {
                exit ( '数据库导入失败！' );
            }
        } else {
            // 存在分卷，则获取当前是第几分卷，循环执行余下分卷
            $volume_id = explode ( ".sq", $volume [1] );
            // 当前分卷为$volume_id
            $volume_id = intval ( $volume_id [0] );
            while ( $volume_id ) {
                $tmpfile = $volume_path . "_v" . $volume_id . ".sql";
                // 存在其他分卷，继续执行
                if (file_exists ( $tmpfile )) {
                    // 执行导入方法
                    $msg .= "正在导入分卷 $volume_id ：<span style='color:#f00;'>" . $tmpfile . '</span><br />';
                    if ($this->_import ( $tmpfile )) {

                    } else {
                        $volume_id = $volume_id ? $volume_id :1;
                        exit ( "导入分卷：<span style='color:#f00;'>" . $tmpfile . '</span>失败！可能是数据库结构已损坏！请尝试从分卷1开始导入' );
                    }
                } else {
                    $msg .= "此分卷备份全部导入成功！<br />";
                    echo $msg;
                }
                $volume_id ++;
            }
        }
    }
    /**
     * 将sql导入到数据库（普通导入）
     *
     * @param string $sqlfile            
     * @return boolean
     */
    private function _import($sqlfile) {
        // sql文件包含的sql语句数组
        $sqls = array ();
        $f = fopen ( $sqlfile, "rb" );
        // 创建表缓冲变量
        $create_table = '';
        while ( ! feof ( $f ) ) {
            // 读取每一行sql
            $line = fgets ( $f );
            // 这一步为了将创建表合成完整的sql语句
            // 如果结尾没有包含';'(即为一个完整的sql语句，这里是插入语句)，并且不包含'ENGINE='(即创建表的最后一句)
            if (! preg_match ( '/;/', $line ) || preg_match ( '/ENGINE=/', $line )) {
                // 将本次sql语句与创建表sql连接存起来
                $create_table .= $line;
                // 如果包含了创建表的最后一句
                if (preg_match ( '/ENGINE=/', $create_table)) {
                    //执行sql语句创建表
                    $this->_insert_into($create_table);
                    // 清空当前，准备下一个表的创建
                    $create_table = '';
                }
                // 跳过本次
                continue;
            }
            //执行sql语句
            $this->_insert_into($line);
        }
        fclose ( $f );
        return true;
    }
    //插入单条sql语句
    private function _insert_into($sql){
        $M=M();
        if (! $M->query( trim ( $sql ) )) {
            $msg .= mysql_error ();
            return false;
        }
    }
        // 锁定数据库，以免备份或导入时出错
    private function lock($tablename, $op = "WRITE") {
        $M=M();
        if ($M->query( "lock tables " . $tablename . " " . $op ))
            return true;
        else
            return false;
    }

    // 解锁
    private function unlock() {
        $M=M();
        if ($M->query ( "unlock tables" ))
            return true;
        else
            return false;
    }


    
}
        