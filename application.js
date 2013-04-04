


var is_formCategory = false;
var is_formResult = false;
var is_formOutcome = false;

$(document).ready(function(){
	
	
	
	// admin csd submit
	/*////////////////////////////////////////////////////////////////////////////
	 */
	$('.form_csd').submit(function(e){
		
		
			$.ajax({
				data:$(this).serialize(),
				type:"POST",
				url: "./admin_csd_add.php",
				beforeSend:function(){
					
					if( $(".form_csd #mb_id").val().length < 4 ){
						alert("type the more than 4");
						$(".form_csd #mb_id").focus();
						return false;
					}
					if( $(".form_csd #mb_password").val().length < 4 ){
						$(".form_csd #mb_password").focus();
						alert("type the more than 4");
						return false;
					}
					if( isNaN(  $(".form_csd #mb_level").val() ) ||  $(".form_csd #mb_level").val() < 1 ||  $(".form_csd #mb_level").val() > 10 ){
						$(".form_csd #mb_level").focus();
						alert("level should be between 1 and 10");
						return false;
					}
					if( $(".form_csd #mb_nick").val().length < 4 ){
						$(".form_csd #mb_nick").focus();
						alert("type the more than 4");
						return false;
					}
					
					var pattern= /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
					if( !pattern.test(   $(".form_csd #mb_email").val() ) ){
						$(".form_csd #mb_email").focus();
						alert("type the correct email type");
						return false;
					}
					
				},
				success:function(msg){
					alert(msg);
					if( msg == "member data has been inserted"){
						window.location.reload(true);
					}
					
				}
			 });
		e.preventDefault();
	});
	/*////////////////////////////////////////////////////////////////////////////
	 */
	// admin csd submit
	/*////////////////////////////////////////////////////////////////////////////
	 */
	$('.form_csd_edit').submit(function(e){
		
		
		$.ajax({
			data:$(this).serialize(),
			type:"POST",
			url: "./admin_csd_add.php",
			beforeSend:function(){
				
				if( $(".form_csd_edit #mb_id").val().length < 4 ){
					alert("type the more than 4 - mb_id");
					$(".form_csd_edit #mb_id").focus();
					return false;
				}
				if( isNaN(  $(".form_csd_edit #mb_level").val() ) ||  $(".form_csd_edit #mb_level").val() < 1 ||  $(".form_csd_edit #mb_level").val() > 10 ){
					$(".form_csd_edit #mb_level").focus();
					alert("level should be between 1 and 10");
					return false;
				}
				if( $(".form_csd_edit #mb_nick").val().length < 4 ){
					$(".form_csd_edit #mb_nick").focus();
					alert("type the more than 4");
					return false;
				}
				
				var pattern= /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
				if( !pattern.test(   $(".form_csd_edit #mb_email").val() ) ){
					$(".form_csd_edit #mb_email").focus();
					alert("type the correct email type");
					return false;
				}
				
			},
			success:function(msg){
				alert(msg);
				if( msg == "member data has been updated"){
					window.location.reload(true);
				}
				
			}
		});
		e.preventDefault();
	});
	/*////////////////////////////////////////////////////////////////////////////
	 */
	/*////////////////////////////////////////////////////////////////////////////
	 */
	$('#form_category').submit(function(e){
		
		if( is_formCategory == true ){
			
			$.ajax({
				data:$(this).serialize(),
				type:"POST",
				url: "./admin_category_add.php",
				beforeSend:function(){
				},
				success:function(msg){
					
					JsonResult = $.parseJSON(msg);
					
					if( JsonResult['result'] == '-1'){
						alert('data already existing..');
					}else{
						alert('data has been inserted..');
						
						
						var DeleteButtom = "<a class=\"btn btn-danger\" href=\"#\" onclick=\"javascript:delete_category('"+ JsonResult['category_id'] +"')\"><i class=\"icon-trash icon-white\"></i> Delete</a>";
						
						
						$('<tr><td>' + JsonResult['category_id'] + '</td><td>'+ JsonResult['category_name'] +'</td><td>'+  DeleteButtom + '</td></tr>').insertBefore('table.category > tbody > tr:first');
						
						
						
						//$('table > tbody ').after("<tr><td>JsonResult['category_id']</td><td>JsonResult['category_name']</td></tr>");
						//$('<tr><td>JsonResult['category_id']</td><td>JsonResult['category_name']</td></tr>').insertBefore('table > tbody > tr:first');
						
					}
					$("form .category_name").val('');
					is_formCategory = false;	
				}
			});
		}
		e.preventDefault();
	});
	/*////////////////////////////////////////////////////////////////////////////
	 */
	
	// admin outcome submit
	/*////////////////////////////////////////////////////////////////////////////
	 */
	$('#form_outcome').submit(function(e){
		
		  if(  $(".outcome_result").val() == "Select the Result" ){
			  alert('select the Result');
			  e.preventDefault();
			  return false;
		  }
	
		
		if( is_formOutcome == true ){
			$.ajax({
				data:$(this).serialize(),
				type:"POST",
				url: "./admin_outcome_add.php",
				beforeSend:function(){
				},
				success:function(msg){
					
					JsonResult = $.parseJSON(msg);
					
					if( JsonResult['result'] == '-1'){
						alert('data already existing..');
					}else{
						alert('data has been inserted..');
						
						
						var DeleteButtom = "<a class=\"btn btn-danger\" href=\"#\" onclick=\"javascript:delete_outcome('"+ JsonResult['outcome_id'] +"')\"><i class=\"icon-trash icon-white\"></i> Delete</a>";
						
						
						$('<tr><td>' + JsonResult['outcome_id'] + '</td><td>'+ JsonResult['outcome_name'] +'</td><td>'+ JsonResult['result_name'] + '</td><td>'+  DeleteButtom + '</td></tr>').insertBefore('table.outcome > tbody > tr:first');
						
						
						
						//$('table > tbody ').after("<tr><td>JsonResult['category_id']</td><td>JsonResult['category_name']</td></tr>");
						//$('<tr><td>JsonResult['category_id']</td><td>JsonResult['category_name']</td></tr>').insertBefore('table > tbody > tr:first');
						
					}
					$("form .result_name").val('');
					is_formOutcome = false;	
				}
			});
		}
		e.preventDefault();
	});
	/*////////////////////////////////////////////////////////////////////////////
	 */
	
	// admin result submit
	/*////////////////////////////////////////////////////////////////////////////
	 */
	$('#form_result').submit(function(e){
		
		if( is_formResult == true ){
			
			$.ajax({
				data:$(this).serialize(),
				type:"POST",
				url: "./admin_result_add.php",
				beforeSend:function(){
				},
				success:function(msg){
					
					JsonResult = $.parseJSON(msg);
					
					if( JsonResult['result'] == '-1'){
						alert('data already existing..');
					}else{
						alert('data has been inserted..');
						
						
						var DeleteButtom = "<a class=\"btn btn-danger\" href=\"#\" onclick=\"javascript:delete_result('"+ JsonResult['result_id'] +"')\"><i class=\"icon-trash icon-white\"></i> Delete</a>";
						
						
						$('<tr><td>' + JsonResult['result_id'] + '</td><td>'+ JsonResult['result_name'] +'</td><td>'+  DeleteButtom + '</td></tr>').insertBefore('table.result > tbody > tr:first');
						
						
						
						//$('table > tbody ').after("<tr><td>JsonResult['category_id']</td><td>JsonResult['category_name']</td></tr>");
						//$('<tr><td>JsonResult['category_id']</td><td>JsonResult['category_name']</td></tr>').insertBefore('table > tbody > tr:first');
						
					}
					$("form .result_name").val('');
					is_formResult = false;	
				}
			});
		}
		e.preventDefault();
	});
	/*////////////////////////////////////////////////////////////////////////////
	 */
});  // end of "document"

