<?php
/*
 * Created on Oct 2, 2012
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
 
 function sendEmail($body){
	require("mail/class.phpmailer.php");		
	$mail = new PHPMailer();					
	$mail->IsSMTP();							
	$mail->Host = "10.120.10.24";			
	$mail->SMTPAuth = true;						
	$mail->Username = "it.reports@pacificseainvests.com";	
	$mail->Password = "SQL65ry71!";				

	$mail->From = "it.reports@pacificseainvests.com";		
	$mail->FromName = "Call Log";
		
	//$sAddress = "maggie@pacificseainvests.com";
	$sAddress = "kibum.kk@pacificseainvests.com";
	$mail->AddAddress($sAddress);
	//$arrCCAddress = array("jkmwo@hotmail.com","leowmaggie@yahoo.com.sg","ptofjbmy@yahoo.com","csdsupervisorrmb@pacificseainvests.com");
	//$arrCCAddress = array("ptofjbmy@yahoo.com","csdsupervisorrmb@pacificseainvests.com", "leowmaggie@yahoo.com.sg", "BANK@pacificseainvests.com", "support@pacificseainvests.com" );
	//$arrCCAddress = array("jeffrey@pacificseainvests.com", "phantiva@pacificseainvests.com", "kibum.kk@pacificseainvests.com" );
	//$mail->AddMutieCCAddress($arrCCAddress);   

	$mail->IsHTML(true);

	$mail->Subject = date("Y-m-d")." Agent Daily report";
	$mail->Body = str_replace("<","\r\n<",$body);
	//$mail->AddAttachment("C:\Users\kibum.kk\Desktop\Programmer Meeting Minutes 25-Sep-2012.xls");	
	$mail->AltBody = ""; 
	$mail->Send();
}
include("email-result-export.php");

$page = $pagecontent;
//$page = file_get_contents("../xl.html");
//echo trim($page);
sendEmail(trim($page)); 
 
?>
