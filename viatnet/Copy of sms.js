//alert('test');
$(document).ready(function(){
	
	$('.sms_form').submit(function(e){
		
		alert($(".data_phone").text());
		
		if( $('.sms_msg').val() == ""){
			alert("enter your message");
		}
		else{
		
		  $.ajax({
			data:$(this).serialize(),
			type:"POST",
			url:"sms_process.php",
			beforeSend:function(){
				//$('.green-submit').attr("value","Sending").addClass("disabled");
				//$('.contact-msg').html("");
			},
			success:function(msg){
				jsonMsg = $.parseJSON(msg);
				
				if(jsonMsg['ErrorCode'] == 0){
					$('.result').html("ErrorCode: " + jsonMsg['ErrorCode'] + "<br>ErrorMessage: " + jsonMsg['ErrorMessage'] + "<br>Message : " + jsonMsg['Message']);
				}else{
					$('.result').html("ErrorCode: " + jsonMsg['ErrorCode'] + "<br>ErrorMessage: " + jsonMsg['ErrorMessage'] + "<br>Message : " + jsonMsg['Message']);
				}
				
				//$('.sms_form').trigger("submit");
				//alert('1');
				
			/*	
				jsonMsg = $.parseJSON(msg);
				
				if(jsonMsg['status'] == 1){
					$('.contact-msg').html("<img src='images/very-small-tick.png' />"+jsonMsg['msg']);
				}
				else{
					$('.contact-msg').html("<img src='images/very-small-error.png' />"+jsonMsg['msg']);
				}
				
				
				$('.green-submit').attr("value","Send").removeClass("disabled");
			*/
			}
		  });
		}
		
		e.preventDefault();
	});
	
});

