<? 
include_once("./_common.php");
 
if ( !($is_admin == "super") ) {
alert("no permission", "{$g4['path']}");
}
 
 
include "dbconfig.php";
include_once("lib/common.lib.php");
$connect_db = sql_connect($mysql_host, $mysql_user, $mysql_password);
$select_db = sql_select_db($mysql_db, $connect_db);
	
	 if (!$select_db)
        die("<meta http-equiv='content-type' content='text/html; charset=$g4[charset]'><script type='text/javascript'> alert('DB 접속 오류'); </script>"); 
 
$file_name = date("Ymd")."-agent-summary-report";
 
header( "Content-type: application/vnd.ms-excel" ); 
header( "Content-Disposition: attachment; filename=$file_name.xls" ); 
header( "Content-Description: PHP4 Generated Data" );
 
 
 
$rheader = sql_query("SELECT * FROM call_result");
$agents = sql_query("SELECT mb_no, mb_nick, mb_level FROM ".$g4['table_prefix']."member ORDER BY mb_level DESC, mb_nick");

if($_POST['start']!="" && $_POST['end']!=""){
$concatstr = "AND date_format(call_end,'%Y-%m-%d') BETWEEN '".$_POST['start']."' AND '".$_POST['end']."'";
}
?>

<html>
<head>
</head>
<body style="font-family:Arial, Helvetica, sans-serif;">
<div class="main-body">
	<div class="row">
		  <div class="span12">
		  	<h2>Agent Summary Report</h2>            
            <table class="table table-striped" border="1">
            	<tbody>
            	<tr>
                	<th>Agent</th>  
                    <th>All</th>
                    <?php $qryStr=""; while($row = sql_fetch_array($rheader)){ 
							$arrResult[] = array( $row['result_id'] => $row['result_name']);
							$qryStr .= "SUM(CASE WHEN result_id=".$row['result_id']." THEN 1 ELSE 0 END) as result_".$row['result_id'].", ";
							 ?>  
                    <th><?php echo $row['result_name']?></th>                    
                    <?php } ?>                    
                </tr>
                <?php  while($agentInfo = sql_fetch_array($agents)){
					$qry = "SELECT $qryStr count(id) as totalSum, SEC_TO_TIME(SUM(TIME_TO_SEC(IF(result_id=1,CAST( call_duration AS TIME
					),'00:00:00')))) as rTime , SUM(sms) as cntSMS, SUM(email) as cntEmail 
					FROM call_history WHERE mb_no=".$agentInfo['mb_no']. " $concatstr";	
					//echo $qry."<br><br>";
					$rtable = sql_query($qry);					
					$row = sql_fetch_array($rtable);	
								
					if($prevlevel != $agentInfo['mb_level']){
						$isFirstLoad=1;
					}
				?>
				<?php if($agentInfo['mb_level']==2 && $isFirstLoad==1){ ?>
				<tr class="warning">
					<th colspan="2" align="left">CSD</th>
					<?php foreach($arrResult as $k => $v ){ ?> 
                    <th>&nbsp;</th>                   
                    <? } ?>
				</tr>
				<?php }elseif($agentInfo['mb_level']==1 && $isFirstLoad==1){ ?>
				<tr class="warning">
					<th colspan="2" align="left">CRM</th>
					<?php foreach($arrResult as $k => $v ){ ?> 
                    <th>&nbsp;</th>                   
                    <? } ?>
				</tr>
				<?php }  
					$prevlevel = $agentInfo['mb_level'];
					 $isFirstLoad++; ?>
                <tr>                	
                	<td><?php echo $agentInfo['mb_nick'] ?></td>      
                    <td><?php echo $row['totalSum']; ?></td>                   
                    <?php $totcall =0; foreach($arrResult as $k => $v ){ ?> 
                    <td><?php $a = array_keys($v); $callcount = (($row['result_'.$a[0]]=="")? 0 : $row['result_'.$a[0]]); $totcall += $callcount; $grandtot += $callcount; echo $callcount;  $overall[$a[0]]= $overall[$a[0]]+$callcount; ?></td>                   
                    <? } ?>                  
                </tr>
                <?php } ?>
                <tr>
                	<th>All</th>
                    <th><?php echo (($grandtot=="")? 0: $grandtot); ?></th> 
                    <?php $totcall =0; foreach($arrResult as $k => $v ){ ?> 
                    <th><?php $a = array_keys($v); echo (($overall[$a[0]]=="")? 0: $overall[$a[0]]); ?></th>                   
                    <? } ?>                    
                </tr>
                </tbody>
            </table>            
            
		  </div>
	</div><!-- row -->
	
	<!-- row -->
	

</div><!-- main-body -->
</body> 
</html>