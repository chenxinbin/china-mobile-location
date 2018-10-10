<?php
include('xcurl.php');

$curl = new XCurl();
$curl->setUserAgent('Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/68.0.3440.106 Safari/537.36');
$curl->setReferer('http://189.cn/chongzhi/');

$isps = array(
 130=>3, 131=>3, 132=>3, 155=>3, 156=>3, 185=>3, 186=>3, 175=>3,176 =>3,145=>3, 166=>3,
 133=>2, 153=>2, 180=>2, 181=>2, 189=>2, 199=>2, 177=>2, 173 =>2, 149=>2,
 139=>1, 138=>1, 137=>1, 136=>1, 135=>1, 134=>1, 147=>1, 150=>1, 151=>1, 152=>1, 157=>1, 158=>1, 159=>1, 182=>1, 183=>1, 184=>1, 187=>1, 188=>1, 178=>1, 198=>1
 );


foreach($isps as $k=>$v)
{
    if($v!=2) continue;
for($i=0; $i<=9999;$i++)
{
    $line = sprintf('%d%04d', $k, $i) ;
    //$line = '1531551';
    $url = "http://189.cn/trade/recharge/captcha/type.do";
    $xargs = "phone={$line}0163";
    $html = $curl->execPost($url, $xargs);
    $json = json_decode($html, true);
    echo $line, " ";
    if($json['dataObject'])
        echo $json['dataObject']['areaCode'];
    else
        echo "-";
    echo "\n";
    usleep(500000);
}
}

