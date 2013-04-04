<?
include_once("./_common.php");


// get url parameter
$outcome_name			= trim($_POST['outcome_name']);
$outcome_result			= trim($_POST['outcome_result']);

$cur_time = date("Y-m-d H:i:s", $g4['server_time']);



$row = sql_fetch(" select count(*) as cnt from call_outcome where outcome_name = '$outcome_name' ");


if( $row[cnt] ){
	$arr = array(	'result' 			=> '-1'
				,'outcome_name' 	=> $outcome_name
			);
	echo json_encode($arr);
	exit;
}


$sql = " insert into 	call_outcome
            	set 	outcome_name 		= '$outcome_name'
            			,result_id 		= '$outcome_result'
                ";
sql_query($sql);



//$row = sql_fetch(" select * from call_outcome where outcome_name = '$outcome_name' ");

		$sql2 = " 	SELECT
							a.outcome_id		as outcome_id
							, a.outcome_name	as outcome_name
							, a.result_id		as result_id	
							, b.result_id		as result_id2	
							, b.result_name		as result_name
					FROM  `call_outcome` a
					LEFT JOIN  `call_result` b ON a.result_id = b.result_id
					where  a.outcome_name = '$outcome_name'
				   ";

$row = sql_fetch($sql2);


$arr = array(	'result' 			=> '1'
				,'outcome_name' 	=> $row['outcome_name']
				,'outcome_id' 	=> $row['outcome_id']
				,'result_name' 	=> $row['result_name']

			);
echo json_encode($arr);
		
?>

