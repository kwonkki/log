<html>
	<head>
		<title>SMS</title>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
		<script src="sms.js" type="text/javascript"></script>
	</head>
	<body>	
	<div>
		<h1>SMS System</h1>
	</div>
	<div>
		<form class="sms_form">
			<input type="text" name="phone" 		class="phone" 	value="" />
			<input type="text" name="contents"  	class="contents"	value="" />
			<!--<textarea name="sms_msg" bytes="80" class="sms_msg" rows="10" cols="50" wrap="off" scrolling="no"></textarea>-->
			<br>
			<input type="submit" value="send button">			
		</form>
		<h2>sending data information</h2>
		<div>
		<table border="1" class="sms_data" id="sms_data">
			<tr>
				<td class="data_phone">no phone #</td>
				<td class="data_contents">no contents</td>
				<td class="result">no result</td>
			</tr>
			<tr>
				<td class="data_phone">no phone #</td>
				<td class="data_contents">no contents</td>
				<td class="result">no result</td>
			</tr>
			<tr>
				<td class="data_phone">no phone #</td>
				<td class="data_contents">no contents</td>
				<td class="result">no result</td>
			</tr>
		</table>
		</div>		
	</div>
	<script>
		$('.phone').Text("asdfasdfasdf");
	<script>
	</body>
</html>