<?
	if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
?>
<!-- STR : contents -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script src="single_sms.js" type="text/javascript"></script>
<div>
	
</div>
<div>
	<form class="sms_form">
	<h1 class="sms_title"><img  src="<?=$g4['path']?>/img/icon/big/Dots.gif" style="vertical-align: text-bottom; margin-right:5px;"></img>Single SMS</h1>	
	<div id="request-business-fields">
		<p>Phone : </p>
        <p><input name="phone" class="phone" type="text" placeholder="Input the Phone Number" style="width:276px; padding-top: 10px; padding-right: 10px; padding-bottom: 10px; padding-left: 10px;"></p>
        <p><font color="red">* dont input the character more than 80 bytes</font><p>
        <p>Message : </p>
        <p><textarea name="contents" class="contents" placeholder="Input the Message" onkeypress="if(event.keyCode==13){return false;}" style="padding-top: 10px; padding-right: 10px; padding-bottom: 10px; padding-left: 10px; overflow-x: hidden; overflow-y: hidden; height: 100px; "></textarea></p>
        <p>Result : </p>
        <div class="result">&nbsp</div>
        <p><button type="submit" style="margin-top:20px;width:287px;">SUBMIT</button></p>
    </div>
    </form>
</div>

