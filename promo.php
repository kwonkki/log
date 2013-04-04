<?
include_once("./_common.php");

$g4['title'] = "";
include_once("./_head.php");



if ( !($is_admin == "super") ) {
	alert("you are not allowed to access this page", "{$g4['path']}");	
}





$sql_total = " 	select *             
				from event_list 
         ";

       
$result_total = sql_query($sql_total);
$total_count = mysql_num_rows($result_total);






$sql =  " 	select *             
				from event_list 
				order by seq desc 
         ";
$result = sql_query($sql);    







?>
<link rel="stylesheet" href="<?=$g4['path']?>/adm/admin.style.css" type="text/css">
<style type="text/css">
.item { margin:0 0 10px 0; }
/* pagination */
.paginate { padding:15px 0; text-align:center;}
.paginate a,
.paginate strong { position:relative; display:inline-block; margin-right:1px; padding:3px 3px 5px 3px; color:#000; text-decoration:none; top:1px; _top:-3px; border:1px solid #ffffff; font:bold 13px/normal Verdana; _width /**/:26px;}
.paginate strong { color:#f23219 !important; border:1px solid #e9e9e9;}
.paginate .pre { margin-right:9px; padding:7px 6px 5px 6px; _padding-bottom:3px; background:url(img/bu_pg3_l_off.gif) no-repeat 6px 9px !important;}
.paginate .next { margin-left:9px; padding:7px 6px 5px 6px; _padding-bottom:3px; background:url(img/bu_pg3_r_off.gif) no-repeat 36px 9px !important;}
*:first-child+html .paginate .pre,
*:first-child+html .paginate .next { top:-1px; padding-bottom:3px;}
.paginate a.pre { background:url(img/bu_pg3_l_on.gif) no-repeat 6px 9px !important;}
.paginate a.next { background:url(img/bu_pg3_r_on.gif) no-repeat 37px 9px !important;}
.paginate .pre,
.paginate .next { display:inline-block; color:#ccc; border:1px solid #e9e9e9; position:relative; top:1px; _top:-2px; font:12px/normal , Gulim; _width /**/:50px;  _height /**/:26px;}
.paginate a.pre,
.paginate a.next { color:#565656;}
.paginate a:hover { background-color:#f7f7f7 !important; border:1px solid #e9e9e9;}

.paginate .pre_all { margin-right:6px; padding:7px 6px 5px 6px; _padding-bottom:1px; background:url(img/bu_pg3_l_off.gif) no-repeat 6px 9px !important; letter-spacing:-1px;}
.paginate .next_all { margin-left:4px; padding:7px 6px 5px 6px; _padding-bottom:1px; background:url(img/bu_pg3_r_off.gif) no-repeat 36px 9px !important; letter-spacing:-1px;}
.paginate a.pre_all { background:url(img/bu_pg3_l_on.gif) no-repeat 6px 9px !important;}
.paginate a.next_all { background:url(img/bu_pg3_r_on.gif) no-repeat 36px 9px !important;}
.paginate .pre_all, .paginate .next_all { display:inline-block; color:#ccc; border:1px solid #e9e9e9; position:relative; top:0; _top:-2px; font:12px/normal , Gulim; _width /**/:50px;  _height /**/:26px;}
.paginate a.pre_all,
.paginate a.next_all { color:#565656;}
/* common attributes for all the links */
.pagination a {
    padding: 4px;
    border: 1px solid #AAA;
    color: #333;
    text-decoration: none;
    margin-right: 2px;
    display: block;
    float: left;
    -webkit-border-radius: 6px;
    -moz-border-radius: 6px;
    border-radius: 6px;
}
.pagination .cur{
	padding: 4px;
    border: 1px solid #AAA;
    color: #333;
    text-decoration: none;
    margin-right: 2px;
    display: block;
    float: left;
    -webkit-border-radius: 6px;
    -moz-border-radius: 6px;
    border-radius: 6px;
   
}

/* common attributes for the "next page" and "previous page" links */
.pagination a.navigation {
    width: 16px;
    background-position: center center;
    background-repeat: no-repeat;
    text-indent: -9000px;
    border: 1px solid transparent;
    overflow: hidden
}

/* hack for transparent borders in IE6 */
*html .pagination a.navigation {
    border-color: #000001;
    filter: chroma(color=#000001);
}

/* hovered links */
.pagination a:hover {
    background-color: #DEDEDE;
    color: #222;
}

/* specific attributes for the "next page" and "previous page" links */
.pagination a.left { background-image: url(larrow.gif) }
.pagination a.right { background-image: url(rarrow.gif) }

/*  currently selected page; also, the current page doesn't need a hover effect */
.pagination a.current,
.pagination a.current:hover {
    background: #0094D6;
    border-color: #0094D6;
    color: #FFF;
}

/* the "..." separator */
.pagination span {
    color: #666;
    margin-right: 2px;
    display: block;
    float: left;
    padding: 8px 4px
}

/* disabled links */
a.disabled {
    filter: alpha(opacity=20);
    -khtml-opacity: 0.2;
    -moz-opacity: 0.2;
    opacity: 0.2
}
</style>
<script>
// POST 방식으로 삭제
function post_delete(action_url, val)
{
	var f = document.fpost;

	if(confirm("Do you really want to delete this?\n\n If so, click Ok")) {
        f.seq.value = val;
		f.action         = action_url;
		f.submit();
	}
}
</script>

<img src="<?=$g4['path']?>/img/icon/big/Dots.gif" style="float : left; margin-right : 5px;"><h1>Promotion Management</h1>
<div style="clear:both"></div>

<table width=100%>
<tr>
    <td width=50% align=left>Available Registration Promotion : <?=number_format($total_count)?> </td>
    <td width=50% align=right></td>
</tr>
</table>
<!-- STR : index -->
	<table width="100%" cellpadding="0" cellspacing="0" id="adminTable">
	<colgroup width="50"></colgroup>
	<colgroup width="100"></colgroup>
	<colgroup width=""></colgroup>
	<colgroup width="200"></colgroup>


	<thead>
	<tr>
		<td colspan="15" class="line1"></td></tr>
		<tr class="bgcol1 bold col1 ht center">
			<td>&nbsp</td>
			<td><a href="#">seq</a></td>
			<td><a href="#">event</a></td>
			<td><a href="#">reg date</a></td>		
		</tr>
	</thead>
	<tbody>
		<?
			for ($i=0; $row=sql_fetch_array($result); $i++) {
			
			
			// modify button
			$s_mod = "<a href=\"javascript:post_delete('$g4[path]/promo_delete.php','$row[seq]')\"><img src='$g4[admin_path]/img/icon_delete.gif' border=0 title='delete' ></a>";

					
		?>
		<tr class="list0 col1 ht center">
			<td><?=$s_mod ?></td>
			<td title="center"><nobr style="display:block; overflow:hidden; width:90;"><?= $row['seq'] ?></nobr></td>
			<td align="center"><nobr style="display:block; overflow:hidden; width:100%;"><?= $row['event'] ?></nobr></td>
			<td align="center"><nobr style="display:block; overflow:hidden; width:100%;"><?= $row['reg_date'] ?></nobr></td>
		</tr>
		<?
			}
		?>
		<tr><td colspan="15" class="line2"></td></tr>

	</tbody>
	</table>

	<!-- END : index -->
</table>


<table width="100%" cellpadding="3" cellspacing="1">
	<tbody>
		<tr>
		<td width="50%">
			<input type="button" class="btn1" value="Promotion registration" onclick="javascript:location.replace('./promo_form.php');">&nbsp;
		</td>
		
		<td width="50%" align="right">
			<span class="pre_all cur"></span>
			<span class="pre cur"></span>
			<span class="next cur"></span>
			<span class="next_all cur"></span>
		</td>
		</tr>
	</tbody>
</table>

<form name="fpost" method="post">
<input type="hidden" name="seq">
</form>

<?
include_once("./_tail.php");
?>
