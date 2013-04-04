<?
include_once("./_common.php");

$g4['title'] = "";
include_once("./_head.php");

$rheader = sql_query("SELECT * FROM call_result");
$callingtime = sql_query("SELECT id FROM call_history WHERE MONTH( NOW( )) = MONTH(call_end) AND YEAR( NOW( )) = YEAR(call_end) AND mb_no=".$member['mb_no']. " GROUP BY date_format(call_end, '%Y-%m-%d')");
 
?>


<div class="main-body">
	<div class="row">
		  <div class="span12">
		  	<h2><?php echo $member['mb_nick']; ?> Report</h2>
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
					FROM call_history WHERE DATE_SUB(DATE_FORMAT( NOW( ) , '%Y-%m-%d' ) , INTERVAL $i MONTH ) = DATE_FORMAT(call_end, '%Y-%m-%d') AND mb_no=".$member['mb_no'];	
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
					FROM call_history WHERE MONTH(DATE_SUB( NOW( ), INTERVAL $i MONTH )) = MONTH(call_end) AND YEAR(DATE_SUB( NOW( ), INTERVAL $i MONTH )) = YEAR(call_end) AND mb_no=".$member['mb_no'];
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
                <?php } unset($arrResult); ?>
                </tbody>
            </table>
                
            <table class="table">
            	<tbody>
            	<tr>
                	<th>Daily</th>  
                    <?php $qryStr=""; mysql_data_seek($rheader, 0); while($row = sql_fetch_array($rheader)){ 
							$arrResult[] = array( $row['result_id'] => $row['result_name']);
							$qryStr .= "SUM(CASE WHEN result_id=".$row['result_id']." AND mb_no = ".$member['mb_no']." THEN 1 ELSE 0 END) as result_".$row['result_id'].", ";
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
					
					//$dtFirstDay = date("Y-m-d", mktime(0, 0, 0, date("m")-$i , date("d")-date("d")+1, date("Y")));
					//$dtLastDay = date("Y-m-d", mktime(0, 0, 0, date("m")-$i+1 , date("d")-date("d"), date("Y"))); 
					$dtFirstDay = date("Y-m-d", mktime(0, 0, 0, date("m")-$i , date("d")-date("d")+1, date("Y")));					
					$dtLastDay = date('Y-m-d',strtotime('-1 second',strtotime('+1 month',strtotime(date('m')-$i.'/01/'.date('Y').' 00:00:00'))));; 
					
					$rtable = sql_query("CREATE TEMPORARY TABLE IF NOT EXISTS calendar (datefield DATE);");
					$rtable = sql_query("CALL fill_calendar('$dtFirstDay', '$dtLastDay');");	
										
					$qry = "SELECT calendar.datefield, $qryStr 
						DATE_SUB(DATE_FORMAT( NOW( ) , '%Y-%m-%d' ) , INTERVAL $i MONTH ) as showMonth,
						SEC_TO_TIME(SUM(TIME_TO_SEC(IF(result_id=1 AND mb_no = ".$member['mb_no'].",CAST( call_duration AS TIME
					),'00:00:00')))) as rTime,
					SUM(CASE WHEN sms=1 AND mb_no = ".$member['mb_no']." THEN 1 ELSE 0 END) as cntSMS, 
					SUM(CASE WHEN email=1 AND mb_no = ".$member['mb_no']." THEN 1 ELSE 0 END) as cntEmail,
					SUM(CASE WHEN call_end<>'' AND mb_no =".$member['mb_no']."
					  THEN 1
					  ELSE 0
					  END) AS isCall 
					FROM calendar 
					LEFT JOIN call_history ON calendar.datefield = DATE_FORMAT(call_end, '%Y-%m-%d' )
					 WHERE 
					 MONTH(DATE_SUB( NOW( ), INTERVAL $i MONTH )) = MONTH(calendar.datefield) AND 
					 YEAR(DATE_SUB( NOW( ), INTERVAL $i MONTH )) = YEAR(calendar.datefield) 
					 GROUP BY calendar.datefield ";

					//echo $qry."<br><br>";
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
include_once("./_tail.php");
?>