function category_nameCheck(){
	
	form  = $('#form_category');
	
	if (  $("form .category_name").val().length < 5 ){
		
		$("form").find(".control-group").removeClass("success").addClass("error");
		
		is_formCategory = false;
		
	}else{
		$("form").find(".control-group").removeClass("error").addClass("success");
		
		is_formCategory = true;
	}
}


function result_nameCheck(){
	
	form  = $('#form_result');
	
	if (  $("form .result_name").val().length < 5 ){
		
		$("form").find(".control-group").removeClass("success").addClass("error");
		
		is_formResult = false;
		
	}else{
		$("form").find(".control-group").removeClass("error").addClass("success");
		
		is_formResult = true;
	}
}

function outcome_nameCheck(){
	
	form  = $('#form_outcome');
	
	if (  $("form .outcome_name").val().length < 5 ){
		
		$("form").find(".control-group").removeClass("success").addClass("error");
		
		is_formOutcome = false;
		
	}else{
		$("form").find(".control-group").removeClass("error").addClass("success");
		
		is_formOutcome = true;
	}
}


function delete_category( num ){
	
    if(!confirm("Do you delete the cateogry #" + num)) {
    	return;
    }
	
	
	$.ajax({
		data: "num=" + num,
		type:"POST",
		url: "./admin_category_delete.php",
		beforeSend:function(){
		},
		success:function(msg){
			
			JsonResult = $.parseJSON(msg);
			alert( '#'+ JsonResult['num'] + ' data deleted')
			window.location.reload(true);
		}
	 });

}

function delete_result( num ){
	
	if(!confirm("Do you delete the result #" + num)) {
		return;
	}
	
	
	$.ajax({
		data: "num=" + num,
		type:"POST",
		url: "./admin_result_delete.php",
		beforeSend:function(){
		},
		success:function(msg){
			
			JsonResult = $.parseJSON(msg);
			alert( '#'+ JsonResult['num'] + ' data deleted')
			window.location.reload(true);
		}
	});
	
}


function delete_outcome( num ){
	
	if(!confirm("Do you delete the outcome #" + num)) {
		return;
	}
	
	
	$.ajax({
		data: "num=" + num,
		type:"POST",
		url: "./admin_outcome_delete.php",
		beforeSend:function(){
		},
		success:function(msg){
			
			JsonResult = $.parseJSON(msg);
			alert( '#'+ JsonResult['num'] + ' data deleted')
			window.location.reload(true);
		}
	});
	
}


function delete_csd( num ){
	
	$.ajax({
		data: "mb_id=" + num,
		type:"POST",
		url: "./admin_csd_delete.php",
		beforeSend:function(){
			if(!confirm("Do you delete the csd #" + num)) {
				return false;
			}
		},
		success:function(msg){
			alert(msg);
			if( msg == "member data has been deleted"){
				window.location.reload(true);
			}
		}
	});
}

function getCsdInfo(mb_id, mb_nick, mb_level, mb_email){
	
	$("#myModal-CSDEdit #mb_id").val(mb_id);
	$("#myModal-CSDEdit #mb_id_fake").val(mb_id);
	$("#myModal-CSDEdit #mb_password").val("");
	$("#myModal-CSDEdit #mb_level").val(mb_level);
	$("#myModal-CSDEdit #mb_nick").val(mb_nick);
	$("#myModal-CSDEdit #mb_email").val(mb_email);

}












