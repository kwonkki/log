//alert('test');
$(document).ready(function(){
	
	$('.sms_form').submit(function(e){
		
		
		
		if( $('.phone').val() == ""){
			alert("Enter your phone number");
			$('.phone').focus();
		}
		else if(isNaN($('.phone').val()) ){
			alert("Enter the Number")
			$('.phone').val("");
			$('.phone').focus();
		}
		else if( $('.phone').val().length < 8){
			alert("Enter the phone number more than 8")			
			$('.phone').focus();
		}
		else if($('.contents').val() == ""){
			alert("Enter your Message");
			$('.contents').focus();
		}
		else{
					
			//alert($('.phone').val());
			//$('.phone').val()
			//$('.contents').val()
			//tabel_dom.rows[i].cells[j].innerHTML
					
			
			  $.ajax({
				data:$(this).serialize(),
				type:"POST",
				url:"single_sms_process.php",
				beforeSend:function(){
					
					$(".result").text("Sending..");
					
				},
				success:function(msg){
					
					$('.phone').val("");
					$('.contents').val("");
					
					jsonMsg = $.parseJSON(msg);
					if(jsonMsg['ErrorCode'] == 0){
						$('.result').html("Successfully Message Sent");
					}else{
						var tmp = jsonMsg['ErrorMessage'];
						$('.result').html(tmp);
					}
					
				//	$('.sms_form').trigger("submit");
				//	alert('1');
					
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


