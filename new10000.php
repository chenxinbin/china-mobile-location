<?php
include('xcurl.php');
include('const.php');


$curl = new XCurl();
$curl->setReferer('https://login.189.cn/web/login');
$curl->setUseragent('Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.67 Safari/537.36 Edg/87.0.664.47');


#curl 'https://login.189.cn/web/login/ajax' -d 'm=checkphone&phone=15300000000'
foreach($ISP_PHONE_PREX[CHINA_TEL] as $prex)
{
    for($i=0; $i<=9999;$i++)
    {
        $line = sprintf('%d%04d0000', $prex, $i) ;
        $url = "https://login.189.cn/web/login/ajax";
        $html = $curl->execPost($url, "m=checkphone&phone={$line}");
        echo $line," ";
        #{"phonesen":"1531550","provinceId":"16","provinceName":"山东","cityNo":"532","cityName":"青岛","areaCode":"532","netId":null,"cardType":null,"remark":null}
        if(preg_match('/areaCode":"(\\d+)",/', $html, $m))
            echo "0", $m[1];
        else
            echo "-";
        echo "\n";
        usleep(500000);
    }
}

