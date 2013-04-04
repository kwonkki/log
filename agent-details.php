<?
include_once("./_common.php");

$g4['title'] = "";
include_once("./_head.php");

if($member['mb_level']<5){
	echo '<div class="main-body"><div class="row"><div class="span12"><h2>Sorry you dont have rights to access this page.</h2></div></div></div>';
}elseif($_GET['agent']==""){
	echo '<div class="main-body"><div class="row"><div class="span12">';
	
	$rheader = sql_query("SELECT * FROM call_result");
	$agents = sql_query("SELECT mb_no, mb_nick, mb_level FROM ".$g4['table_prefix']."member ORDER BY mb_level DESC, mb_nick");
	
	if($_POST['start']!="" && $_POST['end']!=""){
	$concatstr = "AND date_format(call_end,'%Y-%m-%d') BETWEEN '".$_POST['start']."' AND '".$_POST['end']."'";
	}
	
?>
	<h2>Agent Summary Report</h2>
            <form class="form-horizontal form-inline" method="post">
	           	<div class="control-group">    	           
              			<div class="input-append">
                        	<span class="help-inline">Date Range From </span>
                			<input type="text" value="" class="input" name="start" id="start" size="16"><a id="startbtn" href="#" class="btn btn-inverse"><i class="icon-calendar icon-white"></i></a>
                            <span class="help-inline"> To </span>
                            <input type="text" value="" class="input" name="end" id="end" size="16"><a id="endbtn" href="#" class="btn btn-inverse"><i class="icon-calendar icon-white"></i></a>
                            <button class="btn btn-inverse btngo" type="submit">Go!</button>                           
              			</div>                                                        		
						<input type="submit" value="Export to Excel" class="btn btn-inverse pull-right btn btnexport">
            	</div>
            </form>
            <table class="table table-striped">
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
					<th colspan="2">CSD</th>
					<?php foreach($arrResult as $k => $v ){ ?> 
                    <th>&nbsp;</th>                   
                    <? } ?>
				</tr>
				<?php }elseif($agentInfo['mb_level']==1 && $isFirstLoad==1){ ?>
				<tr class="warning">
					<th colspan="2">CRM</th>
					<?php foreach($arrResult as $k => $v ){ ?> 
                    <th>&nbsp;</th>                   
                    <? } ?>
				</tr>
				<?php }  
					$prevlevel = $agentInfo['mb_level'];
					 $isFirstLoad++; ?>
                <tr>                	
                	<td><a href="agent-details.php?agent=<?php echo $agentInfo['mb_no'] ?>"><?php echo $agentInfo['mb_nick'] ?></a></td>      
                    <td><?php echo $row['totalSum']; ?></td>                   
                    <?php $totcall =0; foreach($arrResult as $k => $v ){ ?> 
                    <td><?php $a = array_keys($v); $callcount = (($row['result_'.$a[0]]=="")? 0 : $row['result_'.$a[0]]); $totcall += $callcount; $grandtot += $callcount; echo $callcount;  $overall[$a[0]]= $overall[$a[0]]+$callcount; ?></td>                   
                    <? } ?>                  
                </tr>
                <?php } ?>
                <tr>
                	<th>All</th>
                    <th><?php echo (($grandtot=="")? 0: $grandtot); ?></th> 
                    <?php $totcall=0; foreach($arrResult as $k => $v ){ ?> 
                    <th><?php $a = array_keys($v); echo (($overall[$a[0]]=="")? 0: $overall[$a[0]]); ?></th>                   
                    <? } ?>                    
                </tr>
                </tbody>
            </table>     
			
			<script>
				$('#startbtn').click(	 
				  function(e) {
					$('#start').AnyTime_noPicker().AnyTime_picker({format: "%Y-%m-%d"}).focus();
					e.preventDefault();
				  } 
				);
				$('#endbtn').click(	 
				  function(e) {
					$('#end').AnyTime_noPicker().AnyTime_picker({format: "%Y-%m-%d"}).focus();
					e.preventDefault();
				  } 
				);
								
				$('.btngo').click(
					function(e) {
					$('form').attr('action', '');
					}
				);
				$('.btnexport').click(
					function(e) {
					$('form').attr('action', '<?=$g4['path']?>/summary-result-export.php');
					}
				); 
			</script>

	
