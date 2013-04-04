<?
	if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
?>
<!-- STR : contents -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script src="sms.js" type="text/javascript"></script>
<script src="../uploadify/jquery.uploadify-3.1.js"></script>
<link rel="stylesheet" type="text/css" href="../uploadify/uploadify.css" />
<script>
$(document).ready(function() {
	 $("#file_upload").uploadify({
        height        : 30,
        'fileTypeExts' : '*.xls;',
        swf           : '/sms/uploadify/uploadify.swf',
        uploader      : '/sms/uploadify/uploadify.php',
        width         : 120,
    	auto      	  : true,
    	multi		  : false,
    	'fileSizeLimit' : '1024KB',
    	 'onUploadSuccess' : function(file, data, response) {
	   		 $('.data_area').html(data);
    	}
    });
});
</script>
<div>
	<h1 class="sms_title"><img  src="<?=$g4['path']?>/img/icon/big/Dots.gif" style="vertical-align: text-bottom; margin-right:5px;"></img>Excel SMS</h1>
</div>
<input type="file" name="file_upload" id="file_upload" />
<div>
	<form class="sms_form" id="sms_form">
	<div style="clear : both;"></div>
	<input type="hidden" id="filetext" />
		<input type="hidden" name="phone" 		class="phone" 	value="" />
		<input type="hidden" name="contents"  	class="contents"	value="" />
		<!--<textarea name="sms_msg" bytes="80" class="sms_msg" rows="10" cols="50" wrap="off" scrolling="no"></textarea>-->
		<br>
		<input type="submit" value="Send the SMS"> <span style="margin-left:15px;">Status : <span id="msgStatus">Ready</span></span>
	</form>
	<div class="data_area">
	</div>
</div>
<div style="padding-top: 20px; padding-bottom : 15px;">
	<p><img  src="<?=$g4['path']?>/img/icon/small/Info.gif" style="vertical-align: text-bottom; margin-right:5px;">Messages For Each Countries	</p>
	<table class="table_info">
	<COLGROUP>
	  <COL width="100px" align="center">
	  <COL >
	  <COL width="40px" align="center">
	</COLGROUP>
	<tr>
		<th>COUNTRY</th>
		<th>MESSAGE</th>
		<th>COUNTRY CODE</th>
	</tr>
	<tr>
		<td style="text-align:center;"><img  src="<?=$g4['path']?>/img/flag/fluk.png"></td>
		<td>Dear member: We are happy to inform you that your withdrawal request was approved. Thank you, 12BET</td>
		<td>63 - philippines</td>
	</tr>
	<tr>
		<td style="text-align:center;"><img  src="<?=$g4['path']?>/img/flag/flch.png"></td>
		<td>尊敬的会员：你的提款已经成功汇出，请查收。谢谢！12BET</td>
		<td>86</td>
	</tr>
	<tr>
		<td style="text-align:center;"><img  src="<?=$g4['path']?>/img/flag/flth.png"></td>
		<td>เรียนสมาชิก : เรายินดีที่จะ แจ้งให้คุณทราบว่า เงินที่คุณแจ้ง ถอน ได้รับการอนุมัติเรียบร้อย ขอขอบคุณ จาก 12BET</td>
		<td>66</td>
	</tr>
	<tr>
		<td style="text-align:center;"><img  src="<?=$g4['path']?>/img/flag/flid.png"></td>
		<td>Anggota terhormat : Dengan ini kami menginformasikan bahwa penarikan anda telah disetujui. Terima kasih, 12BET</td>
		<td>62</td>
	</tr>
	<tr>
		<td style="text-align:center;"><img  src="<?=$g4['path']?>/img/flag/flvn.png"></td>
		<td>Thành viên thân mến: Yêu cầu rút tiền của bạn đã xét duyệt, vui lòng kiểm tra. Cám ơn, 12BET!</td>
		<td>84</td>
	</tr>
	<tr>
		<td style="text-align:center;"><img  src="<?=$g4['path']?>/img/flag/flmy.png"></td>
		<td>Dear member: We are happy to inform you that your withdrawal request was approved. Thank you, 12BET</td>
		<td>60</td>
	</tr>
</table>
</div>
<div style="padding-bottom : 15px;">
	<p><img  src="<?=$g4['path']?>/img/icon/small/Info.gif" style="vertical-align: text-bottom; margin-right:5px;">ICON</p>
	<table class="table_info">
	<COLGROUP >
	  <COL width="100px" align="center">
	  <COL width="300px" align="center">
	  <COL width="40px" align="center">
	</COLGROUP>
	<tr>
		<th>ICON</th>
		<th>MEANING</th>
		<th>ETC</th>
	</tr>
	<tr>
		<td style="text-align:center;"><img  src="<?=$g4['path']?>/img/icon/big/Wait.gif"></td>
		<td>Ready</td>
		<td>&nbsp</td>
	</tr>
	<tr>
		<td style="text-align:center;"><img  src="<?=$g4['path']?>/img/icon/big/Ok.gif"></td>
		<td>SMS Sent Successfully</td>
		<td>&nbsp</td>
	</tr>
	<tr>
		<td style="text-align:center;"><img  src="<?=$g4['path']?>/img/icon/big/Loop.gif"></td>
		<td>Sending..</td>
		<td>&nbsp</td>
	</tr>
	<tr>
		<td style="text-align:center;"><img  src="<?=$g4['path']?>/img/icon/big/Cancel.gif"></td>
		<td>Remove the phone number from the list</td>
		<td>&nbsp</td>
	</tr>
	<tr>
		<td style="text-align:center;"><img  src="<?=$g4['path']?>/img/icon/big/Forbidden.gif"></td>
		<td>SMS Failed to send</td>
		<td>&nbsp</td>
	</tr>
</table>
</div>
<div style="">
<p><img  src="<?=$g4['path']?>/img/icon/small/Info.gif" style="vertical-align: text-bottom; margin-right:5px;">INSTRUCTION</p>
<img  src="<?=$g4['path']?>/img/instructions.jpg" style="vertical-align: text-bottom; margin-right:5px;">
</div>


