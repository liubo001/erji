<?php
$cookie_jar = isset($_POST['cookie_jar']) ? $_POST['cookie_jar'] : "";
$bkjb = isset($_POST['bkjb']) ? $_POST['bkjb'] : "";
$zjhm = isset($_POST['zjhm']) ? $_POST['zjhm'] : "";
$name = isset($_POST['name']) ? $_POST['name'] : "";
$verify = isset($_POST['verify']) ? $_POST['verify'] : "";
if($bkjb&&$zjhm&&$name&&$verify){
$post_fields = "pram=results&ksxm=300&sf&zkzh&ksnf=3LIrNJBMV2obw2tY5MmWPv&bkjb=".$bkjb."&sfzh=".$zjhm."&name=".$name."&verify=".$verify;
$ch1 = curl_init();
curl_setopt($ch1, CURLOPT_URL, "http://search.neea.edu.cn/QueryMarkUpAction.do?act=doQueryResults");
curl_setopt($ch1, CURLOPT_REFERER, "http://search.neea.edu.cn/QueryMarkUpAction.do?act=doQueryCond&sid=300&pram=results&ksxm=300&sf&zkzh&ksnf=3LIrNJBMV2obw2tY5MmWPv");
//设置头文件的信息作为数据流输出
curl_setopt($ch1, CURLOPT_HEADER, 0);
//设置获取的信息以文件流的形式返回，而不是直接输出。
curl_setopt($ch1, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch1, CURLOPT_POSTFIELDS, $post_fields);
curl_setopt($ch1, CURLOPT_COOKIEFILE, $cookie_jar);
$result = curl_exec($ch1);
curl_close($ch1);
// echo $result;

include './phpQuery/phpQuery.php';
phpQuery::newDocumentHTML($result);
$zkzh = pq('tr:eq(2)>td:eq(3)')->text();
$sfzh = pq('tr:eq(3)>td:eq(1)')->text();
$name1 = pq('tr:eq(2)>td:eq(1)')->text();
$cj = pq('tr:eq(3)>td:eq(3)')->text();
$dj = pq('tr:eq(4)>td:eq(3)')->text();
$arr = array(
	'zkzh' => preg_replace("/\s/",'',$zkzh),
	'sfzh' => preg_replace("/\s/",'',$sfzh),
	'name' => preg_replace("/\s/",'',$name1),
	'cj' => preg_replace("/\s/",'',$cj),
	'dj' => preg_replace("/\s/",'',$dj),
	);
// echo $result;
exit(json_encode($arr,JSON_UNESCAPED_UNICODE));
} else {
	echo "<h1 style=\"text-align:center;\">错误</h1>";
}
 