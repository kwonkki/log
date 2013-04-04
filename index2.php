<?
include_once("./_common.php");

$g4['title'] = "";
include_once("./_head.php");

$rheader = sql_query("SELECT * FROM call_result");
$agents = sql_query("SELECT mb_no, mb_nick FROM ".$g4['table_prefix']."member");

if($_POST['start']!="" && $_POST['end']!=""){
$concatstr = "AND date_format(call_end,'%Y-%m-%d') BETWEEN '".$_POST['start']."' AND '".$_POST['end']."'";
}
?>


<div class="main-body">
	<div class="row">
		  <div class="span12">
		  	<h2>Agent Summary Report</h2>
            <form class="form-horizontal form-inline" method="post">
	           	<div class="control-group">    	           
              			<div class="input-append">
                        	<span class="help-inline">Date Range From </span>
                			<input type="text" size="16" id="start" name="start" class="input" value="<?php echo $_POST['start']?>"><a class="btn btn-inverse" href="#" id="startbtn"><i class="icon-calendar icon-white"></i></a>
                            <span class="help-inline"> To </span>
                            <input type="text" size="16" id="end" name="end" class="input" value="<?php echo $_POST['end']?>"><a class="btn btn-inverse" href="#" id="endbtn"><i class="icon-calendar icon-white"></i></a>
                            <button type="submit" class="btn btn-inverse">Go!</button>
              			</div>                                                        		
            	</div>
            </form>
            <table class="table table-striped">
            	<tbody>
            	<tr>
                	<th>Agent</th>  
                    <?php $qryStr=""; while($row = sql_fetch_array($rheader)){ 
							$arrResult[] = array( $row['result_id'] => $row['result_name']);
							$qryStr .= "SUM(CASE WHEN result_id=".$row['result_id']." THEN 1 ELSE 0 END) as result_".$row['result_id'].", ";
							 ?>  
                    <th><?php echo $row['result_name']?></th>                    
                    <?php } ?>
                    <th>All</th>
                </tr>
                <?php  while($agentInfo = sql_fetch_array($agents)){
					$qry = "SELECT $qryStr SEC_TO_TIME(SUM(TIME_TO_SEC(IF(result_id=1,CAST( call_duration AS TIME
					),'00:00:00')))) as rTime , SUM(sms) as cntSMS, SUM(email) as cntEmail 
					FROM call_history WHERE mb_no=".$agentInfo['mb_no']. " $concatstr";	
					
					$rtable = sql_query($qry);					
					$row = sql_fetch_array($rtable);	
								
					?>
                <tr>                	
                	<td><a href="agent-details.php?agent=<?php echo $agentInfo['mb_no'] ?>"><?php echo $agentInfo['mb_nick'] ?></a></td>      
                    <?php $totcall =0; foreach($arrResult as $k => $v ){ ?> 
                    <td><?php $a = array_keys($v); $callcount = (($row['result_'.$a[0]]=="")? 0 : $row['result_'.$a[0]]); $totcall += $callcount; $grandtot += $callcount; echo $callcount;  $overall[$a[0]]= $overall[$a[0]]+$callcount; ?></td>                   
                    <? } ?>
                    <td><?php echo (($totcall=="")? 0: $totcall); ?></td>                   
                </tr>
                <?php } ?>
                <tr>
                	<th>All</th>
                    <?php $totcall =0; foreach($arrResult as $k => $v ){ ?> 
                    <th><?php $a = array_keys($v); echo (($overall[$a[0]]=="")? 0: $overall[$a[0]]); ?></th>                   
                    <? } ?>
                    <th><?php echo (($grandtot=="")? 0: $grandtot); ?></th> 
                </tr>
                </tbody>
            </table>            
            
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
</script>
<?
include_once("./_tail.php");
?>
