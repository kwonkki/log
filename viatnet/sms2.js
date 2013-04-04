// wait for the DOM to be loaded
alert('asdfasd');
$(document).ready(function(){
	
	    var options = { 
        //target:        '#output1',   // target element(s) to be updated with server response 
        beforeSubmit:  showRequest,  // pre-submit callback 
        success:       showResponse  // post-submit callback 
 
        // other available options: 
        url: "sms_process.php",      
        type: "POST",      
        //dataType:  null        // 'xml', 'script', or 'json' (expected server response type) 
        //clearForm: true        // clear all form fields after successful submit 
        resetForm: false// reset the form after successful submit 
 
        // $.ajax options can be used here too, for example: 
        //timeout:   3000 
	    }; 
	    
	    $('.sms_form').submit(function() { 
	        // inside event callbacks 'this' is the DOM element so we first 
	        // wrap it in a jQuery object and then invoke ajaxSubmit 
	        $(this).ajaxSubmit(options); 
	 
	        // !!! Important !!! 
	        // always return false to prevent standard browser submit and page navigation 
	        return false; 
	    }); 
});

//pre-submit callback 
function showRequest(formData, jqForm, options) {
	if( $('.sms_msg').val() == ""){
		alert("enter your message");
		return false;
	}
   
    return true; 
} 
 
// post-submit callback 
function showResponse(responseText, statusText, xhr, $form)  { 
 
	jsonMsg = $.parseJSON(msg);
	
	if(jsonMsg['ErrorCode'] == 0){
		$('.result').html("ErrorCode: " + jsonMsg['ErrorCode'] + "<br>ErrorMessage: " + jsonMsg['ErrorMessage'] + "<br>Message : " + jsonMsg['Message']);
	}else{
		$('.result').html("ErrorCode: " + jsonMsg['ErrorCode'] + "<br>ErrorMessage: " + jsonMsg['ErrorMessage'] + "<br>Message : " + jsonMsg['Message']);
	} 
} 