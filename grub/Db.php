<?php

date_default_timezone_set('Asia/Shanghai');
class Db {
    public $db;
    public function __construct() {
        $dsn = "mysql:host=127.0.0.1;dbname=test";
        $this->db = new PDO($dsn, 'root','root');
    }
    public function insert($table,$data){
        foreach($data as $k=>$v){
            $field ='';
            $value ='';
            foreach($v as $k1=>$v1){
                if( empty($field) ){
                    $field .= $k1;
                    $value .= "'".addslashes($v1)."'";
                }else{
                    $field .= ','.$k1;
                    $value .= ",'".addslashes($v1)."'";
                }
            }
            $sqls[] = "insert into $table ($field) values($value)";
        }
        foreach($sqls as $sql){
            $result = $this->db->exec($sql);
            $error = $this->db->errorInfo();
            if( empty($error[1]) ){
                echo '入库成功<br>';
            }else{
                echo $error[2].'<br>'.$sql.'<br>';
            }
        }

    }
}

