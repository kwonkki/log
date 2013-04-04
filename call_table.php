<?
include_once("./_common.php");
$strwhere ="";

//echo "<pre>";
//print_r($_POST);
//echo "</pre>";

if($_POST['search']!=""){
	$strwhere ="WHERE call_log.username LIKE '".$_POST['search']."%'";
}

if($_POST['search']!=""){
	$connector = " AND ";	
}else{
	$connector = " WHERE ";
}

if($_POST['start']!="" && $_POST['end']!=""){
$concatstr = "$connector date_format(call_log.call_end,'%Y-%m-%d') BETWEEN '".$_POST['start']."' AND '".$_POST['end']."'";
}

if($_POST['search']!="" || ($_POST['start']!="" && $_POST['end']!="")){
	$connector = " AND ";	
}else{
	$connector = " WHERE ";
}

if(isset($_POST['agent_ids'])){
 $concatstr .= " $connector call_log.mb_no IN(".implode(",",$_POST['agent_ids']).")";
} 

if($_POST['search']!="" || ($_POST['start']!="" && $_POST['end']!="") || isset($_POST['agent_ids'])){
	$connector = " AND ";	
}else{
	$connector = " WHERE ";
}

if(isset($_POST['call_type'])){
 $concatstr .= " $connector call_log.call_type IN('".implode("','",$_POST['call_type'])."')";
}

if($_POST['search']!="" || ($_POST['start']!="" && $_POST['end']!="") || isset($_POST['agent_ids']) || isset($_POST['call_type'])){
	$connector = " AND ";	
}else{
	$connector = " WHERE ";
}

if(isset($_POST['call_outcome'])){
 $concatstr .= " $connector call_log.outcome_id IN('".implode("','",$_POST['call_outcome'])."')";
}

if($_POST['search']!="" || ($_POST['start']!="" && $_POST['end']!="") || isset($_POST['agent_ids']) || isset($_POST['call_type']) || isset($_POST['call_outcome'])){
	$connector = " AND ";	
}else{
	$connector = " WHERE ";
}

if(isset($_POST['call_result'])){
 $concatstr .= " $connector call_log.result_id IN('".implode("','",$_POST['call_result'])."')";
}

// total_count
//$sql_total = " select call_log.id from call_log LEFT JOIN call_history  ON call_log.id=call_history.call_id $strwhere $concatstr GROUP BY call_log.id";
$sql_total = " select call_log.id from call_log $strwhere $concatstr ";
$result_total = sql_query($sql_total);    
$total_count = mysql_num_rows($result_total);
 
 
$total_rows = 10;
$total_page  = ceil($total_count / $total_rows);  // total page calculation
 
$page = "";
// $_POST['paginate']
$page =  trim($_POST['paginate']);

if (!$page) { $page = 1; } // if no page, staring 1 page
$from_record = ($page - 1) *  $total_rows;

//LEFT JOIN call_history  ON call_log.id=call_history.call_id
$sql_query ="SELECT call_log.*, g4_member.mb_nick, g4_member.mb_no,call_category.category_name, call_outcome.outcome_name, call_result.result_name FROM call_log 
						
						LEFT JOIN g4_member  ON call_log.mb_no=g4_member.mb_no
						LEFT JOIN call_category  ON call_log.category_id=call_category.category_id
						LEFT JOIN call_outcome  ON call_log.outcome_id=call_outcome.outcome_id
						LEFT JOIN call_result  ON call_log.result_id=call_result.result_id $strwhere $concatstr  ORDER BY call_log.call_start DESC limit $from_record, $total_rows ";
					
$call_log = sql_query($sql_query);


//echo $sql_query;

						
$write_pages = get_paging_jquery($config[cf_write_pages], $page, $total_page);


?>




<table  class="table table-striped" style="border:1px solid #CCC">
                    <thead>
                        <tr>
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
                          <th>&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>  
                    	<?php while($row = sql_fetch_array($call_log)){ ?>                    
                        <tr data-status="<?php if($row['call_status']==2){echo 2;}elseif($row['call_status']==3){echo 3;}?>" id="<?php echo $row['id'];?>" class="tblmain <?php if($row['call_status']==2){echo "error";}elseif($row['call_status']==3){echo "info";}?>">
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
                            <td><button href="#" class="btn <?php if($row['email']==1){ echo "btn-success"; }else{echo "btn-inverse";}?>"><span class="add-on">
<i class="icon-envelope icon-white"></i>
</span></button></td>
                            <td><button href="#" class="btn <?php if($row['sms']==1){ echo "btn-success"; }else{echo "btn-inverse";}?>"><span class="add-on">
<i class="icon-volume-down icon-white"></i>
</span></button></td>
                            <td><?php echo $row['result_name'];?></td>
                            <td><?php echo $row['call_duration'];?></td>
                            <td><div style="width:80px"><a title="Comment" class="modalcomment btn <?php if($row['comment']!=""){ echo "btn-success"; }else{echo "btn-inverse";}?>" href="#myModal4" name="<?php echo $row['comment'];?>" data-toggle="modal"><i class="icon-comment icon-white" ></i></a> <a title="Follow up" alt="Follow up" class="modaldtl btn btn-inverse" href="#myModal2" name="<?php echo $row['id'];?>"><i class="icon-info-sign icon-white" ></i></a></div></td>                      
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
                
                <?php if($total_page>1) echo $write_pages;?>
                <script>
				$('.modaldtl').click(function(e) {	
					$('#myModal2').modal({keyboard: false, backdrop: "static"});
					$('#tblhistory').load("call_history.php", { 'call_id': $(this).attr("name") });
					$('#followid').val($(this).attr("name"));
					//e.stopPropagation();
		
    });
				$('.modalcomment').click(function() {							
					var strcomment = "No Comment";		
					if($(this).attr("name")!=""){
						strcomment = $(this).attr("name");
					}
					$('#divmaincomment').html(strcomment);	
				});
				$('#tblCall .pagination a').click(function() {
					$("#paginate").val($(this).attr("rel"));
					loadall();
				});
				
				</script>