<?php
set_error_handler("errorHandler");
function errorHandler($errno, $errstr, $errfile, $errline){
	//dirname(__FILE__);
	$filePth = constant("LOG_PATH").date('Ymd').'-log.txt';
	$br = "\r\n";
	$file = fopen('log.txt', 'a') or exit("Unable to open file!");
	if($file){
		@fwrite($file, "----------------Error Information Start----------------".$br);
		@fwrite($file, "date time : ".date('Y-m-d H:i:s').$br);
		@fwrite($file, 'err no: '.$errno.$br);
		@fwrite($file, 'err str: '.$errstr.$br);
		@fwrite($file, 'err file: '.$errfile.$br);
		@fwrite($file, 'err line: '.$errline.$br);
		@fwrite($file, "----------------Error Infromation End----------------".$br);
	}
	@fclose($file);
	echo"<script language='javascript'>";
	echo"window.location.href='../error.html';";
	echo"</script>";
}
?>