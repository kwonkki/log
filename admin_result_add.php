<?
include_once("./_common.php");


// get url parameter
$result_name			= trim($_POST['result_name']);

$cur_time = date("Y-m-d H:i:s", $g4['server_time']);



$row = sql_fetch(" select count(*) as cnt from call_result where result_name = '$result_name' ");


if( $row[cnt] ){
	$arr = array(	'result' 			=> '-1'
				,'result_name' 	=> $result_name
			);
	echo json_encode($arr);
	exit;
}







$sql = " insert into 	call_result
            	set 	result_name 		= '$result_name'
                ";
sql_query($sql);


$row = sql_fetch(" select * from call_result where result_name = '$result_name' ");


$arr = array(	'result' 			=> '1'
				,'result_name' 	=> $row['result_name']
				,'result_id' 	=> $row['result_id']

			);
echo json_encode($arr);
		
?>

