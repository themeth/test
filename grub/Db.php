<?php
/**
 * Created by PhpStorm.
 * User: viruser
 * Date: 2018/6/21
 * Time: 17:26
 */

class Db {
    public $db;

    public function __construct() {
        $dsn = "mysql:host=127.0.0.1;dbname=test";
        $this->db = new PDO($dsn, 'root','root');
    }

    public static function insert($table,$data){

//        print_r($data);exit;
        foreach($data as $k=>$v){
            $field ='';
            $value ='';
            foreach($v as $k1=>$v1){
                if( empty($field) ){
                    $field .= $k1;
                    $value .= "'".$v1."'";
                }else{
                    $field .= ','.$k1;
                    $value .= ",'".$v1."'";
                }
            }
            $time = date('Y-m-d H:i:s');
            $sql[] = "insert into $table ($field".",create_time,update_time".") values($value".",'$time','$time'".")";

        }
        /*$field .= ",create_time,update_time";
        $time = date('Y-m-d H:i:s');
        $value .= ",'$time','$time'";
        $sql = "insert into $table ($field) values($value)";*/
        print_r($sql);
    }
}