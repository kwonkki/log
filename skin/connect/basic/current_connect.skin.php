<?
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가 
?><head>

<style>
.n_title1 { font-family:; font-size:9pt; color:#FFFFFF; }
.n_title2 { font-family:; font-size:9pt; color:#5E5E5E; }
/* Author: 웃는하루연구소(whalab.com) */
.current ul { padding:0; margin:0; clear:both; list-style: none; }
.current_title { border:1px solid #ddd; height:34px; background:url(<?=$connect_skin_path?>/img/title_bg.gif) repeat-x; font:12px; }
.current_title li { font-weight:bold; padding:11px; }
.current_title_shadow { height:3px; background:url(<?=$connect_skin_path?>/img/title_shadow.gif) repeat-x; line-height:1px; font-size:1px; }
.current_no { width:60px; float:left; text-align:center; }
.current_name { width:150px; float:left; text-align:center; }
.current_local { width:auto; float:left; text-align:center;}
.current_list { height:30px; font:12px; }
.current_list li, .current_pages li { padding: 9px; }
.current_line { height:1px; border-top: 1px solid #E7E7E7; }
.current_none { height:50px; padding: 19px; font:12px; text-align:center; }
.current_pages { height:30px; text-align:center; }
</style>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>



<div class="current" style="width: 100%;">
    <ul class="current_title">
        <li class="current_no"><?php echo $lang['58'];?></li>
        <li class="current_name"><?php echo $lang['141'];?></li>
        <li class="current_local"><?php echo $lang['296'];?></li>
    </ul>
    <ul class="current_title_shadow"></ul>
<?
for ($i=0; $i<count($list); $i++)
{
    echo <<<HEREDOC
    <ul class='current_list'>
        <li class='current_no'>{$list[$i][num]}</li>
        <li class='current_name'>{$list[$i][name]}</li>
HEREDOC;

    $location = conv_content($list[$i][lo_location], 0);

    // 최고관리자에게만 허용
    // 이 조건문은 가능한 변경하지 마십시오.
    if ($list[$i][lo_url] && $is_admin == "super")
        echo "<li class='current_local'><span class=small style='color:#AAAAAA;'>&nbsp;<a href='{$list[$i][lo_url]}'>{$location}</a></span></li>";
    else
        echo "<li class='current_local'><span class=small style='color:#AAAAAA;'>&nbsp;{$location}</span></li>";

    echo <<<HEREDOC
    </ul>
    <ul class='current_line'></ul>
HEREDOC;
}

if ($i == 0)
    echo "<ul class='current_none'>{$lang[297]}</ul>";
?>
    <ul class="current_pages"><li>
		 <? if ($prev_part_href) { echo "<a href='$prev_part_href'>이전검색</a>"; } ?>
 <div class="paginate"><?=$write_pages?></div>
 <? if ($next_part_href) { echo "<a href='$next_part_href'>다음검색</a>"; } ?></li></ul>
</div>
