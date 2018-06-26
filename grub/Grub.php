<?php
/**
 * Created by PhpStorm.
 * User: viruser
 * Date: 2018/6/21
 * Time: 16:20
 */

class Grub {

    /*
     *获取网页
     * */
    static function get_html($url,$options){
        $ch = curl_init($url);
        curl_setopt_array($ch,$options);
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }
}