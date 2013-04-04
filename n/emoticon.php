<?
$g4_path = ".";
include_once("$g4_path/_common.php");
$g4['title'] = "이모티콘 선택";
include_once("$g4[path]/head.sub.php");
?>

<script language=javascript>
function add(img)
{
    opener.document.getElementById("wr_content").value += "\n[" + img + "]\n";
    self.close();
}
</script>

<style type="text/css">
#e_box{float:left;}
.e_list{margin:10px;}
</style>
<body style="overflow-x:hidden; overflow-y:auto"> 
<div id="e_box">
	<?for($i=1; $i<=105; $i++){?>
	<a href="javascript:add('<?=$g4['url']?>/img/emoticon/<?=$i?>.gif');"><img src="<?=$g4['url']?>/img/emoticon/<?=$i?>.gif" border="0" class="e_list"></a>
	<?}?>
</div>

<?
include_once("$g4[path]/tail.sub.php");
?>
