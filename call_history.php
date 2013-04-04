<?
include_once("./_common.php");
$strwhere ="";
if($_POST['call_id']!=""){
	$strwhere ="WHERE call_history.call_id = '".$_POST['call_id']."'";
}

// total_count
$sql_total = " select id from call_history $strwhere";
$result_total = sql_query($sql_total);    
$total_count = mysql_num_rows($result_total);
 
 
$total_rows = 5;
$total_page  = ceil($total_count / $total_rows);  // total page calculation
 
$page = "";
// $_POST['paginate']
$page =  trim($_POST['historypage']);

if (!$page) { $page = 1; } // if no page, staring 1 page
$from_record = ($page - 1) *  $total_rows;
							
$call_history = sql_query("SELECT call_history.`id`, call_history.mb_no, call_history.`call_type`, call_history.`call_start`, call_history.`call_end`, call_history.`comment`, call_history.`sms`, call_history.`email`, call_history.`call_duration`, call_history.`call_status`, g4_member.mb_nick,call_category.category_name, call_result.result_name, call_outcome.outcome_name  FROM call_history 
							LEFT JOIN call_log  ON call_history.call_id=call_log.id
							LEFT JOIN g4_member  ON call_history.mb_no=g4_member.mb_no
							LEFT JOIN call_category  ON call_history.category_id=call_category.category_id
							LEFT JOIN call_outcome  ON call_history.outcome_id=call_outcome.outcome_id
							LEFT JOIN call_result  ON call_history.result_id=call_result.result_id $strwhere ORDER BY call_history.call_start DESC limit $from_record, $total_rows");
		
$write_pages = get_paging_jquery($config[cf_write_pages], $page, $total_page);
						
?>
<h3> Call History</h3>
<table  class="table table-striped" style="border:1px solid #CCC">
<thead>
    <tr>                          
      <th>Agent</th>     
      <th>Type</th>                                               
      <th>Category</th>
      <th>Call Date</th>
      <th>Call Stated</th>
      <th>Call Ended</th>
      <th>Outcome</th>
      <th>Email</th>
      <th>SMS</th>
      <th>Call Result</th>
      <th>Call Duration</th>
      <th>Comment</th>                          
    </tr>
</thead>
<tbody>                            
    <?php while($row = sql_fetch_array($call_history)){ ?>                    
    <tr>       
        <td>
		<?php if($member['mb_level']>5){ ?>
			<a href="#" class="aRefUser" data-link-id="<?php echo $row['id'];?>"><?php echo $row['mb_nick'];?></a>
		<?php }else{?>
			<?php echo $row['mb_nick'];?>
		<?php }?>
		</td>        
        <td><?php echo $row['call_type'];?></td>
        <td><?php echo $row['category_name'];?></td>
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
        <td><a class="modalview btn <?php if($row['comment']!=""){ echo "btn-success"; }else{echo "btn-inverse";}?>" title="Comment" alt="Comment" href="#myModal3" name="<?php echo $row['comment'];?>" data-toggle="modal"><i class="icon-comment icon-white" ></i></a></td>                      
    </tr>
    <?php } ?>
</tbody>
</table>
 
<?php if($total_page>1) echo $write_pages;?>

<script>
	$('.modalview').click(function() {	
		var strcomment = "No Comment";		
		if($(this).attr("name")!=""){
			strcomment = $(this).attr("name");
		}
		$('#divcomment').html(strcomment);		
    });
	$('#tblhistory .pagination a').click(function() {
		$("#historypage").val($(this).attr("rel"));
		$('#tblhistory').load("call_history.php", { 'call_id':$('#followid').val(), 'historypage': $("#historypage").val() });					
	});
</script>