<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script src="./jquery.uploadify-3.1.js"></script>
<link rel="stylesheet" type="text/css" href="uploadify.css" />
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
    });
});
</script>
</head>
<body>
<input type="file" name="file_upload" id="file_upload" />
</body>
</html>