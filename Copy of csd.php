<?
include_once("./_common.php");

$g4['title'] = "";
include_once("./_head.php");


$sql = " 	select
					e.seq 			as seq,
					a.event_seq 	as event_seq,
					a.assignor 		as assignor,
					a.assign_date	as assign_date,
					a.csd			as csd,
					a.call_content	as call_content,
					a.call_date		as call_date,
					a.csd_displayYN	as csd_displayYN,
					e.event			as event,
					e.mb_email		as mb_email,
					e.mb_number		as mb_number,
					e.country		as country,
					e.reg_date		as reg_date
			from event_assign a
			left join event e
			on a.event_seq = e.seq
			where csd_displayYN = '1' and call_date = '0000-00-00 00:00:00' and csd = '$member[mb_nick]' 
			order by assign_date asc, event desc  
		   ";
$result = sql_query($sql);    



$colspan = "4";

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


table {
    *border-collapse: collapse; /* IE7 and lower */
    border-spacing: 0;
    width: 100%;    
}

.bordered {
    border: solid #ccc 1px;
    -moz-border-radius: 6px;
    -webkit-border-radius: 6px;
    border-radius: 6px;
    -webkit-box-shadow: 0 1px 1px #ccc; 
    -moz-box-shadow: 0 1px 1px #ccc; 
    box-shadow: 0 1px 1px #ccc;         
}

.bordered tr:hover {
    background: #fbf8e9;
    -o-transition: all 0.1s ease-in-out;
    -webkit-transition: all 0.1s ease-in-out;
    -moz-transition: all 0.1s ease-in-out;
    -ms-transition: all 0.1s ease-in-out;
    transition: all 0.1s ease-in-out;     
}    
    
.bordered td, .bordered th {
    border-left: 1px solid #ccc;
    border-top: 1px solid #ccc;
    padding: 10px;
         
}

.bordered th {
    background-color: #dce9f9;
    background-image: -webkit-gradient(linear, left top, left bottom, from(#ebf3fc), to(#dce9f9));
    background-image: -webkit-linear-gradient(top, #ebf3fc, #dce9f9);
    background-image:    -moz-linear-gradient(top, #ebf3fc, #dce9f9);
    background-image:     -ms-linear-gradient(top, #ebf3fc, #dce9f9);
    background-image:      -o-linear-gradient(top, #ebf3fc, #dce9f9);
    background-image:         linear-gradient(top, #ebf3fc, #dce9f9);
    -webkit-box-shadow: 0 1px 0 rgba(255,255,255,.8) inset; 
    -moz-box-shadow:0 1px 0 rgba(255,255,255,.8) inset;  
    box-shadow: 0 1px 0 rgba(255,255,255,.8) inset;        
    border-top: none;
    text-shadow: 0 1px 0 rgba(255,255,255,.5); 
}

.bordered td:first-child, .bordered th:first-child {
    border-left: none;
}

.bordered th:first-child {
    -moz-border-radius: 6px 0 0 0;
    -webkit-border-radius: 6px 0 0 0;
    border-radius: 6px 0 0 0;
}

.bordered th:last-child {
    -moz-border-radius: 0 6px 0 0;
    -webkit-border-radius: 0 6px 0 0;
    border-radius: 0 6px 0 0;
}

.bordered th:only-child{
    -moz-border-radius: 6px 6px 0 0;
    -webkit-border-radius: 6px 6px 0 0;
    border-radius: 6px 6px 0 0;
}

.bordered tr:last-child td:first-child {
    -moz-border-radius: 0 0 0 6px;
    -webkit-border-radius: 0 0 0 6px;
    border-radius: 0 0 0 6px;
}

.bordered tr:last-child td:last-child {
    -moz-border-radius: 0 0 6px 0;
    -webkit-border-radius: 0 0 6px 0;
    border-radius: 0 0 6px 0;
}

.CountOn{
	background-color : #ddd;
	
}
.displayShow{
	
}

</style>
<script>
$('.bordered tr').mouseover(function(){
    $(this).addClass('highlight');
}).mouseout(function(){
    $(this).removeClass('highlight');
});
</script>

<img src="<?=$g4['path']?>/img/icon/big/Dots.gif" style="float : left; margin-right : 5px;"><h1>CSD</h1>
<div style="clear:both"></div>


<table class="bordered">
		<colgroup width="200"></colgroup>
		<colgroup width="300"></colgroup>
		<colgroup width=""></colgroup>
		<colgroup width=""></colgroup>
    <thead>


    <tr>
        <th>seq</th>        
        <th>event</th>        
        <th>assignor</th>        
        <th>assign date</th>        
    </tr>

    </thead>
    <tbody>
    <?
    	$row_count = mysql_num_rows($result);
    	
    	if(!$row_count)
    		echo "<tr><td colspan=$colspan align=center>no data</td></tr>";
    
    
		for ($i=0; $row=sql_fetch_array($result); $i++) {
	?>
    <tr style="cursor:pointer;" onclick="show_layer(<?= $row['seq'] ?>);">
        <td align="center"><?= $row['seq'] ?></td>        
        <td align="center"><?= $row['event'] ?></td>        
        <td align="center"><?= $row['assignor'] ?></td>        
        <td align="center"><?= $row['assign_date'] ?></td>        
    </tr>
    <tr id="lineX" style="display : none" class="row<?= $row['seq'] ?>"> 
    	<td colspan=<?=$colspan?> align=center>
			<div>mb_id 		: <?= $row['mb_id']?></div>
			<div>mb_email 	: <?= $row['mb_email']?></div>
			<div>mb_number	: <?= $row['mb_number']?></div>
			<div>country	: <?= $row['country']?></div>
		</td>
	</tr>
    <?
	}
	?>     
 

</tbody></table>

<script>

function show_layer(no)
{
	
	var myArticle = $(".row"+no);
	
	 if( $(".CountOn").length >= 1 ){
	 	$(".CountOn").fadeOut("fast");
	 	myArticle.stop().addClass('CountOn').fadeIn('fast');
	 	return;
	 }
	

	
	// open	
	if(myArticle.is(':hidden')){
		myArticle.stop().addClass('CountOn').fadeIn('fast');
	}else{		//close
		myArticle.stop().fadeOut("fast");
	}
}


</script>


<?
include_once("./_tail.php");
?>
