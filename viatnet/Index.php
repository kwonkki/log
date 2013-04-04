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
			<textarea name="sms_msg" bytes="80" class="sms_msg" rows="10" cols="50" wrap="off" scrolling="no"></textarea>
			<br>
			<input type="submit" value="send">
		</form>
	</div>	
	<div>
		<h2>result</h2>
		<div class="result"></div>	
	</div>
	</body>
</html>