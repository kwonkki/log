//alert('test');
$(document).ready(function(){
	
	
	var loop = 1;
	
	$('.sms_form').submit(function(e){
		
		var tb_rows  	= $('.sms_data  tr').length;			
		var tb_cells	= document.getElementById("sms_data").rows[0].cells.length;
		
		var col1 = "";
		var col2 = "";
		
		$("input.phone").val(
				$(".sms_data tr:nth-child("+loop+") td:nth-child(1)").text()
				);
		$("input.contents").val(
				$(".sms_data tr:nth-child("+loop+") td:nth-child(2)").text()
				);		
		
		if( ( $('.phone').val() == "") || (isNaN($('.phone').val()) ) ||  ( $('.phone').val().length < 8) || ($('.contents').val() == "") ){
			$(".sms_data tr:nth-child("+loop+") td:nth-child(3)").html("check your format");
			
			e.preventDefault();
			
			if(loop < tb_rows){
				loop++;
				$('.sms_form').trigger("submit");
			}else{
				loop = 1;
			}
		}
	
		else{
					
			//alert($('.phone').val());
			//$('.phone').val()
			//$('.contents').val()
			//tabel_dom.rows[i].cells[j].innerHTML					
			
			
			  $.ajax({
				data:$(this).serialize(),
				type:"POST",
				url:"sms_process.php",
				beforeSend:function(){
					
					
					$("input.phone").val(
							$(".sms_data tr:nth-child("+loop+") td:nth-child(1)").text()
							);
					$("input.contents").val(
							$(".sms_data tr:nth-child("+loop+") td:nth-child(2)").text()
							);
					
					
					
				},
				success:function(msg){
					jsonMsg = $.parseJSON(msg);
					
					/*
					if(jsonMsg['ErrorCode'] == 0){
						$('.result').html("ErrorCode: " + jsonMsg['ErrorCode'] + "<br>ErrorMessage: " + jsonMsg['ErrorMessage'] + "<br>Message : " + jsonMsg['Message']);
					}else{
						$('.result').html("ErrorCode: " + jsonMsg['ErrorCode'] + "<br>ErrorMessage: " + jsonMsg['ErrorMessage'] + "<br>Message : " + jsonMsg['Message']);
					}
					*/
					
					$(".sms_data tr:nth-child("+loop+") td:nth-child(3)").html("ErrorCode: " + jsonMsg['ErrorCode'] + "<br>ErrorMessage: " + jsonMsg['ErrorMessage'] + "<br>Message : " + jsonMsg['Message']);
					
					if(loop < tb_rows){
						loop++;
						$('.sms_form').trigger("submit");
					}else{
						loop = 1;
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


