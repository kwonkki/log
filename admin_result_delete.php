<?
include_once("./_common.php");


// get url parameter
$num			= trim($_POST['num']);

$cur_time = date("Y-m-d H:i:s", $g4['server_time']);


$sql = " delete from call_result
          where result_id = '$num' 
          ";
sql_query($sql);


$arr = array(	'result' 			=> '1'
				,'num'				=> $num
			);
echo json_encode($arr);
		
?>

