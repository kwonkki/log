<?
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가 
?>

<table width="150" border="0" cellspacing="4" cellpadding="0" align="center" bgcolor="#EEEEEE">
<tr>
    <td bgcolor="#CCCCCC">
        <table width="100%" border="0" cellspacing="1" cellpadding="5">
        <tr> 
            <td bgcolor="#FFFFFF" align="center"><a href='<?=$g4['bbs_path']?>/current_connect.php'><strong>접속자</strong> : <?=$row['total_cnt']?> (회원 <?=$row['mb_cnt']?>)</a></td>
        </tr>
        </table></td>
</tr>
</table>
