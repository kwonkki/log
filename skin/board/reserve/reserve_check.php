<?php
$g4_path = "../../..";
include_once("$g4_path/common.php");

$sql = "select * from ".$g4['write_prefix'].$_POST['bo_table']." where wr_3 ='".$_POST['input_date']."' and wr_name='".$_POST['name']."' and wr_2='".implode("-",$_POST['tel'])."'";
$write = sql_fetch($sql);

//예약확인
if($write['wr_id'])
{
echo $write['wr_content'];
}else
{
echo "신청 내역을 찾을수 없습니다.";
}
?>
