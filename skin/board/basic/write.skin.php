<? include "css.php" ?>
<?
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

if ($is_dhtml_editor) {
    include_once("$g4[path]/lib/cheditor4.lib.php");
    echo "<script src='$g4[cheditor4_path]/cheditor.js'></script>";
    echo cheditor1('wr_content', '100%', '250');
}
?><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>



<style type="text/css">
.write_head { height:30px; text-align:center; color:#8492A0; }
.field { border:1px solid #ccc; }
.table1 { border:1px solid #f1f1f1; }
.w1 { font-weight:bold; height:30px; background:#fbfbfb; padding:5px 5px 5px 5px; }
.w2 { height:30px; color:#888888; background:#fbfbfb; padding:7px 5px 0px 5px; }
.w_input { font-family:; font-size:9pt; color:#454545; border-top:1px solid #ababab;  border-bottom:1px solid #dfdfdf; border-left:1px solid #ababab; border-right:1px solid #dfdfdf; height:21px;}
</style>

<script language="javascript">
// 글자수 제한
var char_min = parseInt(<?=$write_min?>); // 최소
var char_max = parseInt(<?=$write_max?>); // 최대
</script>

<form name="fwrite" method="post" onsubmit="return fwrite_submit(this);" enctype="multipart/form-data" style="margin:0px;">
<input type=hidden name=null> 
<input type=hidden name=w        value="<?=$w?>">
<input type=hidden name=bo_table value="<?=$bo_table?>">
<input type=hidden name=wr_id    value="<?=$wr_id?>">
<input type=hidden name=sca      value="<?=$sca?>">
<input type=hidden name=sfl      value="<?=$sfl?>">
<input type=hidden name=stx      value="<?=$stx?>">
<input type=hidden name=spt      value="<?=$spt?>">
<input type=hidden name=sst      value="<?=$sst?>">
<input type=hidden name=sod      value="<?=$sod?>">
<input type=hidden name=page     value="<?=$page?>">

<div align="center">

<table width="<?=$width?>" cellpadding=0 cellspacing=0>
	<tr>
		<td>
		<div style="border:1px solid #ddd; height:34px; background:url(<?=$board_skin_path?>/img/title_bg.gif) repeat-x;">
			<div style="font-weight:bold; font-size:12px; margin:10px 0 0 10px;"><?=$title_msg?></div>
		</div>
		<div style="height:3px; background:url(<?=$board_skin_path?>/img/title_shadow.gif) repeat-x; line-height:1px; font-size:1px;">
		</div>
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr height="6">
				<td></td>
			</tr>
		</table>
<?
if(!$member[mb_id]){
?>
		<table width="100%" border="0" cellspacing="0" cellpadding="0" class="table1">
			<tr>
				<td width="2" class="w1"></td>
		<? if ($is_name) { ?>
				<td width="60" class="w1"><?php echo $lang['65'];?></td>
				<td width="60" class="w1">
				<input class='w_input' maxlength=20 size=12 name=wr_name itemname="<?php echo $lang['65'];?>" required value="<?=$name?>"></td>
		<? } ?>
		<? if ($is_password) { ?>
				<td width="60" class="w1"><?php echo $lang['96'];?></td>
				<td width="60" class="w1">
				<input class='w_input' type=password maxlength=20 size=12 name=wr_password itemname="<?php echo $lang['96'];?>" <?=$password_required?>></td>
		<? } ?>
		<? if ($is_guest) { ?>
				<td width="120" rowspan="2" class="w1">
				<img id='kcaptcha_image' border='0' onclick="imageClick();" style="cursor:pointer;" title=""></td>
				<td class="w2"><span style="color:#333333;font-weight:bold; "><?php echo $lang['94'];?></span><br><?php echo $lang['95'];?></td>
		<? } ?>
				<td class="w1">&nbsp;</td>
			</tr>
			<tr>
				<td width="2" class="w1"></td>
		<? if ($is_email) { ?>
				<td width="60" class="w1"><?php echo $lang['98'];?></td>
				<td width="60" class="w1">
				<input class='w_input' maxlength=20 size=12 name=wr_email email itemname="<?php echo $lang['98'];?>" value="<?=$email?>"></td>
		<? } ?>
		<? if ($is_homepage) { ?>
				<td width="60" class="w1"><?php echo $lang['99'];?></td>
				<td width="60" class="w1">
				<input class='w_input' maxlength=20 size=12 name=wr_homepage itemname="<?php echo $lang['99'];?>" value="<?=$homepage?>"></td>
		<? } ?>
		<? if ($is_guest) { ?>
				<td class="w1">
				<input class='w_input' type=input size=22 name=wr_key itemname="<?php echo $lang['94'];?>" required></td>
		<? } ?>
				<td class="w1">&nbsp;</td>
			</tr>
		</table>
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr height="6">
				<td></td>
			</tr>
		</table>
<? } ?>
<? 
$option = "";
$option_hidden = "";
if ($is_notice || $is_html || $is_secret || $is_mail) { 
    $option = "";
    if ($is_notice) { 
        $option .= "<input type=checkbox name=notice value='1' $notice_checked>{$lang[265]}&nbsp;";
    }

    if ($is_html) {
        if ($is_dhtml_editor) {
            $option_hidden .= "<input type=hidden value='html1' name='html'>";
        } else {
            $option .= "<input onclick='html_auto_br(this);' type=checkbox value='$html_value' name='html' $html_checked><span class=w_title>html</span>&nbsp;";
        }
    }

    if ($is_secret) {
        if ($is_admin || $is_secret==1) {
            $option .= "<input type=checkbox value='secret' name='secret' $secret_checked><span class=w_title>{$lang[92]}</span>&nbsp;";
        } else {
            $option_hidden .= "<input type=hidden value='secret' name='secret'>";
        }
    }
    
    if ($is_mail) {
        $option .= "<input type=checkbox value='mail' name='mail' $recv_email_checked>{$lang[266]}&nbsp;";
    }
}

echo $option_hidden;
?>
		<table width="100%" border="0" cellspacing="0" cellpadding="0" class="table1">
			<tr>
				<td width="2" class="w1"></td>
		<? if ($is_category) { ?>
				<td width="60" class="w1"><?php echo $lang['100'];?></td>
				<td width="90" class="w1">
				<select name=ca_name required itemname="<?php echo $lang['100'];?>">
				<option value=""><?php echo $lang['101'];?><?=$category_option?></select></td>
		<? } ?>
		<?if ($option) {?>
				<td width="45" class="w1"><?php echo $lang['102'];?></td>
				<td class="w1"><?=$option?></td>
		<? } ?>
				<td class="w1">&nbsp;</td>
			</tr>
		</table>
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr height="6">
				<td></td>
			</tr>
		</table>
		<table width="100%" border="0" cellspacing="0" cellpadding="0" class="table1" id="table3">
			<tr>
				<td width="2" class="w1"></td>
				<td width="60" class="w1"><?php echo $lang['103'];?></td>
				<td class="w1">
						            
            <select name='wr_1' id='wr_1' required itemname='<?php echo $lang['103'];?>' onchange='change_subject();'>
            <option value=''><?php echo $lang['104'];?>
            <option value=''>----
            <option value='black' style='color:black;'>■■■■■■■■■■
            <option value='red' style='color:red;'>■■■■■■■■■■
            <option value='#ff9900' style='color:#ff9900;'>■■■■■■■■■■
            <option value='#B3A14D' style='color:#B3A14D;'>■■■■■■■■■■
            <option value='green' style='color:green;'>■■■■■■■■■■
            <option value='#0033FF' style='color:#0033FF;'>■■■■■■■■■■
            <option value='#000099' style='color:#000099;'>■■■■■■■■■■
            <option value='#9900CC' style='color:#9900CC;'>■■■■■■■■■■
            </select>
            <script>document.getElementById('wr_1').value = '<?=$write[wr_1]?>';</script>
            
            	<input type=checkbox name=wr_2 value="1" <?=$write[wr_2]?>><?php echo $lang['105'];?></td>
			</tr>
		</table>
		<table width="100%" border="0" cellspacing="0" cellpadding="0" id="table2">
			<tr height="6">
				<td></td>
			</tr>
		</table>
		<table width="100%" border="0" cellspacing="0" cellpadding="0" class="table1">
			<tr>
				<td width="2" class="w1"></td>
				<td width="60" class="w1"><?php echo $lang['59'];?></td>
				<td class="w1">
				<input class='w_input' style="width:100%;" name=wr_subject id="wr_subject" itemname="<?php echo $lang['59'];?>" required value="<?=$subject?>"></td>
			</tr>
		</table>
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr height="6">
				<td></td>
			</tr>
		</table>
		<table width="100%" border="0" cellspacing="0" cellpadding="0" class="table1">
			<tr>
				<td width="2" class="w1"></td>
				<td width="60" class="w1"><?php echo $lang['64'];?></td>
				<td class="w1">
		<? if ($is_dhtml_editor) { ?>
            <?=cheditor2('wr_content', $content);?>
        <? } else { ?>
        		<table width=100% cellpadding=0 cellspacing=0>
					<tr>
						<td width=50% align=left valign=bottom>
						<span style="cursor: pointer;" onclick="textarea_decrease('wr_content', 10);">
						<img src="<?=$board_skin_path?>/img/up.gif"></span>
						<span style="cursor: pointer;" onclick="textarea_original('wr_content', 10);">
						<img src="<?=$board_skin_path?>/img/start.gif"></span>
						<span style="cursor: pointer;" onclick="textarea_increase('wr_content', 10);">
						<img src="<?=$board_skin_path?>/img/down.gif"></span></td>
						<td width=50% align=right><? if ($write_min || $write_max) { ?><span id=char_count></span><?php echo $lang['106'];?><?}?></td>
					</tr>
				</table>
				<textarea id="wr_content" name="wr_content" class=tx style='width:100%; word-break:break-all;' rows=10 itemname="<?php echo $lang['64'];?>" required 
        <? if ($write_min || $write_max) { ?>onkeyup="check_byte('wr_content', 'char_count');"<?}?>><?=$content?></textarea>
        <? if ($write_min || $write_max) { ?><script language="javascript"> check_byte('wr_content', 'char_count'); </script><?}?>
        <? } ?>
		</td>
			</tr>
		</table>

<? if ($is_link) { ?>
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr height="6">
				<td></td>
			</tr>
		</table>
		<table width="100%" border="0" cellspacing="0" cellpadding="0" class="table1" id="table1">
			<tr>
				<td width="2" class="w1"></td>
				<td width="60" class="w1">
				<span onclick="add_file();" style="cursor:pointer;">
				<img src="<?=$board_skin_path?>/img/btn_file_add.gif"></span>
				<span onclick="del_file();" style="cursor:pointer;">
				<img src="<?=$board_skin_path?>/img/btn_file_minus.gif"></span></td>
				<td class="w1">
				<table id="variableFiles" cellpadding=0 cellspacing=0>
				</table><?// print_r2($file); ?>
        <script language="JavaScript">
        var flen = 0;
        function add_file(delete_code)
        {
            var upload_count = <?=(int)$board[bo_upload_count]?>;
            if (upload_count && flen >= upload_count)
            {
                alert("<?php echo $lang['107'];?>");
                return;
            }

            var objTbl;
            var objRow;
            var objCell;
            if (document.getElementById)
                objTbl = document.getElementById("variableFiles");
            else
                objTbl = document.all["variableFiles"];

            objRow = objTbl.insertRow(objTbl.rows.length);
            objCell = objRow.insertCell(0);

            objCell.innerHTML = "<input type='file' class='ed' name='bf_file[]' title='<?php echo $lang['108'];?> <?=$upload_max_filesize?> <?php echo $lang['109'];?>'>";
            if (delete_code)
                objCell.innerHTML += delete_code;
            else
            {
                <? if ($is_file_content) { ?>
                objCell.innerHTML += "<br><input type='text' class='ed' size=50 name='bf_content[]' title='<?php echo $lang['110'];?>'>";
                <? } ?>
                ;
            }

            flen++;
        }

        <?=$file_script; //수정시에 필요한 스크립트?>

        function del_file()
        {
            // file_length 이하로는 필드가 삭제되지 않아야 합니다.
            var file_length = <?=(int)$file_length?>;
            var objTbl = document.getElementById("variableFiles");
            if (objTbl.rows.length - 1 > file_length)
            {
                objTbl.deleteRow(objTbl.rows.length - 1);
                flen--;
            }
        }
        </script></td>
			</tr>
		</table>
<? } ?>

<? if ($is_trackback) { ?>
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr height="6">
				<td></td>
			</tr>
		</table>
		<table width="100%" border="0" cellspacing="0" cellpadding="0" class="table1" id="table1">
			<tr>
				<td width="2" class="w1"></td>
				<td width="60" class="w1"><?php echo $lang['111'];?></td>
				<td class="w1">
				<input class='w_pnput' style="width:100%;" name=wr_trackback itemname="<?php echo $lang['111'];?>" value="<?=$trackback?>"><? if ($w=="u") { ?><input type=checkbox name="re_trackback" value="1"><?php echo $lang['112'];?><? } ?></td>
			</tr>
		</table>
<? } ?>
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td width="100%" align="center" valign="top" style="padding-top:30px;">
				<input type="submit" value="<?=$title_msg?>" name="B1" id="btn_submit" border=0 accesskey='s' class="btn1">&nbsp;
        		<input onclick="location.href='./board.php?bo_table=<?=$bo_table?>';" type="button" value="<?php echo $lang['75'];?>" name="btn_list" class="btn2"></td>
			</tr>
		</table></td>
	</tr>
</table>
</div>
</form>


<script type="text/javascript" src="<?="$g4[path]/js/jquery.kcaptcha.js"?>"?>"?>"?>"?>"?>"?>"?>"?>"?>"?>"?>"?>"?>"?>"?>"?>"?>"?>"?>"?>"?>"?>"></script>
<script type="text/javascript">
<?
// 관리자라면 분류 선택에 '공지' 옵션을 추가함
if ($is_admin) 
{
    echo "
    if (typeof(document.fwrite.ca_name) != 'undefined')
    {
        document.fwrite.ca_name.options.length += 1;
        document.fwrite.ca_name.options[document.fwrite.ca_name.options.length-1].value = '{$lang[265]}';
        document.fwrite.ca_name.options[document.fwrite.ca_name.options.length-1].text = '{$lang[265]}';
    }";
} 
?>

with (document.fwrite) 
{
    if (typeof(wr_name) != "undefined")
        wr_name.focus();
    else if (typeof(wr_subject) != "undefined")
        wr_subject.focus();
    else if (typeof(wr_content) != "undefined")
        wr_content.focus();

    if (typeof(ca_name) != "undefined")
        if (w.value == "u")
            ca_name.value = "<?=$write[ca_name]?>";
}

function html_auto_br(obj) 
{
    if (obj.checked) {
        result = confirm("<?php echo $lang['113'];?>");
        if (result)
            obj.value = "html2";
        else
            obj.value = "html1";
    }
    else
        obj.value = "";
}

function fwrite_submit(f) 
{
    /*
    var s = "";
    if (s = word_filter_check(f.wr_subject.value)) {
        alert("제목에 금지단어('"+s+"')가 포함되어있습니다");
        return false;
    }

    if (s = word_filter_check(f.wr_content.value)) {
        alert("내용에 금지단어('"+s+"')가 포함되어있습니다");
        return false;
    }
    */

    if (document.getElementById('char_count')) {
        if (char_min > 0 || char_max > 0) {
            var cnt = parseInt(document.getElementById('char_count').innerHTML);
            if (char_min > 0 && char_min > cnt) {
                alert("내용은 "+char_min+"글자 이상 쓰셔야 합니다.");
                return false;
            } 
            else if (char_max > 0 && char_max < cnt) {
                alert("내용은 "+char_max+"글자 이하로 쓰셔야 합니다.");
                return false;
            }
        }
    }

    <?
    if ($is_dhtml_editor) echo cheditor3('wr_content');
    ?>

    if (document.getElementById('tx_wr_content')) {
        if (!ed_wr_content.outputBodyText()) { 
            alert('<?php echo $lang['117'];?>'); 
            ed_wr_content.returnFalse();
            return false;
        }
    }

    var subject = "";
    var content = "";
    $.ajax({
        url: "<?=$board_skin_path?>/ajax.filter.php",
        type: "POST",
        data: {
            "subject": f.wr_subject.value,
            "content": f.wr_content.value
        },
        dataType: "json",
        async: false,
        cache: false,
        success: function(data, textStatus) {
            subject = data.subject;
            content = data.content;
        }
    });

    if (subject) {
        alert("<?php echo $lang['115'];?>");
        f.wr_subject.focus();
        return false;
    }

    if (content) {
        alert("<?php echo $lang['116'];?>");
        if (typeof(ed_wr_content) != "undefined") 
            ed_wr_content.returnFalse();
        else 
            f.wr_content.focus();
        return false;
    }

            if (!check_kcaptcha(f.wr_key)) { 
                return false; 
            }

    document.getElementById('btn_submit').disabled = true;
    document.getElementById('btn_list').disabled = true;

    <?
    if ($g4[https_url])
        echo "f.action = '$g4[https_url]/$g4[bbs]/write_update.php';";
    else
        echo "f.action = './write_update.php';";
    ?>
    
    return true;
}
</script>

<script type="text/javascript" src="<?="$g4[path]/js/board.js"?>"?>"?>"?>"?>"?>"?>"?>"?>"?>"?>"?>"?>"?>"?>"?>"?>"?>"?>"?>"?>"?>"?>"></script>
<script type="text/javascript"> window.onload=function() { drawFont(); } </script>
<script language="JavaScript"> 
function errors() 
{ 
 return true; 
} 
window.onerror = errors; 
</script>