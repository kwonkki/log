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
	<img  src="<?=$g4['path']?>/img/icon/small/Save.gif" style="vertical-align: text-bottom; margin-right:5px;">Import the Excel File : 
	<input type="file" id="excel_reading" class="excel_reading" name="excel_reading" value="loading the excel" onclick="alert('test')"/>
</div>
<div>
	<form class="sms_form">
		<input type="hidden" name="phone" 		class="phone" 	value="" />
		<input type="hidden" name="contents"  	class="contents"	value="" />
		<!--<textarea name="sms_msg" bytes="80" class="sms_msg" rows="10" cols="50" wrap="off" scrolling="no"></textarea>-->
		<br>
		<input type="submit" value="Send the SMS">
	</form>
	<div class="data_area">
	</div>
</div>
<div style="padding-top: 20px; padding-bottom : 15px;">
	<p><img  src="<?=$g4['path']?>/img/icon/small/Info.gif" style="vertical-align: text-bottom; margin-right:5px;">Messages For Each Countries	</p>
	<table class="table_info">
	<COLGROUP>
	  <COL width="50px" align="center">
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


