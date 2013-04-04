<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
<title>Call Log</title>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
<script src="bootstrap.js"></script>
<link href="bootstrap.css" rel="stylesheet">
<link href="login.css" rel="stylesheet">
<link href="bootstrap-responsive.css" rel="stylesheet">
<link href="docs.css" rel="stylesheet">

<link href="login-box.css" rel="stylesheet" type="text/css" />
</head>
<body class="login_body">
<script>
function enter_event(){
	
	var str = event.keyCode;
	if(str==13){
		foutlogin_submit(document.loginForm);
	}
}

function foutlogin_submit(f)
{

    if (!f.mb_id.value) {

        alert("Insert the member id");
        f.mb_id.focus();
        return false;
    }

    if (!f.mb_password.value) {
        alert("Insert the member pw");
        f.mb_password.focus();
        return false;
    }

	f.action = './bbs/login_check.php';
    f.submit();
}

</script>
<!-- login -->
<div id="login-container">
	
	
	<div id="login-header">
		
		<h3>Call Log</h3>
		
	</div> <!-- /login-header -->
	
	<div id="login-content" class="clearfix">
	
	<form  id="loginForm" name="loginForm" method="post" onsubmit="return foutlogin_submit(document.loginForm);" autocomplete="off">
				<fieldset>
					<div class="control-group">
						<label class="control-label" for="username">Username</label>
						<div class="controls">
							<input type="text" class="" id="username" name="mb_id">
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="password">Password</label>
						<div class="controls">
							<input type="password" class="" id="password" name="mb_password">
						</div>
					</div>
				</fieldset>
				
				<div id="remember-me" class="pull-left">
				</div>
				
				<div class="pull-right">
					<button type="submit" class="btn btn-warning btn-large">
						Login
					</button>
				</div>
			</form>
			
		</div> <!-- /login-content -->
		
</div>

</body>
</html>
