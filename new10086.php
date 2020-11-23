<?php
include('xcurl.php');
include('const.php');


$curl = new XCurl();
$curl->setReferer('https://shop.10086.cn/i/?f=rechargecredit');


foreach($ISP_PHONE_PREX[CHINA_MOBILE] as $prex)
{
    for($i=0; $i<=9999;$i++)
    {
        $line = sprintf('%d%04d', $prex, $i) ;
        $url = "https://shop.10086.cn/i/v1/res/numarea/{$line}?time=201614122237547";
        $html = $curl->execGet($url);
        echo $line," ";
        if(preg_match('/id_area_cd":"(\\d+)",/', $html, $m))
            echo $m[1];
        else
            echo "-";
        echo "\n";
        usleep(5000);
    }
}

