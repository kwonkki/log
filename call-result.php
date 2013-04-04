<?
include_once("./_common.php");

$g4['title'] = "";
include_once("./_head.php");

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


<div class="main-body">
	<div class="row">
		  <div class="span12">
		  	<h2>Call Report by Result</h2><br>
               
            <form class="form-horizontal form-inline" method="post">
	           	<div class="control-group">    	                         				
                            <div class="btn-group pull-left">
                              <a class="btn" href="#"><i></i> Call Result</a>
                              <a class="btn dropdown-toggle" data-toggle="dropdown" href="#"><span class="caret"></span></a>
                              <ul class="dropdown-menu ">
                              <?php while($row = sql_fetch_array($rCombo)){ ?>
                                <li>&nbsp;<input type="checkbox" name="chkResult[]" value=" <?php echo $row['result_id'];?>" 
								<?php if(in_array($row['result_id'], ((is_array($_POST['chkResult']))? $_POST['chkResult']: array())  )){?>checked="checked"<?php }?> />  <?php echo $row['result_name'];?></li>
                              <?php } ?>
                              </ul>
                            </div>
                        		  
                        	   
                        	<span class="help-inline">Date Range From </span>
                            <div class="input-append">
                			<input type="text" size="16" id="start" name="start" class="input" value="<?php echo $_POST['start']?>"><a class="btn btn-inverse" href="#" id="startbtn"><i class="icon-calendar icon-white"></i></a>
                            </div>
                            <span class="help-inline"> To </span>
                            <div class="input-append">
                            <input type="text" size="16" id="end" name="end" class="input" value="<?php echo $_POST['end']?>"><a class="btn btn-inverse" href="#" id="endbtn"><i class="icon-calendar icon-white"></i></a>
                            </div>
                            &nbsp;<input class="btn btn-inverse btngo" type="submit" value="Go!">
							
							<input class="btn btn-inverse pull-right btn btnexport" type="submit" value="Export to Excel">
							
              			                                                        		
            	</div>
            
            <table class="table table-striped">
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
            <div class="control-group"> 
                    <div class="btn-group pull-left"> 
                      <a class="btn" href="#"><i></i> Call Outcome</a>                            
                      <a class="btn dropdown-toggle" data-toggle="dropdown" href="#"><span class="caret"></span></a>
                      <ul class="dropdown-menu ">
                      <?php $rOutcome = sql_query("SELECT * FROM call_outcome WHERE result_id='".$row['result_id']."'"); 
					  	while($rowOutcome = sql_fetch_array($rOutcome)){ ?>
                        <li>&nbsp;<input type="checkbox" name="chkOutcome<?php echo $row['result_id']?>[]" value="<?php echo $rowOutcome['outcome_id'];?>" <?php if(in_array($rowOutcome['outcome_id'], ((is_array($_POST['chkOutcome'.$row['result_id']]))? $_POST['chkOutcome'.$row['result_id']] : array())   )){?>checked="checked"<?php }?> />  <?php echo $rowOutcome['outcome_name'];?></li>
                      <?php } ?>
                      </ul>
                    </div>                    
               
                &nbsp; <input class="btn btn-inverse btngo" type="submit" value="Go!">
            </div>
            
            <!--  Table Per Outcome  -->
            <table class="table table-striped">
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
					<th colspan="2">CSD</th>
					<?php foreach($arrOutcome as $k => $v ){ ?> 
                    <th>&nbsp;</th>                   
                    <? } ?>
				</tr>
				<?php }elseif($agentInfo['mb_level']==1 && $isFirstLoad==1){ ?>
				<tr class="warning">
					<th colspan="2">CRM</th>
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
            <table class="table table-striped">
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
					<th colspan="6">CSD</th>					
				</tr>
				<?php }elseif($agentInfo['mb_level']==1 && $isFirstLoad==1){ ?>
				<tr class="warning">
					<th colspan="6">CRM</th>					
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
            <table class="table table-striped">
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
					<th colspan="2">CSD</th>					
				</tr>
				<?php }elseif($agentInfo['mb_level']==1 && $isFirstLoad==1){ ?>
				<tr class="warning">
					<th colspan="2">CRM</th>					
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
	
	 $('.dropdown-menu input, .dropdown-menu label').click(function(e) {
        e.stopPropagation();
    });

	$('.btngo').click(	 
      function(e) {
        $('form').attr('action', '');
      } 
    );
	
	$('.btnexport').click(	 
      function(e) {
        $('form').attr('action', 'call-result-export.php');
      } 
    );
	
</script>
<?
include_once("./_tail.php");
?>
