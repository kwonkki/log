<?

$nhn1 = $_GET['nhn1'];
if($nhn1 != ''){
	@setcookie('lang',$nhn1,time()+3600*24,'/');
	include("lang/$nhn1.php");
}else{
	$file = $_COOKIE['lang'];
	if(!$file) $file = 'kr';
	include("lang/$file.php");
}

?>