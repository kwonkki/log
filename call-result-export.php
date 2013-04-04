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
 
$file_name = date("Ymd")."-pivot-report";
 
header( "Content-type: application/vnd.ms-excel" ); 
header( "Content-Disposition: attachment; filename=$file_name.xls" ); 
header( "Content-Description: PHP4 Generated Data" );
 
 
 
if($_POST['chkResult']!=""){
	$wResult = " WHERE result_id IN (".implode(",",$_POST['chkResult']).")";
}

$rCombo = sql_query("SELECT * FROM call_result");
$rheader = sql_query("SELECT * FROM call_result $wResult"); 
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
		  	<h2>Call Report by Result</h2><br>
               
            <form class="form-horizontal form-inline" method="post">	          
            <table class="table table-striped" border="1">
            	<tbody>
            	<tr>
                	<th>Agent</th>  
                    <th>Total Result</th>
                    <?php $qryStr=""; mysql_data_seek($rheader, 0); while($row = sql_fetch_array($rheader)){ 
							$arrResult[] = array( $row['result_id'] => $row['result_name']);
							$qryStr .= "SUM(CASE WHEN result_id=".$row['result_id']." THEN 1 ELSE 0 END) as result_".$row['result_id'].", ";
							 ?>  
                    <th><?php echo $row['result_name']?></th>                    
                    <?php } ?>                    
                </tr>
                <?php while($agentInfo = sql_fetch_array($agents)){
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
                        
            <!--  Loop By Result Start  -->
            <?php $qryStr=""; mysql_data_seek($rheader, 0); while($row = sql_fetch_array($rheader)){ ?>
            <h2><?php echo $row['result_name']?></h2>
            
            <!--  Table Per Outcome  -->
            <table class="table table-striped"  border="1">
            	<tbody>
            	<tr>
                	<th>Agent</th>  
                    <th>Total Result</th>
                    <?php 
					$wOutcome="";
					if( $_POST['chkOutcome'.$row['result_id']]!=""){
						$wOutcome = " AND outcome_id IN (".implode(",",$_POST['chkOutcome'.$row['result_id']]).")";
					}
					
					$rOutcome = sql_query("SELECT * FROM call_outcome WHERE result_id='".$row['result_id']."' $wOutcome"); 					
					$qryStr=""; while($loopOutcome = sql_fetch_array($rOutcome)){ 
							$arrOutcome[] = array( $loopOutcome['outcome_id'] => $loopOutcome['outcome_name']);
							$qryStr .= "SUM(CASE WHEN outcome_id=".$loopOutcome['outcome_id']." THEN 1 ELSE 0 END) as outcome_".$loopOutcome['outcome_id'].", ";
							 ?>  
                    <th><?php echo $loopOutcome['outcome_name']?></th>                    
                    <?php } ?>                    
                </tr>
                <?php 
				if(count($arrOutcome)==0){
					echo "<td colspan='2'>Sorry No Records Found for '". $row['result_name']."' Call Result</td>";
				}else{
				$prevlevel="";
				mysql_data_seek($agents, 0); $grandtot=0; unset($overall); while($agentInfo = sql_fetch_array($agents)){
					$qry = "SELECT $qryStr count(id) as totalSum, SEC_TO_TIME(SUM(TIME_TO_SEC(IF(result_id=1,CAST( call_duration AS TIME
					),'00:00:00')))) as rTime 
					FROM call_history WHERE mb_no=".$agentInfo['mb_no']. " AND result_id='".$row['result_id']."' $concatstr";	
					//echo $qry."<br><br>";
					$rOutcomeReturn = sql_query($qry);					
					$rowOutcome = sql_fetch_array($rOutcomeReturn);	
					
					if($prevlevel != $agentInfo['mb_level']){
						$isFirstLoad=1;
					}					
					?>
					<?php if($agentInfo['mb_level']==2 && $isFirstLoad==1){ ?>
					<tr class="warning">
						<th colspan="2" align="left">CSD</th>
						<?php foreach($arrOutcome as $k => $v ){ ?> 
						<th>&nbsp;</th>                   
						<? } ?>
					</tr>
					<?php }elseif($agentInfo['mb_level']==1 && $isFirstLoad==1){ ?>
					<tr class="warning">
						<th colspan="2" align="left">CRM</th>
						<?php foreach($arrOutcome as $k => $v ){ ?> 
						<th>&nbsp;</th>                   
						<? } ?>
					</tr>
					<?php }  
					$prevlevel = $agentInfo['mb_level'];
					 $isFirstLoad++; ?>
                <tr>                	
                	<td><?php echo $agentInfo['mb_nick'] ?></td>      
                    <td><?php echo $rowOutcome['totalSum']; ?></td>                   
                    <?php  $totcall =0; foreach($arrOutcome as $k => $v ){ ?> 
                    <td><?php $a = array_keys($v); $callcount = (($rowOutcome['outcome_'.$a[0]]=="")? 0 : $rowOutcome['outcome_'.$a[0]]); $totcall += $callcount; $grandtot += $callcount; echo $callcount;  $overall[$a[0]]= $overall[$a[0]]+$callcount; ?></td>                   
                    <? } ?>
                    
                </tr>
                <?php } ?>
                <tr>
                	<th>All</th>
                    <th><?php echo (($grandtot=="")? 0: $grandtot); ?></th> 
                    <?php $totcall =0; foreach($arrOutcome as $k => $v ){ ?> 
                    <th><?php $a = array_keys($v); echo (($overall[$a[0]]=="")? 0: $overall[$a[0]]); ?></th>                   
                    <? } unset($arrOutcome); ?>                    
                </tr>
                <?php } ?>
                </tbody>
            </table> 
            <!--  End Table Per Outcome  -->
            
            <?php } ?>
            <!--  Loop By Result End  -->
                 
            
             <!--  Table Per Email + SMS  -->
             <h2>Email and SMS</h2>
            <table class="table table-striped"  border="1">
            	<tbody>
            	<tr>
                	<th>Agent</th>  
                    <th>Total Result</th>
                    <th>SMS</th>  
                    <th>Email</th>                 
                    <th>Total SMS</th>  
                    <th>Total Email</th>                    
                </tr>
                <?php 
					mysql_data_seek($agents, 0);
					$prevlevel="";
					while($agentInfo = sql_fetch_array($agents)){			
					$qry = "SELECT SUM(CASE WHEN sms=1 THEN 1 ELSE 0 END) as output_sms, SUM(CASE WHEN email=1 THEN 1 ELSE 0 END) as output_email, SUM(CASE WHEN sms=1 THEN 1 ELSE 0 END)+SUM(CASE WHEN email=1 THEN 1 ELSE 0 END) as totalSum	FROM call_history WHERE mb_no=".$agentInfo['mb_no']. " $concatstr";	
					//echo $qry."<br><br>";
					$rESMSReturn = sql_query($qry);					
					$rowESMS = sql_fetch_array($rESMSReturn);						
					
					if($prevlevel != $agentInfo['mb_level']){
						$isFirstLoad=1;
					}					
					?>
					<?php if($agentInfo['mb_level']==2 && $isFirstLoad==1){ ?>
					<tr class="warning">
						<th colspan="6" align="left">CSD</th>
					</tr>
					<?php }elseif($agentInfo['mb_level']==1 && $isFirstLoad==1){ ?>
					<tr class="warning">
						<th colspan="6" align="left">CRM</th>					
					</tr>
					<?php }  
					$prevlevel = $agentInfo['mb_level'];
					 $isFirstLoad++; ?>
                <tr>                	
                	<td><?php echo $agentInfo['mb_nick'] ?></td>                          
                    <td><?php echo (($rowESMS['totalSum']=="")? 0: $rowESMS['totalSum']); ?></td>
                    <td><?php $cntcall=(($rowESMS['output_sms']=="")? 0: $rowESMS['output_sms']); echo $cntcall; $totsms+=$cntcall; ?></td>
                    <td><?php $ecntcall=(($rowESMS['output_email']=="")? 0: $rowESMS['output_email']); echo $ecntcall; $totemail+=$ecntcall; ?></td>
                    <td><?php echo $cntcall; ?></td>
                    <td><?php echo $ecntcall; ?></td>                    
                </tr>
                <?php } ?>
                <tr>
                	<th>All</th>
                    <th><?php echo $totemail+$totsms; ?></th>
                    <th><?php echo $totsms; ?></th>
                    <th><?php echo $totemail; ?></th>
                    <th><?php echo $totsms; ?></th>
                    <th><?php echo $totemail; ?></th>                    
                </tr>
                </tbody>
            </table> 
            <!--  End Table Per Email + SMS  -->
               
             <!--  Table Per Call Duration  -->
             <h2>Call Duration</h2>
            <table class="table table-striped"  border="1">
            	<tbody>
            	<tr>
                	<th>Agent</th>                      
                    <th>Duration</th>                      
                </tr>
                <?php 
					mysql_data_seek($agents, 0);
					$prevlevel="";
					while($agentInfo = sql_fetch_array($agents)){			
					$qry = "SELECT SEC_TO_TIME(SUM(TIME_TO_SEC(IF(result_id=1,CAST( call_duration AS TIME
					),'00:00:00')))) as rTime FROM call_history WHERE mb_no=".$agentInfo['mb_no']. " $concatstr";	
					//echo $qry."<br><br>";
					$rESMSReturn = sql_query($qry);					
					$rowESMS = sql_fetch_array($rESMSReturn);						
					if($prevlevel != $agentInfo['mb_level']){
						$isFirstLoad=1;
					}					
					?>
				<?php if($agentInfo['mb_level']==2 && $isFirstLoad==1){ ?>
				<tr class="warning">
					<th colspan="2" align="left">CSD</th>
				</tr>
				<?php }elseif($agentInfo['mb_level']==1 && $isFirstLoad==1){ ?>
				<tr class="warning">
					<th colspan="2" align="left">CRM</th>					
				</tr>
				<?php }  
					$prevlevel = $agentInfo['mb_level'];
					 $isFirstLoad++; ?>
                <tr>                	
                	<td><?php echo $agentInfo['mb_nick'] ?></td>                          
                    <td><?php echo (($rowESMS['rTime']=="")? '00:00:00': $rowESMS['rTime']); ?></td>
                </tr>
                <?php } 
				$qry = "SELECT SEC_TO_TIME(SUM(TIME_TO_SEC(IF(result_id=1,CAST( call_duration AS TIME
					),'00:00:00')))) as rTime FROM call_history WHERE call_duration<>'' $concatstr";	
					//echo $qry."<br><br>";
					$rESMSReturn = sql_query($qry);					
					$rowESMS = sql_fetch_array($rESMSReturn);
				?>
                <tr>
                	<th>All</th>
                    <th><?php echo (($rowESMS['rTime']=="")? '00:00:00': $rowESMS['rTime']); ?></th>                    
                </tr>
                </tbody>
            </table> 
            <!--  End Table Per Call Duration -->
            </form>
		  </div>
	</div><!-- row -->
	
	<!-- row -->
	

</div><!-- main-body -->
</body> 
</html>