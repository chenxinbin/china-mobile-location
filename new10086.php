<?php
include('xcurl.php');

$curl = new XCurl();


$isps = array(
 130=>3, 131=>3, 132=>3, 155=>3, 156=>3, 185=>3, 186=>3, 175=>3,176 =>3,145=>3, 166=>3,
 133=>2, 153=>2, 180=>2, 181=>2, 189=>2, 199=>2, 177=>2, 173 =>2, 149=>2,
 139=>1, 138=>1, 137=>1, 136=>1, 135=>1, 134=>1, 147=>1, 150=>1, 151=>1, 152=>1, 157=>1, 158=>1, 159=>1, 182=>1, 183=>1, 184=>1, 187=>1, 188=>1, 178=>1, 198=>1
 );

foreach($isps as $k=>$v)
{
    if($v!=1) continue;
for($i=0; $i<=9999;$i++)
{
    $line = sprintf('%d%04d', $k, $i) ;
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

