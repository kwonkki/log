<?
	if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
?>
<!-- STR : contents -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script src="sms.js" type="text/javascript"></script>
<script src="excel.js" type="text/javascript"></script>

<div>
	<h1 class="sms_title"><img  src="<?=$g4['path']?>/img/icon/big/Dots.gif" style="vertical-align: text-bottom; margin-right:5px;"></img>Excel SMS</h1>
</div>
<div>
	<form class="sms_form">
		<input type="hidden" name="phone" 		class="phone" 	value="" />
		<input type="hidden" name="contents"  	class="contents"	value="" />
		<!--<textarea name="sms_msg" bytes="80" class="sms_msg" rows="10" cols="50" wrap="off" scrolling="no"></textarea>-->
		<br>
		<input type="submit" value="send button">
	</form>
	<h2>Reading the Excel : <br>
	* use this menu only in IE and change and allow the security setting in the internet options</h2>
	<div>
		<input type="file" id="excel_reading" class="excel_reading" name="excel_reading" value="loading the excel" />
	</div>
	<div class="data_area">
	</div>
	<script>
	</script>
</div>

