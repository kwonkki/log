<?
	if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
?>
<?

$sql_search = $member['mb_id'];

$sql = " select `sms_no`, `sms_sender`, `sms_receiver`, `sms_msg`, `sms_result`, `sms_sending_time`, `sms_ip`, `sms_login_id`, `sms_url` 
           from `g4_sms_history`
          WHERE  `sms_login_id` =  '$sql_search'
         ";

       
$result1 = sql_query($sql);


// total_count    
$total_count = mysql_num_rows($result1);
$total_rows = 15;
$total_page  = ceil($total_count / $total_rows);  // 전체 페이지 계산

$page = "";
$page =  trim($_GET['page']);
if (!$page) { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) *  $total_rows; // 시작 열을 구함

// pagination
// 현재페이지, 총페이지수, 한페이지에 보여줄 행, URL
//$write_pages = get_paging($config[cf_write_pages], $page, $total_page, "./board.php?bo_table=$bo_table".$qstr."&page=");
$write_pages = get_paging($config[cf_write_pages], $page, $total_page, "./sms_history.php?page=");


$sql = " select `sms_no`, `sms_sender`, `sms_receiver`, `sms_msg`, `sms_result`, `sms_sending_time`, `sms_ip`, `sms_login_id`, `sms_url` 
           from `g4_sms_history`
          WHERE  `sms_login_id` =  '$sql_search'
          order by `sms_sending_time` DESC
          limit $from_record, $total_rows 
         ";
$result = sql_query($sql);         

?>
<!-- STR : contents -->
<link rel="stylesheet" type="text/css" href="./zebra_pagination.css" />
<div>
	<h1 class="sms_title"><img  src="<?=$g4['path']?>/img/icon/big/Dots.gif" style="vertical-align: text-bottom; margin-right:5px;"></img>SMS History</h1>
</div>
<table border="1" class="sms_data" id="sms_data">
		<colgroup align="center">
		  <col width="25%">
		  <col width="10%">
		  <col width="10%">
		  <col>
		</colgroup>
		<tbody>
		<tr>
			<th>sms_sending_time</th>
			<th>sms_sender</th>
			<th>sms_receiver</th>
			<th>sms_result</th>
		</tr>
		<?
			for ($i=0; $row=sql_fetch_array($result); $i++) {
					
		?>
		<tr>
			<td><?= $row['sms_sending_time'] ?></td>
			<td><?= $row['sms_sender'] ?></td>
			<td><?= $row['sms_receiver'] ?></td>
			<td><?= $row['sms_result'] ?></td>
		</tr>
		<?
			}
		?>
		</tbody>		
		</table>
<!-- 페이지 -->
<div style="margin 0 auto;">
<table width="500px" cellspacing="0" cellpadding="0"style="margin-top:15px;" align="center"> 
<tr >
    <td class="pagination" align="center">
        <? if ($prev_part_href) { echo "<a href='$prev_part_href'><img src='$board_skin_path/img/btn_search_prev.gif' border=0 align=absmiddle title='이전검색'></a>"; } ?>
        <?
        // 기본으로 넘어오는 페이지를 아래와 같이 변환하여 이미지로도 출력할 수 있습니다.
        //echo $write_pages;
        /*
        $write_pages = str_replace("처음", "<img src='$board_skin_path/img/page_begin.gif' border='0' align='absmiddle' title='처음'>", $write_pages);
        $write_pages = str_replace("이전", "<img src='$board_skin_path/img/page_prev.gif' border='0' align='absmiddle' title='이전'>", $write_pages);
        $write_pages = str_replace("다음", "<img src='$board_skin_path/img/page_next.gif' border='0' align='absmiddle' title='다음'>", $write_pages);
        $write_pages = str_replace("맨끝", "<img src='$board_skin_path/img/page_end.gif' border='0' align='absmiddle' title='맨끝'>", $write_pages);
        */
        echo $write_pages;
        ?>
        <? if ($next_part_href) { echo "<a href='$next_part_href'><img src='$board_skin_path/img/btn_search_next.gif' border=0 align=absmiddle title='다음검색'></a>"; } ?>
    </td>
</tr>
</table>
</div>		