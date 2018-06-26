<?php

require 'Grub.php';
require 'Db.php';
class Csdn {
    public function main(){
        $url = "https://so.csdn.net/so/search/s.do?p=1&q=php&t=blog&domain=&o=&s=&u=&l=&rbg=0";
        $options = ([
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_SSL_VERIFYPEER => 0
        ]);
        $result = Grub::get_html($url,$options);
        preg_match_all('/<dl.*?\shref=\"(.*?)\".*?日期：(\d{4}-\d{2}-\d{2}\s+\d{2}:\d{2}:\d{2}).*?\/dl>/is',$result,$matches);
//        print_r($matches);exit;
        foreach($matches[1] as $k=>$v){
            $data[$k]['url'] = $v;
            $data[$k]['create_time'] = $matches[2][$k];
            $article_result = Grub::get_html($v,$options);
            preg_match('/class=\"title-article\">(.*?)<.*?<article>(.*?<\/div>)\s*<div\s+class=\"hide-article-box/is',$article_result,$matches2);
            $data[$k]['title'] = $matches2[1];
            $data[$k]['article'] = $matches2[2];

        }
        return $data;
    }

}
//die('test');
$csdn = new Csdn();
$data = $csdn->main();
//print_r($data);
DB::insert('article',$data);
