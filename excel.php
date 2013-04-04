<? 
include_once("./_common.php");

if ( !($is_admin == "super") ) {
	alert("no permission", "{$g4['path']}");	
}


include "dbconfig.php";
$db_conn = mysql_connect($mysql_host, $mysql_user, $mysql_password) or die('can not access.');
mysql_select_db($mysql_db, $db_conn);
//@mysql_query("SET CHARACTER SET utf8");  // 한글깨지면 주석해지


// get url parameter
$event = $_GET['event'];
$country = $_GET['country'];


if(!$event){
	$event = "";
}
if(!$country){
	$country = "";
}

 
 
$file_name =	date("Ymd")."-".$event."-".$country;
 
header( "Content-type: application/vnd.ms-excel" ); 
header( "Content-Disposition: attachment; filename=$file_name.xls" ); 
header( "Content-Description: PHP4 Generated Data" );



 


$result=@mysql_query("select * from event where event like '%$event%' and country like '%$country%' order by `reg_date` desc       ");// where wr_is_comment = '0'  and wr_content = '$wr_id' order by wr_datetime desc");


?> 
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"> 
<style type="text/css">

.txt {mso-number-format:'\@'}
</style>
</head>

<body>
<table border="1"> 
  <tr style="background-color : #d3d3d3">
    <td>seq</td>
    <td>event</td>
    <td>member id</td>
    <td>email</td>
    <td>phone number</td>
    <td>country</td>
    <td>reg date</td>
  </tr>



<? 
while($data=mysql_fetch_array($result)) { 
echo "
  <tr> 
    <td>$data[seq]</td>
    <td>$data[event]</td>
    <td>$data[mb_id]</td>
    <td>$data[mb_email]</td>
    <td>$data[mb_number]</td>
    <td>$data[country]</td>
    <td>$data[reg_date]</td>
  </tr>
";
  } 
?>

</table> 
</body> 
</html>
