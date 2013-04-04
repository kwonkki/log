<? 
include_once("./_common.php");

if ( !$member[mb_id]) {
alert("no permission", "{$g4['path']}");
}
 
include "dbconfig.php";
include_once("lib/common.lib.php");
$connect_db = sql_connect($mysql_host, $mysql_user, $mysql_password);
$select_db = sql_select_db($mysql_db, $connect_db);
	
	 if (!$select_db)
        die("<meta http-equiv='content-type' content='text/html; charset=$g4[charset]'><script type='text/javascript'> alert('DB 접속 오류'); </script>"); 
 
$file_name = date("Ymd")."call-logs";
 
header( "Content-type: application/vnd.ms-excel" ); 
header( "Content-Disposition: attachment; filename=$file_name.xls" ); 
header( "Content-Description: PHP4 Generated Data" );
 
if($_GET['search']!=""){
	$strwhere ="WHERE call_log.username LIKE '".$_GET['search']."%'";
}

if($_GET['search']!=""){
	$connector = " AND ";	
}else{
	$connector = " WHERE ";
}

if($_GET['start']!="" && $_GET['end']!=""){
$concatstr = "$connector date_format(call_history.call_end,'%Y-%m-%d') BETWEEN '".$_GET['start']."' AND '".$_GET['end']."'";
}

if($_GET['search']!="" || ($_GET['start']!="" && $_GET['end']!="")){
	$connector = " AND ";	
}else{
	$connector = " WHERE ";
}

if($member['mb_level']>5){
	if($_GET['agent_ids']!=""){
	 $concatstr .= " $connector call_history.mb_no IN(".substr($_GET['agent_ids'],0,-1).")";
	 $agent_names = sql_query("SELECT mb_nick FROM g4_member WHERE mb_no IN(".substr($_GET['agent_ids'],0,-1).")");
	} 
}else{
	$concatstr .= " $connector call_history.mb_no ='".$member['mb_no']."'";
	 $agent_names = sql_query("SELECT mb_nick FROM g4_member WHERE mb_no ='".$member['mb_no']."'");
}

// ---------------
if($_GET['search']!="" || ($_GET['start']!="" && $_GET['end']!="") || $_GET['agent_ids']!=""){
	$connector = " AND ";	
}else{
	$connector = " WHERE ";
}

if($_GET['call_type']!=""){
 $concatstr .= " $connector call_history.call_type IN(".str_replace("\\","",substr($_GET['call_type'],0,-1)).")";
}

if($_GET['search']!="" || ($_GET['start']!="" && $_GET['end']!="") || isset($_GET['agent_ids']) || $_GET['call_type']!=""){
	$connector = " AND ";	
}else{
	$connector = " WHERE ";
}

if($_GET['call_outcome']!=""){
 $concatstr .= " $connector call_history.outcome_id IN(".substr($_GET['call_outcome'],0,-1).")";
}

if($_GET['search']!="" || ($_GET['start']!="" && $_GET['end']!="") || isset($_GET['agent_ids']) || $_GET['call_type']!="" || $_GET['call_outcome']!=""){
	$connector = " AND ";	
}else{
	$connector = " WHERE ";
}

if($_GET['call_result']!=""){
 $concatstr .= " $connector call_history.result_id IN(".substr($_GET['call_result'],0,-1).")";
}
// ---------------


$call_log = sql_query("SELECT 
call_log.id,
call_history.`mb_no`,
call_history.`call_type`,
  call_history.`call_start`,
  call_history.`call_end`,  
  call_history.`comment`,
  call_history.`sms`,
  call_history.`email`,  
  call_history.`call_duration`,
  call_history.`call_status`,
call_log.username,call_log.product,call_category.category_name, call_outcome.outcome_name, call_result.result_name,call_log.currency,g4_member.mb_nick FROM call_history
 								LEFT JOIN call_log  ON call_history.call_id = call_log.id
								LEFT JOIN g4_member  ON call_history.mb_no=g4_member.mb_no
								LEFT JOIN call_category  ON call_history.category_id=call_category.category_id
								LEFT JOIN call_outcome  ON call_history.outcome_id=call_outcome.outcome_id
								LEFT JOIN call_result  ON call_history.result_id=call_result.result_id $strwhere $concatstr ORDER BY call_history.call_start DESC");
?>
<html>
<head>
</head>
<body style="font-family:Arial, Helvetica, sans-serif;">

<h2>Call Logs</h2>
<p>Date Range From: <?php echo (($_GET['start']=="")? "-": $_GET['start']); ?> To: <?php echo (($_GET['end']=="")? "-": $_GET['end']); ?></p>
<p>Agent: <?php while($row = sql_fetch_array($agent_names)){
					$names .= $row['mb_nick'].",";
				}
				if($names!=""){
					echo substr($names,0,-1);
				}else{echo "-";}
				?></p>
<table  class="table table-striped" style="border:1px solid #CCC" border="1" width="100%">
                    <thead>
                        <tr style="background:#cccccc; font-weight:bold; font-size:12px">
                          <th>Call No</th>
                          <th>Agent</th>
                          <th>Product</th>
                          <th>Type</th>
                          <th>Category</th>
                          <th>User Name</th>
                          <th>Currency</th>
                          <th>Last Call Date</th>
                          <th>Last Call Started</th>
                          <th>Last Call Ended</th>
                          <th>Last Outcome</th>
                          <th>Email</th>
                          <th>SMS</th>
                          <th>Call Result</th>
                          <th>Call Duration</th>  
                          <th>Comment</th>                       
                        </tr>
                    </thead>
                    <tbody>  
                    	<?php while($row = sql_fetch_array($call_log)){ ?>                    
                        <tr data-status="<?php if($row['call_status']==2){echo 2;}elseif($row['call_status']==3){echo 3;}?>" id="<?php echo $row['id'];?>" class="tblmain <?php if($row['call_status']==2){echo "error";}elseif($row['call_status']==3){echo "info";}?>" style=" <?php if($row['call_status']==2){echo "background:#C93452";}elseif($row['call_status']==3){echo "background:#D9EDF7";}?>; font-size:12px;">
                            <td><?php echo $row['id'];?></td>
                            <td><?php echo $row['mb_nick'];?></td>
                            <td><?php echo $row['product'];?></td>
                            <td><?php echo $row['call_type'];?></td>
                            <td><?php echo $row['category_name'];?></td>
                            <td><?php echo $row['username'];?></td>
                            <td><?php echo $row['currency'];?></td>
                            <td><?php echo date("m/d/Y", strtotime($row['call_end']));?></td>
                            <td><?php echo substr($row['call_start'], -8);?></td>
                            <td><?php echo substr($row['call_end'], -8);?></td>
                            <td><?php echo $row['outcome_name'];?></td>
                            <td><?php if($row['email']==1){ echo "Yes"; }else{echo "No";}?></td>
                            <td><?php if($row['sms']==1){ echo "Yes"; }else{echo "No";}?></td>
                            <td><?php echo $row['result_name'];?></td>
                            <td><?php echo $row['call_duration'];?></td>
                            <td><?php echo $row['comment'];?></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
                </body>
                </html>