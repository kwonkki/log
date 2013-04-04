<?
include_once("./_common.php");


// get url parameter
$category_name			= trim($_POST['category_name']);

$cur_time = date("Y-m-d H:i:s", $g4['server_time']);



$row = sql_fetch(" select count(*) as cnt from call_category where category_name = '$category_name' ");


if( $row[cnt] ){
	$arr = array(	'result' 			=> '-1'
				,'category_name' 	=> $category_name
			);
	echo json_encode($arr);
	exit;
}







$sql = " insert into 	call_category
            	set 	category_name 		= '$category_name'
                ";
sql_query($sql);


$row = sql_fetch(" select * from call_category where category_name = '$category_name' ");


$arr = array(	'result' 			=> '1'
				,'category_name' 	=> $row['category_name']
				,'category_id' 	=> $row['category_id']

			);
echo json_encode($arr);
		
?>

