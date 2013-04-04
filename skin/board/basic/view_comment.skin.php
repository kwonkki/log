<?
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
?>

<script language="JavaScript">
// 글자수 제한
var char_min = parseInt(<?=$comment_min?>); // 최소
var char_max = parseInt(<?=$comment_max?>); // 최대
</script><head>

<style type="text/css">
.write_head { height:30px; text-align:center; color:#8492A0; }
.w1 { font-weight:bold; height:30px; padding:5px 3px 0px 3px; }
.w2 { height:30px; color:#888888; padding:5px 3px 0px 3px; }
.w_input { font-family:; font-size:9pt; color:#454545; border-top:1px solid #ababab;  border-bottom:1px solid #dfdfdf; border-left:1px solid #ababab; border-right:1px solid #dfdfdf; height:21px;}
.w_input2 { font-family:; font-size:9pt; color:#454545; border-top:1px solid #ababab;  border-bottom:1px solid #dfdfdf; border-left:1px solid #ababab; border-right:1px solid #dfdfdf; height:114px;}
</style>

<? if ($cwin==1) { ?><meta http-equiv="Content-Type" content="text/html; charset=utf-8"></head>

<table width=100% cellpadding=10 align=center><tr><td><?}?>

<?
$c_total_count = count($list); // 전체 코멘트 수 할당 
$c_rows = 5; // 보여줄 개수 
if ($c_total_count != 0){ 
$c_total_page  = ceil($c_total_count / $c_rows);  // 전체 페이지 계산 
if (!$c_page) $c_page = 1; // 페이지가 없으면 첫 페이지 (1 페이지) 
$c_from_record = ($c_page - 1) * $c_rows; // 시작 코멘트 구하기 
$c_last_record = $c_from_record + $c_rows; // 끝 코멘트 구하기 
if($c_last_record > $c_total_count){ // 마지막 코멘트가 전체 코멘트 보다 크면 전체 코멘트로 할당 
$c_last_record = $c_total_count; 
} 
} 
?>

<!-- 코멘트 리스트 -->
<div id="commentContents">
<?
for ($i=0; $i<count($list); $i++) {
    $comment_id = $list[$i][wr_id];

$profile_image = "$g4[path]/data/profile_image/{$list[$i][mb_id]}";
if (!$list[$i][mb_id]||!file_exists($profile_image)) { // 회원이 아니거나, 파일이 없으면 noimage 출력
$profile_image = "$board_skin_path/img/noimage.gif";
}
?>
<a name="c_<?=$comment_id?>"></a>
<table width=100% cellpadding=0 cellspacing=0 border=0>
<tr>
    <td><? for ($k=0; $k<strlen($list[$i][wr_comment_reply]); $k++) echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"; ?></td>
    <td width='100%'>

        <table border=0 cellpadding=0 cellspacing=0 width=100%>
        <tr>
            <td height=1 colspan=3 bgcolor="#dddddd"><td>
        </tr>
        <tr>
            <td height=1 colspan=3></td>
        </tr>
        <tr>
            <td width=70 valign=top style="padding-top:6px;">
                <img src="<?=$profile_image?>" width=58 height=58 style="border:3px solid #f2f2f2">
            </td>
            <td width=2 bgcolor="#dedede"></td>
            <td valign=top style="padding-left:5px;">
                <div style="height:28px; background:url(<?=$board_skin_path?>/img/co_title_bg.gif); clear:both;">
                <div style="float:left; margin-top:6px; margin-left:5px;">
                <strong><?=$list[$i][name]?></strong>
				<? if ($is_ip_view) { echo "&nbsp;<span style=\"color:#B2B2B2; font-size:11px;\">({$list[$i][ip]})</span>"; } ?>
                </div>
                <div style="float:right; margin-top:2px;">
                <span style="color:#888888; font-size:11px;"><?=$list[$i][datetime]?></span>&nbsp;
                <? if ($list[$i][is_reply]) { echo "<a href=\"javascript:comment_box('{$comment_id}', 'c');\"><img src='$board_skin_path/img/co_btn_reply.gif' border=0 align=absmiddle alt='{$lang[83]}'></a> "; } ?>
                <? if ($list[$i][is_edit]) { echo "<a href=\"javascript:comment_box('{$comment_id}', 'cu');\"><img src='$board_skin_path/img/co_btn_modify.gif' border=0 align=absmiddle alt='{$lang[81]}'></a> "; } ?>
                <? if ($list[$i][is_del])  { echo "<a href=\"javascript:comment_delete('{$list[$i][del_link]}');\"><img src='$board_skin_path/img/co_btn_delete.gif' border=0 align=absmiddle alt='{$lang[82]}'></a> "; } ?>
                &nbsp;
                </div>
                </div>

                <!-- 코멘트 출력 -->
                <div style='line-height:20px; padding:7px; word-break:break-all;'>
                <?
               if (strstr($list[$i][wr_option], "secret")) echo "<span style='color:#ff6600;'>*</span> ";
                $str = $list[$i][content];
                if (strstr($list[$i][wr_option], "secret"))
                $str = "<span class='small' style='color:#ff6600;'>$str</span>";

                $str = preg_replace("/\[\<a\s.*href\=\"(http|https|ftp|mms)\:\/\/([^[:space:]]+)\.(mp3|wma|wmv|asf|asx|mpg|mpeg)\".*\<\/a\>\]/i", "<script>doc_write(obj_movie('$1://$2.$3'));</script>", $str);
                $str = preg_replace("/\[\<a\s.*href\=\"(http|https|ftp)\:\/\/([^[:space:]]+)\.(swf)\".*\<\/a\>\]/i", "<script>doc_write(flash_movie('$1://$2.$3'));</script>", $str);
                $str = preg_replace("/\[\<a\s*href\=\"(http|https|ftp)\:\/\/([^[:space:]]+)\.(gif|png|jpg|jpeg|bmp)\"\s*[^\>]*\>[^\s]*\<\/a\>\]/i", "<img src='$1://$2.$3' id='target_resize_image[]' onclick='image_window(this);'>", $str);
                echo $str;
                ?>
                </div>
                <? if ($list[$i][trackback]) { echo "<p>".$list[$i][trackback]."</p>"; } ?>
                <span id='edit_<?=$comment_id?>' style='display:none;'></span><!-- 수정 -->
                <span id='reply_<?=$comment_id?>' style='display:none;'></span><!-- 답변 -->
                </div>
                <input type=hidden id='secret_comment_<?=$comment_id?>' value="<?=strstr($list[$i][wr_option],"secret")?>"?>
                <textarea id='save_comment_<?=$comment_id?>' style='display:none;'><?=get_text($list[$i][content1], 0)?></textarea></td>
            </td>
        </tr>
        <tr>
            <td height=5 colspan=3></td>
        </tr>
        </table>

    </td>
</tr>
</table>
<? } ?>

</div>
<!-- 코멘트 리스트 -->

<? if ($is_comment_write) { ?>
<!-- 코멘트 입력 -->
<div id=comment_write style="display:none;">
<table width=100% border=0 cellpadding=1 cellspacing=0 bgcolor="#dddddd"><tr><td>
<form name="fviewcomment" method="post" action="./write_comment_update.php" onsubmit="return fviewcomment_submit(this);" autocomplete="off" style="margin:0px;">
<input type=hidden name=w           id=w value='c'>
<input type=hidden name=bo_table    value='<?=$bo_table?>'>
<input type=hidden name=wr_id       value='<?=$wr_id?>'>
<input type=hidden name=comment_id  id='comment_id' value=''>
<input type=hidden name=sca         value='<?=$sca?>' >
<input type=hidden name=sfl         value='<?=$sfl?>' >
<input type=hidden name=stx         value='<?=$stx?>'>
<input type=hidden name=spt         value='<?=$spt?>'>
<input type=hidden name=page        value='<?=$page?>'>
<input type=hidden name=cwin        value='<?=$cwin?>'>
<input type=hidden name=is_good     value=''>



<table width=100% cellpadding=3 height=156 cellspacing=0 bgcolor="#ffffff" style="border:1px solid #fff; background:url(<?=$board_skin_path?>/img/co_bg.gif) x-repeat;">
<tr>
    <td colspan="2" style="padding:5px 0 0 5px;">
        <span style="cursor: pointer;" onclick="textarea_decrease('wr_content', 8);"><img src="<?=$board_skin_path?>/img/co_btn_up.gif" border='0'></span>
        <span style="cursor: pointer;" onclick="textarea_original('wr_content', 8);"><img src="<?=$board_skin_path?>/img/co_btn_init.gif" border='0'></span>
        <span style="cursor: pointer;" onclick="textarea_increase('wr_content', 8);"><img src="<?=$board_skin_path?>/img/co_btn_down.gif" border='0'></span>
		<input type=checkbox id="wr_secret" name="wr_secret" value="secret"><span style="font-size:8pt; font-family:dotum; color:#ff6600;"><?php echo $lang['92'];?></span>&nbsp;&nbsp;<a href="javascript:win_open('<?=$g4['bbs_path']?>/emoticon.php','emoticon','width=470,height=300,scrollbars=yes');" style="font-size:8pt; font-family:dotum;color:#aaaaaa"><?php echo $lang['93'];?></a>
    </td>
</tr>
<tr>
	<td>
	<? if ($is_guest) { ?>
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td width="2" class="w1"></td>
			
			<td width="60" class="w1"><?php echo $lang['60'];?></td>
			<td width="90" class="w1"><input class='w_input' maxlength=20 size=12 name=wr_name itemname="<?php echo $lang['60'];?>" required value="<?=$name?>"></td>
			<td width="120" rowspan="2" class="w1"><img id='kcaptcha_image' border='0' width=120 height=60 onclick="imageClick();" style="cursor:pointer;" title=""></td>
			<td class="w2"><span style="color:#333333;font-weight:bold; "><?php echo $lang['94'];?></span><br><?php echo $lang['95'];?></td>
			
			<td class="w1">&nbsp;</td>
		</tr>
		<tr>
			<td width="2" class="w1"></td>
			<td width="60" class="w1"><?php echo $lang['96'];?></td>
			<td width="90" class="w1"><input class='w_input' type=password maxLength=20 size=12 name="wr_password" itemname="<?php echo $lang['96'];?>" required class=ed></td>
			<td class="w1"><input class='w_input' type=input size=22 name=wr_key itemname="<?php echo $lang['94'];?>" required></td>
			<td class="w1">&nbsp;</td>
		</tr>
	</table>
	<? } ?>
	</td>
</tr>
<tr>
    <td width=95%>
        <textarea  class='w_input2' id="wr_content" name="wr_content" rows=8 itemname="<?php echo $lang['64'];?>" required
        <? if ($comment_min || $comment_max) { ?>onkeyup="check_byte('wr_content', 'char_count');"<?}?> style='width:100%; word-break:break-all;' class=tx></textarea>
        <? if ($comment_min || $comment_max) { ?><script language="javascript"> check_byte('wr_content', 'char_count'); </script><?}?>
    </td>
    <td width=85 align=center>
        <div><input type="submit" value="<?php echo $lang['121'];?>" name="B1" style="font-weight: bold" class="btn9"></div>
		<div style="padding:1px;"></div>
		<div><input type="submit" value="<?php echo $lang['122'];?>" name="B1" style="font-weight: bold" class="btn10"></div>
		<div style="padding:1px;"></div>
		<div><input type="submit" value="<?php echo $lang['123'];?>" name="B1" style="font-weight: bold" class="btn10"></div>
    </td>
</tr>
</table>
</form>
</td></tr></table>
</div>

<script type="text/javascript"> var md5_norobot_key = ''; </script>
<script type="text/javascript" src="<?="$g4[path]/js/prototype.js"?>"?>"></script>
<script type="text/javascript">
function imageClick() {
    var url = "<?=$g4[bbs_path]?>/kcaptcha_session.php";
    var para = "";
    var myAjax = new Ajax.Request(
        url, 
        {
            method: 'post', 
            asynchronous: true,
            parameters: para, 
            onComplete: imageClickResult
        });
}

function imageClickResult(req) { 
    var result = req.responseText;
    var img = document.createElement("IMG");
    img.setAttribute("src", "<?=$g4[bbs_path]?>/kcaptcha_image.php?t=" + (new Date).getTime());
    document.getElementById('kcaptcha_image').src = img.getAttribute('src');

    md5_norobot_key = result;
}


var save_before = '';
var save_html = document.getElementById('comment_write').innerHTML;

function good_and_write()
{
    var f = document.fviewcomment;
    if (fviewcomment_submit(f)) {
        f.is_good.value = 1;
        f.submit();
    } else {
        f.is_good.value = 0;
    }
}

function fviewcomment_submit(f)
{
    var pattern = /(^\s*)|(\s*$)/g; // \s 공백 문자

    f.is_good.value = 0;

    var s;
    if (s = word_filter_check(document.getElementById('wr_content').value))
    {
        alert("내용에 금지단어('"+s+"')가 포함되어있습니다");
        document.getElementById('wr_content').focus();
        return false;
    }

    // 양쪽 공백 없애기
    var pattern = /(^\s*)|(\s*$)/g; // \s 공백 문자
    document.getElementById('wr_content').value = document.getElementById('wr_content').value.replace(pattern, "");
    if (char_min > 0 || char_max > 0)
    {
        check_byte('wr_content', 'char_count');
        var cnt = parseInt(document.getElementById('char_count').innerHTML);
        if (char_min > 0 && char_min > cnt)
        {
            alert("코멘트는 "+char_min+"글자 이상 쓰셔야 합니다.");
            return false;
        } else if (char_max > 0 && char_max < cnt)
        {
            alert("코멘트는 "+char_max+"글자 이하로 쓰셔야 합니다.");
            return false;
        }
    }
    else if (!document.getElementById('wr_content').value)
    {
        alert("코멘트를 입력하여 주십시오.");
        return false;
    }

    if (typeof(f.wr_name) != 'undefined')
    {
        f.wr_name.value = f.wr_name.value.replace(pattern, "");
        if (f.wr_name.value == '')
        {
            alert('이름이 입력되지 않았습니다.');
            f.wr_name.focus();
            return false;
        }
    }

    if (typeof(f.wr_password) != 'undefined')
    {
        f.wr_password.value = f.wr_password.value.replace(pattern, "");
        if (f.wr_password.value == '')
        {
            alert('패스워드가 입력되지 않았습니다.');
            f.wr_password.focus();
            return false;
        }
    }

            if (!check_kcaptcha(f.wr_key)) { 
                return false; 
            }

    return true;
}

function comment_box(comment_id, work)
{
    var el_id;
    // 코멘트 아이디가 넘어오면 답변, 수정
    if (comment_id)
    {
        if (work == 'c')
            el_id = 'reply_' + comment_id;
        else
            el_id = 'edit_' + comment_id;
    }
    else
        el_id = 'comment_write';

    if (save_before != el_id)
    {
        if (save_before)
        {
            document.getElementById(save_before).style.display = 'none';
            document.getElementById(save_before).innerHTML = '';
        }

        document.getElementById(el_id).style.display = '';
        document.getElementById(el_id).innerHTML = save_html;
        // 코멘트 수정
        if (work == 'cu')
        {
            document.getElementById('wr_content').value = document.getElementById('save_comment_' + comment_id).value;
            if (typeof char_count != 'undefined')
                check_byte('wr_content', 'char_count');
            if (document.getElementById('secret_comment_'+comment_id).value)
                document.getElementById('wr_secret').checked = true;
            else
                document.getElementById('wr_secret').checked = false;
        }

        document.getElementById('comment_id').value = comment_id;
        document.getElementById('w').value = work;

        save_before = el_id;
    }

    if (work == 'c') {
        <? if (!$is_member) { ?>imageClick();<? } ?>
    }
}

function comment_delete(url)
{
    if (confirm("<?php echo $lang['97'];?>")) location.href = url;
}

comment_box('', 'c'); // 코멘트 입력폼이 보이도록 처리하기위해서 추가 (root님)
</script>
<? } ?>

<? if($cwin==1) { ?></td></table><p align=center><a href="javascript:window.close();"><img src="<?=$board_skin_path?>/img/btn_close.gif" border="0"></a><br><br><?}?>
