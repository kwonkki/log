<?php

if(strtotime($_POST['startcall'])>strtotime($_POST['endcall'])){
	echo "Start call date can't be greater than End call";
}else if($_POST['startcall']!="" && substr($_POST['startcall'],0,7) != substr(date("Y-m"),0,7)){
	echo "11Your Start Call duration is not the current date of the Year. Check your time";
}else if($_POST['endcall']!="" && substr($_POST['endcall'],0,7) != substr(date("Y-m"),0,7)){
	echo "Your End Call duration is not the current date of the Year. Check your time";
}else if(diff_min($_POST['startcall'], $_POST['endcall']) > 60){
	echo "Maximum Call duration is 1 hour. Check your time";
}else if(strtotime($_POST['followstart'])>strtotime($_POST['followend'])){
	echo "Start call date can't be greater than End call";
}else if(diff_min($_POST['followstart'], $_POST['followend']) > 60){
	echo "Maximum Call duration is 1 hour. Check your time";
}else if($_POST['followstart']!="" && substr($_POST['followstart'],0,7) != substr(date("Y-m"),0,7)){
	echo "22Your Start Call duration is not the current date of the Year. Check your time";
}else if($_POST['followend']!="" && substr($_POST['followend'],0,7) != substr(date("Y-m"),0,7)){
	echo "Your End Call duration is not the current date of the Year. Check your time";
}else{
	echo "";
}


function diff_min($date1, $date2){
	
	$diff = abs(strtotime($date2) - strtotime($date1));
	$minutes = floor($diff / (60));
	
	return $minutes;
}

?>