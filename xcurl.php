<?php
 
class XCurl {
  
  var $cookiefile; 
  var $ch;
  var $ac;
  var $save = false;
  
  function __construct() {
    $this->ch = curl_init();
    $this->setTimeout();
 
  }
  
  function __destruct() {
    if($this->ch)
      curl_close ($this->ch);

    if($this->save==false) {
      @unlink($this->cookiefile);
    }
  }
  
  function close() {
    curl_close ($this->ch);
    unset($this->ch);
  }
  
  function setTimeout($connecttimeout=10, $totaltimeout=18){
  	curl_setopt($this->ch, CURLOPT_CONNECTTIMEOUT,  $connecttimeout);
  	curl_setopt($this->ch, CURLOPT_TIMEOUT,  $totaltimeout);
  }
  
  function setCookie($cookies) {
    if(is_array($cookies)) {
      $_p ='&';
      foreach($cookies as $k => $v) {
        $_p .= "{$k}={$v};";
      }
      $cookies = substr($_p, 1);
    }
    curl_setopt($this->ch, CURLOPT_COOKIE,  $cookies);
  }  
  
  function setCookieJar($path, $save=true) {
    $this->cookiefile = $path;
    $this->save = $save;
    curl_setopt($this->ch, CURLOPT_COOKIEFILE,  $path);
    curl_setopt($this->ch, CURLOPT_COOKIEJAR,   $path);
  }
  
  function setUserAgent($value) {
    curl_setopt($this->ch, CURLOPT_USERAGENT, $value);
  }
  
  function setProxy($value) {
    curl_setopt($this->ch, CURLOPT_PROXY, $value);
  }
  
  function setReferer($value) {
    curl_setopt($this->ch, CURLOPT_REFERER, $value);
  }

  
  function setIsLocation($is)
  {
    if($is)
      curl_setopt($this->ch, CURLOPT_FOLLOWLOCATION, TRUE);
  }
  
  
  function execPost($url, $post) {
    curl_setopt($this->ch, CURLOPT_POST, 1);
    if(is_array($post))
    curl_setopt($this->ch, CURLOPT_POSTFIELDS, http_build_query($post, null, "&"));
    else
    curl_setopt($this->ch, CURLOPT_POSTFIELDS, $post);
    curl_setopt($this->ch, CURLOPT_URL, $url);
    curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, 1);
    return curl_exec ($this->ch);
  }
  
  function execGet($url) {
    curl_setopt($this->ch, CURLOPT_HTTPGET, 1);
    curl_setopt($this->ch, CURLOPT_POST, 0);
    curl_setopt($this->ch, CURLOPT_URL, $url);
    curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, 1);
    return curl_exec ($this->ch);
  }
  
  function execHead($url) {
    curl_setopt($this->ch, CURLOPT_POST, 1);
    curl_setopt($this->ch, CURLOPT_URL, $url);
    curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($this->ch, CURLOPT_HEADER,1);
    return curl_exec ($this->ch);
  }

}