<?	
	echo "</div></div></div>";

}else{
$agents = sql_query("SELECT mb_no, mb_nick FROM ".$g4['table_prefix']."member WHERE mb_no=".$_GET['agent']);
$agentInfo = sql_fetch_array($agents);

$rheader = sql_query("SELECT * FROM call_result");
$callingtime = sql_query("SELECT id FROM call_history WHERE MONTH( NOW( )) = MONTH(call_end) AND YEAR( NOW( )) = YEAR(call_end) AND mb_no=".$agentInfo['mb_no']. " GROUP BY date_format(call_end, '%Y-%m-%d')");
 
?>


<div class="main-body">
	<div class="row">
		  <div class="span12">
		  	<h2><?php echo $agentInfo['mb_nick']; ?> Report</h2>
            <table width="30%" class="padtbl">
              <tbody>
              <tr>
                  <th>Date</th><td><?php echo date("m/d/Y");?></td><th>No of Calling Day</th><td><?php echo mysql_num_rows($callingtime)?></td>
              </tr>
             </tbody>
            </table>
            <br>
            <table class="table">
            	<tbody>
            	<tr>
                	<th>Month Daily Average</th>  
                    <?php $qryStr=""; while($row = sql_fetch_array($rheader)){ 
							$arrResult[] = array( $row['result_id'] => $row['result_name']);
							$qryStr .= "SUM(CASE WHEN result_id=".$row['result_id']." THEN 1 ELSE 0 END) as result_".$row['result_id'].", ";
							 ?>  
                    <th><?php echo $row['result_name']?></th>
                    <?php if($row['result_id']==1){?>
                    	 <th>Call Duration</th>
                    <?php }
					} 					
					?>
                    <th>Total Call List</th>
                    <th>SMS</th>
                    <th>Email</th>
                </tr>
                <?php for($i=2; $i>=0;$i--){
					$qry = "SELECT $qryStr DATE_SUB(DATE_FORMAT( NOW( ) , '%Y-%m-%d' ) , INTERVAL $i MONTH ) as showMonth, SEC_TO_TIME(SUM(TIME_TO_SEC(IF(result_id=1,CAST( call_duration AS TIME
					),'00:00:00')))) as rTime , SUM(sms) as cntSMS, SUM(email) as cntEmail 
					FROM call_history WHERE DATE_SUB(DATE_FORMAT( NOW( ) , '%Y-%m-%d' ) , INTERVAL $i MONTH ) = DATE_FORMAT(call_end, '%Y-%m-%d') AND mb_no=".$agentInfo['mb_no'];	
					//echo $qry."<br><br>";				
					$rtable = sql_query($qry);					
					$row = sql_fetch_array($rtable);	
								
					?>
                <tr>                	
                	<td><?php echo date("F d, Y",strtotime($row['showMonth'])) ?></td>      
                    <?php $totcall =0; foreach($arrResult as $k => $v ){ ?> 
                    <td><?php $a = array_keys($v); $callcount = (($row['result_'.$a[0]]=="")? 0 : $row['result_'.$a[0]]); $totcall += $callcount; echo $callcount; ?></td>
                    <?php if($a[0]==1){ ?>
                    	<td><?php  echo (($row['rTime']=="")? "00:00:00" : $row['rTime']) ?></td>
                    <?php } ?>
                    <? } ?>
                    <td><?php echo (($totcall=="")? 0: $totcall); ?></td>
                    <td><?php echo (($row['cntSMS']=="")? 0: $row['cntSMS']); ?></td>
                    <td><?php echo (($row['cntEmail']=="")? 0: $row['cntEmail']); ?></td>
                </tr>
                <?php } unset($arrResult);?>
                </tbody>
            </table>
            
            <table class="table">
            	<tbody>
            	<tr>
                	<th>Month Total</th>  
                    <?php $qryStr=""; mysql_data_seek($rheader, 0); while($row = sql_fetch_array($rheader)){ 
							$arrResult[] = array( $row['result_id'] => $row['result_name']);
							$qryStr .= "SUM(CASE WHEN result_id=".$row['result_id']." THEN 1 ELSE 0 END) as result_".$row['result_id'].", ";
							 ?>  
                    <th><?php echo $row['result_name']?></th>
                    <?php if($row['result_id']==1){?>
                    	 <th>Call Duration</th>
                    <?php }
					} 					
					?>
                    <th>Total Call List</th>
                    <th>SMS</th>
                    <th>Email</th>
                </tr>
                <?php for($i=2; $i>=0;$i--){
					$qry = "SELECT $qryStr DATE_SUB(DATE_FORMAT( NOW( ) , '%Y-%m-%d' ) , INTERVAL $i MONTH ) as showMonth, SEC_TO_TIME(SUM(TIME_TO_SEC(IF(result_id=1,CAST( call_duration AS TIME
					),'00:00:00')))) as rTime , DATE_SUB( CAST( DATE_FORMAT( NOW( ) , '%Y-%m-01' ) 
					AS DATE ) , INTERVAL $i	MONTH ) as mDate, SUM(sms) as cntSMS, SUM(email) as cntEmail 
					FROM call_history WHERE MONTH(DATE_SUB( NOW( ), INTERVAL $i MONTH )) = MONTH(call_end) AND YEAR(DATE_SUB( NOW( ), INTERVAL $i MONTH )) = YEAR(call_end) AND mb_no=".$agentInfo['mb_no'];
					
					$rtable = sql_query($qry);
					$row = sql_fetch_array($rtable);						
					?>
                <tr>                	
                	<td><?php echo date("F Y",strtotime($row['showMonth'])) ?></td>      
                    <?php $totcall =0; foreach($arrResult as $k => $v ){ ?> 
                    <td><?php $a = array_keys($v); $callcount = (($row['result_'.$a[0]]=="")? 0 : $row['result_'.$a[0]]); $totcall += $callcount; echo $callcount; ?></td>
                    <?php if($a[0]==1){ ?>
                    	<td><?php  echo (($row['rTime']=="")? "00:00:00" : $row['rTime']) ?></td>
                    <?php } ?>
                    <? } ?>
                    <td><?php echo (($totcall=="")? 0: $totcall); ?></td>
                    <td><?php echo (($row['cntSMS']=="")? 0: $row['cntSMS']); ?></td>
                    <td><?php echo (($row['cntEmail']=="")? 0: $row['cntEmail']); ?></td>
                </tr>
                <?php } unset($arrResult); ?>
                </tbody>
            </table>
                
            <table class="table">
            	<tbody>
            	<tr>
                	<th>Daily</th>  
                    <?php $qryStr=""; mysql_data_seek($rheader, 0); while($row = sql_fetch_array($rheader)){ 
							$arrResult[] = array( $row['result_id'] => $row['result_name']);
							$qryStr .= "SUM(CASE WHEN result_id=".$row['result_id']." AND mb_no = ".$agentInfo['mb_no']." THEN 1 ELSE 0 END) as result_".$row['result_id'].", ";
							 ?>  
                    <th><?php echo $row['result_name']?></th>
                    <?php if($row['result_id']==1){?>
                    	 <th>Call Duration</th>
                    <?php }
					} 					
					?>
                    <th>Total Call List</th>
                    <th>SMS</th>
                    <th>Email</th>
                    <th>CALLING</th>
                </tr>
                <?php for($i=2; $i>=0;$i--){
					
					//echo date('Y-m-d', mktime(0,0,0,date('n')-$i,1,date('Y')));
					//echo date('Y-m-d',strtotime('-1 second',strtotime('+1 month',strtotime(date('m')-$i.'/01/'.date('Y').' 00:00:00'))));
					$dtFirstDay = date("Y-m-d", mktime(0, 0, 0, date("m")-$i , date("d")-date("d")+1, date("Y")));
					//$dtLastDay = date("Y-m-d", mktime(0, 0, 0, date("m")-$i+1 , date("d")-date("d"), date("Y"))); 
					$dtLastDay = date('Y-m-d',strtotime('-1 second',strtotime('+1 month',strtotime(date('m')-$i.'/01/'.date('Y').' 00:00:00'))));; 
					
					$rtable = sql_query("CREATE TEMPORARY TABLE IF NOT EXISTS calendar (datefield DATE);");
					$rtable = sql_query("CALL fill_calendar('$dtFirstDay', '$dtLastDay');");	
										
					$qry = "SELECT calendar.datefield, $qryStr DATE_SUB(DATE_FORMAT( NOW( ) , '%Y-%m-%d' ) , INTERVAL $i MONTH ) as showMonth,
						SEC_TO_TIME(SUM(TIME_TO_SEC(IF(result_id=1 AND mb_no = ".$agentInfo['mb_no'].",CAST( call_duration AS TIME
					),'00:00:00')))) as rTime,
					SUM(CASE WHEN sms=1 AND mb_no = ".$agentInfo['mb_no']." THEN 1 ELSE 0 END) as cntSMS, 
					SUM(CASE WHEN email=1 AND mb_no = ".$agentInfo['mb_no']." THEN 1 ELSE 0 END) as cntEmail,
					SUM(CASE WHEN call_end<>'' AND mb_no =".$agentInfo['mb_no']."
					  THEN 1
					  ELSE 0
					  END) AS isCall 
					FROM calendar 
					LEFT JOIN call_history ON calendar.datefield = DATE_FORMAT(call_end, '%Y-%m-%d' )
					 WHERE 
					 MONTH(DATE_SUB( NOW( ), INTERVAL $i MONTH )) = MONTH(calendar.datefield) AND 
					 YEAR(DATE_SUB( NOW( ), INTERVAL $i MONTH )) = YEAR(calendar.datefield) 
					 GROUP BY calendar.datefield ";

					$rtable = sql_query($qry);
					
					while($row = sql_fetch_array($rtable)){		
					$tot= 0;
					$currentdate = $row['showMonth'];
					?>
                <tr id="tbl<?php echo $i?>" class="child" <?php if($i>0){ ?> style="display:none"<?php } ?>>                	
                	<td><?php echo date("D, d-M Y", strtotime($row['datefield'])) ?></td>      
                    <?php $totcall =0; foreach($arrResult as $k => $v ){ $tot++; ?> 
                    <td><?php $a = array_keys($v); $callcount = (($row['result_'.$a[0]]=="")? 0 : $row['result_'.$a[0]]); $totcall += $callcount; echo $callcount; ?></td>
                    <?php if($a[0]==1){ ?>
                    	<td><?php  echo (($row['rTime']=="")? "00:00:00" : $row['rTime']) ?></td>
                    <?php } ?>
                    <? } ?>
                    <td><?php echo (($totcall=="")? 0: $totcall); ?></td>
                    <td><?php echo (($row['cntSMS']=="")? 0: $row['cntSMS']); ?></td>
                    <td><?php echo (($row['cntEmail']=="")? 0: $row['cntEmail']); ?></td>
                    <td align="center"><?php echo (($row['isCall']==0)? "<span class='label label-inverse'><i class='icon-remove icon-white'></i>" : "<span class='label label-success'><i class='icon-ok icon-white'></i>"); ?></span></td>
                </tr>
                <?php } ?>
                <tr id="tbl<?php echo $i?>" class="header">                	
                	<th><?php echo date("F Y",strtotime($currentdate)) ?></th>                         
                    <th colspan="<?php echo $tot+=5?>">&nbsp;</th>
                </tr>
				<?php } ?>
                </tbody>
            </table>
		  </div>          
	</div><!-- row -->	
	<!-- row -->
	

</div><!-- main-body -->

<script>	
	$("tr.header").click(function () { 
	 $(this).parent().find('tr#'+$(this).attr("id")+'.child').slideToggle();
	});
</script>
<?
}

include_once("./_tail.php");
?>
