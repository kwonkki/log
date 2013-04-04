<?
include_once("./_common.php");

$g4['title'] = "";
include_once("./_head.php");

/* Select queries return a resultset */
$category = sql_query("SELECT * FROM call_category");
$outcome = sql_query("SELECT * FROM call_outcome ORDER BY outcome_name");
$result = sql_query("SELECT * FROM call_result ORDER BY result_name");

$agents = sql_query("SELECT mb_no, mb_nick FROM ".$g4['table_prefix']."member");

?>

<div class="main-body">
	<div class="container-fluid override-fluid">    
	<div class="row-fluid">		 
    	<div class="span12">        
    	<!--Body content-->
        	<h2>Call Logs</h2>
            	<div style="margin-top:10px;margin-bottom:10px;">                	
                    <a class="btn btn-inverse btn-large" href="#myModal" id="btnaddCall" >Add Call</a>
                    
                   <?php if($member['mb_level']>=5){ ?>
				   &nbsp;&nbsp;				   
				   <div class="pull-right">
                    <a class="btn btn-inverse" id="btnExcel"><i class="icon-download-alt icon-white"></i>Export to Excel</a>&nbsp;
                    </div>
					
					<div class="btn-group pull-right">
						&nbsp;
                        <a class="btn btn-inverse" href="#"><i></i> Outcome</a>
                        <a class="btn btn-inverse dropdown-toggle" data-toggle="dropdown" href="#"><span class="caret"></span></a>
                        <ul class="dropdown-menu " id="outcomelist">
						<?php while($row = sql_fetch_array($outcome)){ ?>
							<li>&nbsp;<input type="checkbox" name="chkOutcome[]" value="<?php echo $row['outcome_id'];?>" 
								<?php if(in_array($row['outcome_id'], ((is_array($_POST['chkOutcome']))? $_POST['chkOutcome']: array())  )){?>checked="checked"<?php }?> />  <?php echo $row['outcome_name'];?></li>
                              <?php } ?>
                        </ul>
						
                    </div>
					
					<div class="btn-group pull-right">
						&nbsp;
                        <a class="btn btn-inverse" href="#"><i></i> Result</a>
                        <a class="btn btn-inverse dropdown-toggle" data-toggle="dropdown" href="#"><span class="caret"></span></a>
                        <ul class="dropdown-menu " id="resultlist">
						<?php while($row = sql_fetch_array($result)){ ?>
							<li>&nbsp;<input type="checkbox" name="chkResult[]" value="<?php echo $row['result_id'];?>" 
								<?php if(in_array($row['result_id'], ((is_array($_POST['chkResult']))? $_POST['chkResult']: array())  )){?>checked="checked"<?php }?> />  <?php echo $row['result_name'];?></li>
                              <?php } ?>
                        </ul>
						
                    </div>
					
					<div class="btn-group pull-right">
						&nbsp;
                        <a class="btn btn-inverse" href="#"><i></i> Type</a>
                        <a class="btn btn-inverse dropdown-toggle" data-toggle="dropdown" href="#"><span class="caret"></span></a>
                        <ul class="dropdown-menu " id="typelist">
						<li>&nbsp;<input type="checkbox" name="chkType[]" value="Conversion" 
								<?php if(in_array("Conversion", ((is_array($_POST['chkType']))? $_POST['chkType']: array())  )){?>checked="checked"<?php }?> />  Conversion</li>
						<li>&nbsp;<input type="checkbox" name="chkType[]" value="VIP" 
								<?php if(in_array("VIP", ((is_array($_POST['chkType']))? $_POST['chkType']: array())  )){?>checked="checked"<?php }?> />  VIP</li>
						<li>&nbsp;<input type="checkbox" name="chkType[]" value="Retention" 
								<?php if(in_array("Retention", ((is_array($_POST['chkType']))? $_POST['chkType']: array())  )){?>checked="checked"<?php }?> />  Retention</li>                      
                        </ul>
						
                    </div>
					
					
                    <div class="btn-group pull-right">
						&nbsp;
                        <a class="btn btn-inverse" href="#"><i></i> Agent</a>
                        <a class="btn btn-inverse dropdown-toggle" data-toggle="dropdown" href="#"><span class="caret"></span></a>
                        <ul class="dropdown-menu " id="agentlist">
                        <?php while($row = sql_fetch_array($agents)){ ?>
							<li>&nbsp;<input type="checkbox" name="chkAgent[]" value=" <?php echo $row['mb_no'];?>" 
								<?php if(in_array($row['mb_no'], ((is_array($_POST['chkAgent']))? $_POST['chkAgent']: array())  )){?>checked="checked"<?php }?> />  <?php echo $row['mb_nick'];?></li>
                              <?php } ?>
                        </ul>
						
                    </div>
					
                      <div class="input-append pull-right">
					  <label class="control-label inline"  for="endtxt">&nbsp;
						To
						<input type="text" size="16" id="endtxt" name="endtxt" class="input input-small" value="<?php echo $_POST['end']?>"><a class="btn btn-inverse" href="#" id="endxlsbtn"><i class="icon-calendar icon-white"></i></a>&nbsp;
					  </label>
                      
                      </div>
                      
                      <div class="input-append pull-right">
					  <label class="control-label inline"  for="starttxt">
						Date Range From
						<input type="text" size="16" id="starttxt" name="starttxt" class="input input-small" value="<?php echo $_POST['start']?>"><a class="btn btn-inverse" href="#" id="startbtn"><i class="icon-calendar icon-white"></i></a>
					  </label>                      
                      </div>
					  
					<?php } ?>                    
                    
                </div>                
        		<div id="tblCall">
                </div>
                <input name="paginate" id="paginate" type="hidden" />
                 <input name="historypage" id="historypage" type="hidden" />
                 
                  <!-- Start Add Call -->
                <div class="modal hide fade" id="modalTag" >
                  <div class="modal-header">
                    <button data-dismiss="modal" class="close" type="button">x</button>
                    <h3>Account Tagging</h3>
                  </div>
                  
                  		<form class="form" id="frmTagging" name="frmTagging">
                        <div class="modal-body">
                        <input type="hidden" name="txtTagID" id="txtTagID" />
                  		<table width="100%">
                            <tbody>
                            <tr>                        	
                                <td>     
                                    <label>Tagging Options</label>                               	
                                    <label class="radio">
                                    <input type="radio" name="rdoTagType" id="rdoTagType1" value="1">
                                        Account Active
                                    </label>
                                    <label class="radio">
                                    <input type="radio" name="rdoTagType" id="rdoTagType2" value="2">
                                    Number Invalid
                                    </label>
                                    <label class="radio">
                                    <input type="radio" name="rdoTagType" id="rdoTagType3" value="3">
                                    Account Frozen
                                    </label> 
                                </td>
                            </tr>                       
                            </tbody>
                        </table>
                        </div>
                        <div class="modal-footer">                   
                              <button class="btn btn-inverse" type="submit" id="btnTagSave">Save changes</button>
                              <button class="btn btnTagcancel" type="button">Cancel</button>
                        </div> 
                        </form>
                 
                                                          
                                         
                </div>
                <!-- End Call -->
                
                 <!-- Start Add Call -->
                <div class="modal hide fade" id="myModal" >
                <div class="modal-header">
                  <button data-dismiss="modal" class="close" type="button">x</button>
                  <h3>Add Call Logs</h3>
                </div>
                
    		    <form class="form" id="frmAddCall" name="frmAddCall">
                	<div class="modal-body">
                	<table width="100%">
                    	<tbody>
                    	<tr>
                        	<td>
                            	 <div class="control-group">
                                    <div class="controls">
                                        <label class="control-label" for="txtuser">Username</label>        
                                        <input type="text" id="txtuser" name="txtuser">                                    </div>                      
                                </div> 
                            </td>
                            <td>
                            	 <div class="control-group">
                                      <div class="controls">                                         <label class="control-label" for="txtcurrency">Currency</label>
                                      	 <select id="txtcurrency" name="txtcurrency">
                                          <option value="">Please choose</option>
                                          <option value="CNY">CNY</option>
                                          <option value="MYR">MYR</option>
                                          <option value="RUP">RUP</option>
                                          <option value="THB">THB</option>
                                          <option value="VDO">VDO</option>
                                        </select>                                        
                                      </div>                      
                                  </div> 
                            </td>
                        </tr>
                        <tr>
                        	<td>
                            	<div class="control-group">                                  
                                  <div class="controls">
                                  	<label for="startcall" class="control-label">Start Call</label>
                                    <div class="input-append">
                                      <input type="text" size="16" id="startcall" name="startcall" class="input"><a class="btn btn-inverse" href="#" id="startcallbtn"><i class="icon-calendar icon-white"></i></a>
                                    </div>
                                    <span class="help-inline">Please input the start call</span>
                                  </div>
                                </div>
                            </td>
                            <td>
                            	 <div class="control-group">
                                  <label for="endcall" class="control-label">End Call</label>
                                  <div class="controls">
                                    <div class="input-append">
                                      <input type="text" size="16" id="endcall" name="endcall" class="input"><a class="btn btn-inverse" href="#" id="endbtn"><i class="icon-calendar icon-white"></i></a>
                                    </div>
                                    <span class="help-inline">Please input the start call</span>
                                  </div>
                                </div>
                            </td>
                        </tr>
                        <tr>                        	
                            <td>
                            	<div class="control-group">
                                  <label for="cbocalltype" class="control-label">Call Type</label>
                                  <div class="controls">
                                    <select id="cbocalltype" name="cbocalltype">
                                      <option value="">Please choose</option>
                                      <option value="Conversion">Conversion</option>
                                      <option value="VIP">VIP</option>
                                      <option value="Retention">Retention</option>
                                    </select>
                                  </div>
                                </div>
                            </td>
                            <td>
                            	 <div class="control-group">
                                  <label for="cboCategory" class="control-label">Call Category</label>
                                  <div class="controls">
                                    <select id="cboCategory" name="cboCategory">
                                      <option value="">Please choose</option>
                                    <?php while ($row = mysql_fetch_assoc($category)) { ?>
                                      <option value="<?php echo $row['category_id']?>"><?php echo $row['category_name']?></option>
                                    <?php } ?>                          
                                    </select>
                                  </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                        	<td>
                            	<div class="control-group">
                                  <label for="cboOutcome" class="control-label">Outcome</label>
                                  <div class="controls">
                                    <select id="cboOutcome" name="cboOutcome">
                                        <option value="">Please choose</option>
                                        <?php mysql_data_seek($outcome, 0); while ($row = mysql_fetch_assoc($outcome)) { ?>
                                            <option value="<?php echo $row['outcome_id']?>"><?php echo $row['outcome_name']?></option>
                                        <?php } ?>
                                    </select>
                                  </div>
                                </div>
                            </td>
                            <td rowspan="3">
                            	 <div class="control-group">
                                    <label class="control-label" for="lastresult">Result</label>
                                    <div class="controls">
                                    	 <input type="hidden" id="lastresultid" name="lastresultid">
                                        <input type="text" class="disabled" id="lastresult" name="lastresult" readonly >
                                    </div>                        
                                </div> 
                                
                                <div class="control-group">
                                  <label for="comment" class="control-label">Comment</label>
                                  <div class="controls">
                                  	<textarea id="comment" name="comment"></textarea>
                                  </div>
                                </div>
                                
                                <label class="radio">
                                <input type="radio" name="rdoType" id="rdoType1" value="1" checked="checked">
                                	Account Active
                                </label>
                                <label class="radio">
                                <input type="radio" name="rdoType" id="rdoType2" value="2">
                                Number Invalid
                                </label>
                                <label class="radio">
                                <input type="radio" name="rdoType" id="rdoType3" value="3">
                                Account Frozen
                                </label> 
                            </td>
                        </tr>
                        <tr>
                        	<td>
                            	 <div class="control-group">
                                  <label for="cboproduct" class="control-label">Product</label>
								  <div class="controls">
                                    <select id="cboproduct" name="cboproduct">
                                      <option value="">Please choose</option>
                                      <option value="Sports">Sports</option>
                                      <option value="Casino">Casino</option>
                                    </select>
                                  </div>
                                </div>
                            </td>                            
                        </tr>
                        <tr>
                        	<td>
                            	 <div class="control-group">                      
                                  <div class="controls">
                                    <label class="checkbox">
                                      <input type="checkbox" name="sendsms" id="sendsms">
                                      Send SMS
                                    </label>
                                    <label class="checkbox">
                                      <input type="checkbox" name="sendemail" id="sendemail">
                                      Send Email
                                    </label>                                               
                                  </div>
                                </div>  
                                
                               
                            </td>
                        </tr>
                        </tbody>
                    </table>
                                   
                  	<input type="hidden" value="<?php echo $member['mb_no']?>" name="userid" />
                    </div>
                    <div class="modal-footer">                   
                          <button class="btn btn-inverse" type="submit" data-loading-text="Saving..." id="btnSave">Save changes</button>
                          <button class="btn btncancel" type="button">Cancel</button>                        
                    </div>                                         
                </form>                         
                </div>
                <!-- End Call -->
                
                <!-- Start comment view -->
                 <div class="modal hide fade" id="myModal3" style="display: none; ">
                    <div class="modal-header">
                      <button data-dismiss="modal" class="close" type="button">x</button>
                      <h3>Comment</h3>
                    </div>
                    <div style="margin:10px" id="divcomment">
                    </div>    
                  </div>
                  <!-- End comment view -->
                  
                   <!-- Start comment view -->
                 <div class="modal hide fade" id="myModal4" style="display: none; ">
                    <div class="modal-header">
                      <button data-dismiss="modal" class="close" type="button">x</button>
                      <h3>Last Comment</h3>
                    </div>
                    <div style="margin:10px" id="divmaincomment">
                    </div>    
                  </div>
                  <!-- End comment view -->
                
                <!-- Start history -->
                <div class="modal hide fade" id="myModal2" style="display: none; width:990px; left:30%;">
                <div class="modal-header">
                  <button data-dismiss="modal" class="close" type="button">x</button>
                  <h3>Follow up</h3>
                </div>
                	<div style="margin:10px">
                	<button href="#" class="btn btn-inverse" style="float:left; margin-right:20px" id="btnfollowup">Follw up Call</button> <div id="followupmsg" class="alert success" style="display:none; margin-left:100px"></div>
                    <div style="width:80%; display:none" id="followupdiv">
                        	<form class="form" method="post" id="frmFollow">
                            <fieldset>							
                            <table width="100%">
                              <tbody>
                              <tr>
                                  <td>
                                  	  <div class="control-group">
                            				<label for="ButtonCreationDemoInput" class="control-label">Start Call</label>
                                  		<div class="controls">
                                          <div class="input-append">
                                            <input type="text" size="16" id="followstart" name="followstart" class="input"><a class="btn btn-inverse" href="#" id="followstartbtn"><i class="icon-calendar icon-white"></i></a>
                                          </div>                                          
                                          </div>                            
                                        </div> 
                                  </td>
                                  <td>
                                  	<div class="control-group">
                                      <label for="ButtonCreationDemoInput" class="control-label">End Call</label>
                                      <div class="controls">
                                        <div class="input-append">
                                          <input type="text" size="16" id="followend" name="followend" class="input"><a class="btn btn-inverse" href="#" id="followendbtn"><i class="icon-calendar icon-white"></i></a>
                                        </div>                                       
                                      </div>                            
                                    </div> 
                                  </td>
                              </tr>
                              <tr>                        	
                                  <td>
                                      <div class="control-group">
                                        <label for="cbofollowcalltype" class="control-label">Call Type</label>
                                        <div class="controls">
                                          <select id="cbofollowcalltype" name="cbofollowcalltype">											<option value="">Please choose</option>
                                            <option value="Conversion">Conversion</option>
                                            <option value="VIP">VIP</option>
                                            <option value="Retention">Retention</option>
                                          </select>
                                        </div>
                                      </div>
                                  </td>
                                  <td>
                                       <div class="control-group">
                                        <label for="cbofollowCategory" class="control-label">Call Category</label>
                                        <div class="controls">
                                          <select id="cbofollowCategory" name="cbofollowCategory">
                                          	<option value="">Please choose</option>
                                          <?php mysql_data_seek($category, 0); while ($row = mysql_fetch_assoc($category)) { ?>
                                            <option value="<?php echo $row['category_id']?>"><?php echo $row['category_name']?></option>
                                          <?php } ?>                          
                                          </select>
                                        </div>
                                      </div>
                                  </td>
                              </tr>
                              <tr>
                              		<td>
                                    	<div class="control-group">
                                          <label for="cbofollowOutcome" class="control-label">Last Outcome</label>
                                          <div class="controls">
                                            <select id="cbofollowOutcome" name="cbofollowOutcome">
                                            	<option value="">Please choose</option>
                                                <?php mysql_data_seek($outcome, 0); while ($row = mysql_fetch_assoc($outcome)) { ?>
                                                    <option value="<?php echo $row['outcome_id']?>"><?php echo $row['outcome_name']?></option>
                                                <?php } ?>
                                            </select>
                                          </div>
                                        </div>
                                        
                                        <div class="control-group">
                                            <label class="control-label" for="followlastresult">Last Result</label>
                                            <div class="controls">
                                                <input type="text" class="disabled" id="followlastresult" name="followlastresult" readonly ><input type="hidden" id="followlastresultid" name="followlastresultid">
                                            </div>                        
                                        </div>
                                    </td>
                                    <td rowspan="3">                                    	  
                                        <div class="control-group">
                                        <label for="followcomment" class="control-label">Comment</label>
                                        <div class="controls">
                                          <textarea id="followcomment" name="followcomment"></textarea>
                                        </div>
                                      </div>  
                                      
                                      <label class="radio">
                                      <input type="radio" name="followrdoType" id="followrdoType1" value="1" checked="checked">
                                          Account Active
                                      </label>
                                      <label class="radio">
                                      <input type="radio" name="followrdoType" id="followrdoType2" value="2">
                                      Number Invalid
                                      </label>
                                      <label class="radio">
                                      <input type="radio" name="followrdoType" id="followrdoType3" value="3">
                                      Account Frozen
                                      </label>
                                    </td>
                              </tr>
                              <tr>
                              	  <td>
                                  	<div class="control-group">
                                      <div class="controls">
                                        <label class="checkbox">
                                          <input type="checkbox" name="followsendsms" id="followsendsms">
                                          Send SMS
                                        </label>
                                        <label class="checkbox">
                                          <input type="checkbox" name="followsendemail"  id="followsendemail">
                                          Send Email
                                        </label>
                                      </div>
                                    </div>
                                  </td>
                                 
                              </tr>
                              </tbody>
                            </table>
                        	
                            <input type="hidden" value="<?php echo $member['mb_no']?>" name="userid" id="ffuserid" />
                            <input type="hidden" name="followid" id="followid" />
							<input type="hidden" name="historyid" id="historyid" />
                            <button href="#" class="btn btn-inverse" style="float:left; margin-right:20px" id="btnfollowupsave" type="submit">Submit</button>                                          
                          </fieldset>                         
                          <form>
                     </div>  
                    <div style="clear:both; padding-top:20px;" id="tblhistory"></div>
                 </div>
                </div>   
                <!-- End History-->
    	</div>
	</div>
</div>	  	
</div><!-- main-body -->
<script>
	 //---- Adding of Call	
	 function addForm(querystring){
		 		
		  $.ajax({
		  url: '<?=$g4['path']?>/process/savecall.php',
		  type: "POST",
		  data: querystring,
		  success: function(data) {
			$("#myModal").modal('hide');	
			loadall();
		  }
		});
	 }
	
	$("#frmAddCall").submit(function(){
		
				
		if($('#txtuser').val()=="" || $('#txtcurrency').val()=="" || $('#startcall').val()=="" || $('#endcall').val()=="" || $('#cbocalltype').val()=="" || $('#cboCategory').val()=="" || $('#cboOutcome').val()=="" || $('#cboproduct').val()==""){
			alert("Please fill up the form properly!");
			return false;
		}
		
  
		var querystring = $(this).serialize();
		$.ajax({
		  url: '<?=$g4['path']?>/process/datevalidate.php',
		  type: "POST",
		  data: querystring,
		  success: function(data) {				    	  
			 if(data!=""){
			 	alert(data);				 
				 return false;
			 }else{
			 	
				$('#btnSave').attr('disabled', 'disabled');	 	
			 	
				 $.ajax({
				  url: '<?=$g4['path']?>/process/validate.php',
				  type: "POST",
				  data: querystring,
				  success: function(data) {				    	  
					  if(data == ""){				
						addForm(querystring);
					  }else{
						  var r=confirm("There is an existing record with the username. Are you sure you want to continue adding?");
						  if (r==true)
							{
								addForm(querystring);
							}
					  }
					  
					  
				   }
				  });
			 }
			 
			$('#btnSave').removeAttr("disabled");
		   }
		  });
		 return false;
	 });   
	//---- End of Adding a Call
	
	
	function addFFForm(querystring){
		$.ajax({
		  url: '<?=$g4['path']?>/process/saveffcall.php',
		  type: "POST",
		  data: querystring,
		  success: function(data) {
			$('#followupdiv').fadeOut('slow', function() {
			  // Animation complete
			  $('#followupmsg').html("Successfully added");
			   $('#followupmsg').fadeIn("slow", function() {
				   $('#followupmsg').fadeOut("slow");
			   });
			});
			$('#tblhistory').load("call_history.php", { 'call_id':$('#followid').val() });	
		  }
		});
	}
	 //---- Adding of FF Call	
	$("#frmFollow").submit(function(){	
		if($('#followstart').val()=="" || $('#followend').val()=="" || $('#cbofollowcalltype').val()=="" || $('#cbofollowCategory').val()=="" || $('#cbofollowOutcome').val()==""){
			alert("Please fill up the form properly!");
			return false;
		}	
		
		var querystring = $(this).serialize();
		$.ajax({
		  url: '<?=$g4['path']?>/process/datevalidate.php',
		  type: "POST",
		  data: querystring,
		  success: function(data) {				    	  
			if(data!=""){
			 	alert(data);				 
				 return false;
			}else{
				addFFForm(querystring);				 
			}
		  }
		});		  
		 return false;
	 });   
	//---- End of Adding a FF Call		 
	  $('#endbtn').click(
      function(e) {
        $('#endcall').AnyTime_noPicker().AnyTime_picker().focus();
        e.preventDefault();
      } );
	  
    $('#startcallbtn').click(
      function(e) {
        $('#startcall').AnyTime_noPicker().AnyTime_picker().focus();
        e.preventDefault();
      } );
	  
	  $('#followstartbtn').click(
      function(e) {
        $('#followstart').AnyTime_noPicker().AnyTime_picker().focus();
        e.preventDefault();
      } );
	  
	  $('#followendbtn').click(
      function(e) {
        $('#followend').AnyTime_noPicker().AnyTime_picker().focus();
        e.preventDefault();
      } );
	   
	  $('#cboOutcome').change(
      function() {		 
	   $.ajax({
		  url: '<?=$g4['path']?>/process/resultpopulate.php',
		  type: "POST",
		  data: { outcome: $(this).val()},
		  dataType: 'json',
		  success: function(data) {			
		  	$('#lastresultid').val(data[0]);	  
			$('#lastresult').val(data[1]);	  
		  }
		});
		 
     } );
	  $('#cbofollowOutcome').change(
     function() {		 
	   $.ajax({
		  url: '<?=$g4['path']?>/process/resultpopulate.php',
		  type: "POST",
		  data: { outcome: $(this).val()},
		  dataType: 'json',
		  success: function(data) {			
			$('#followlastresultid').val(data[0]);	  
			$('#followlastresult').val(data[1]);  
		  }
		});
		 
     } );
	 $('.btncancel').click(function() {	
	 	$("#myModal").modal('hide');	
	 });
	 	 
	 $('#btnaddCall').click(function() {	
	 	$('#txtuser').val("");	  
		$('#txtcurrency').val("");	
		$('#startcall').val("");
		$('#endcall').val("");
		$('#cbocalltype').val("");
		$('#cboCategory').val("");
		$('#cboOutcome').val("");		 
		$('#lastresult').val(""); 
		$('textarea#comment').val("");
		$('#rdoType1').attr('checked', true);
		$('#sendsms').attr('checked', false);
		$('#sendemail').attr('checked', false);	
		$('#myModal').modal({keyboard: false, backdrop: "static"});
	 });
	
	 $('.aRefUser').live("click", function (event) { 
		if( $('#followupdiv').is(':hidden') ) {
			$.ajax({
			  url: '<?=$g4['path']?>/process/callpopulate.php',
			  type: "POST",
			  data: { historyid: $(this).attr("data-link-id")},
			  dataType: 'json',
			  success: function(data) {	
				$('#historyid').val(data[0]);
				$('#followid').val(data[14]);
				$('#followstart').val(data[4]);
				$('#followend').val(data[5]);
				$('#cbofollowcalltype').val(data[1]);
				$('#cbofollowCategory').val(data[3]);
				$('#cbofollowOutcome').val(data[6]);
				$('#followlastresult').val(data[13]);
				$('#followlastresultid').val(data[10]);
				
				if(data[12]==2){
					$('#followrdoType2').attr('checked', true);
				}else if(data[12]==3){
					$('#followrdoType3').attr('checked', true);
				}else{
					$('#followrdoType1').attr('checked', true);
				}
				if(data[8]==1){
					$('#followsendsms').attr('checked', true);
				}else{
					$('#followsendsms').attr('checked', false);
				}
				if(data[9]==1){
					$('#followsendemail').attr('checked', true);
				}else{
					$('#followsendemail').attr('checked', false);
				}
				$('textarea#followcomment').val(data[7]);			  
				$('#ffuserid').val(data[2]);
			  }
			});
			
			$('#followupdiv').fadeIn('slow', function() {
				// Animation complete			
			});
		}else{
			$('#historyid').val("");			
			$('#followstart').val("");
			$('#followend').val("");
			$('#cbofollowcalltype').val("");
			$('#cbofollowCategory').val("");
			$('#cbofollowOutcome').val("");
			$('#followlastresult').val("");
			$('#followrdoType1').attr('checked', true);
			$('#followsendsms').attr('checked', false);
			$('#followsendemail').attr('checked', false);
			$('textarea#followcomment').val("");
			$('#followupdiv').fadeOut('fast', 'swing', function() {
				// Animation complete
			});
		}
	 });
	
	$('#myModal2').on('show', function () {		
		$('#historyid').val("");
		$('#followstart').val("");
		$('#followend').val("");
		$('#cbofollowcalltype').val("");
		$('#cbofollowCategory').val("");
		$('#cbofollowOutcome').val("");
		$('#followlastresult').val("");
		$('#followrdoType1').attr('checked', true);
		$('#followsendsms').attr('checked', false);
		$('#followsendemail').attr('checked', false);
		$('textarea#followcomment').val("");
		$('#followupdiv').fadeOut('fast', 'swing', function() {
				// Animation complete
		});
    })
	
	 $('#btnfollowup').click(function() {		
		if( $('#followupdiv').is(':hidden') ) {		
			$('#historyid').val("");
			$('#followstart').val("");
			$('#followend').val("");
			$('#cbofollowcalltype').val("");
			$('#cbofollowCategory').val("");
			$('#cbofollowOutcome').val("");
			$('#followlastresult').val("");
			$('#followrdoType1').attr('checked', true);
			$('#followsendsms').attr('checked', false);
			$('#followsendemail').attr('checked', false);
			$('textarea#followcomment').val("");			
			
		  $('#followupdiv').fadeIn('slow', function() {
			// Animation complete			
		  });
		}else{
		  $('#followupdiv').fadeOut('slow', function() {
			// Animation complete
		  });
		}
    });
	
	function loadall(){
		var data = { 'user_ids[]' : []};
		$("#agentlist :checked").each(function() {				
			data['user_ids[]'].push($(this).val());				
		});
		
		var datatype = { 'call_type[]' : []};
		$("#typelist :checked").each(function() {				
			datatype['call_type[]'].push($(this).val());				
		});
		
		var dataoutcome = { 'call_outcome[]' : []};
		$("#outcomelist :checked").each(function() {				
			dataoutcome['call_outcome[]'].push($(this).val());				
		});
		
		var dataresult = { 'call_result[]' : []};
		$("#resultlist :checked").each(function() {				
			dataresult['call_result[]'].push($(this).val());				
		});
		
		$('#tblCall').load("call_table.php", { 'search': $(".search-query").val(), 'paginate': $("#paginate").val(), 'start': $("#starttxt").val(), 'end': $("#endtxt").val(), 'agent_ids':data['user_ids[]'], 'call_type':datatype['call_type[]'], 'call_outcome':dataoutcome['call_outcome[]'], 'call_result':dataresult['call_result[]']});
	}
	
	loadall();
$(document).ready(function() {	
	var refreshId = setInterval(function() {
		loadall();
	  }, 300000);
	$.ajaxSetup({ cache: false });
});	
	$("#starttxt").focusout(
     function(e) {			
		   $("#paginate").val(0); 		
		   loadall();		 		
     } );
	
	$("#endtxt").focusout(
     function(e) {			
		   $("#paginate").val(0); 		
		   loadall();		 		 
     } );
	 
	$(".navbar-search").submit(function(event){
		event.preventDefault();
	});
	
	  $(".search-query").keyup(
     function(e) {	
		var code = (e.keyCode ? e.keyCode : e.which);
		 if(code == 13) { //Enter keycode
		   $("#paginate").val(0); 		
		   loadall();		 
		 }
     } );
	 
	$(".table tr.tblmain td:not(:last-child)").live("click", function (event) { 		
		varmsg = "";
		
		if($(this).parent().attr('data-status')==2){
			varmsg="This user's number is invalid. Would you like to undo the tagging?";
			tagid ="#rdoTagType2";
		}else if($(this).parent().attr('data-status')==3){
			varmsg="This user's account is frozen. Would you like to undo the tagging?";
			tagid ="#rdoTagType3";
		}else{
			varmsg="This user's account is active. Would you like to change the tagging?";
			tagid ="#rdoTagType1";
		}
		
		 var r=confirm(varmsg);
		if (r==true)
		  {
			  // --- execution goes here
			  $("#txtTagID").val($(this).parent().attr('id'));
			  $(tagid).attr("checked", true);
			  $("#modalTag").modal('show');
		  }			  
		
	});
	
	$('.btnTagcancel').click(function() {	
	 	$("#modalTag").modal('hide');	
	 });
	 
	 $("#frmTagging").submit(function(){
		 var querystring = $(this).serialize();		
		  $.ajax({
		  url: '<?=$g4['path']?>/process/changetag.php',
		  type: "POST",
		  data: querystring,
		  success: function(data) {
			$("#modalTag").modal('hide');
		  }
		});
		return false;
	 });
	 
	 $('#startbtn').click(	 
      function(e) {
		 $("#paginate").val(0); 
        $('#starttxt').AnyTime_noPicker().AnyTime_picker({format: "%Y-%m-%d"}).focus();
        e.preventDefault();
      } 
    );
	$('#endxlsbtn').click(	 
      function(e) {
		  $("#paginate").val(0); 
        $('#endtxt').AnyTime_noPicker().AnyTime_picker({format: "%Y-%m-%d"}).focus();
        e.preventDefault();
      } 
    );
	$('#btnExcel').click(			
		 function(e) { 
		 
		 var agentdata = "";
			$("#agentlist :checked").each(function() {				
				agentdata=agentdata+$(this).val()+",";				
			});
		
		var datatype = "";
		$("#typelist :checked").each(function() {							
			datatype="'"+datatype+$(this).val()+"',";	
		});
		
		var dataoutcome = "";
		$("#outcomelist :checked").each(function() {							
			dataoutcome=dataoutcome+$(this).val()+",";
		});
		
		var dataresult = "";
		$("#resultlist :checked").each(function() {							
			dataresult=dataresult+$(this).val()+",";
		});
		
    	var inputs ='start='+$('#starttxt').val()+'&end='+$('#endtxt').val()+'&search='+$('.search-query').val()+'&agent_ids='+agentdata+'&call_type='+datatype+'&call_outcome='+dataoutcome+'&call_result='+dataresult;
    var url = '<?=$g4['path']?>/call-log-export.php?'+inputs;
    location.href = url;
		 }
    );
	
	$('.dropdown-menu').click(function(event){
     event.stopPropagation();
	});
	
	$("#outcomelist input[type=checkbox]").click(function(){		
		$("#paginate").val(0); 
		loadall();
	});
	
	$("#resultlist input[type=checkbox]").click(function(){		
		$("#paginate").val(0); 
		loadall();
	});
	
	$("#typelist input[type=checkbox]").click(function(){		
		$("#paginate").val(0); 
		loadall();
	});
	
	$("#agentlist input[type=checkbox]").click(function(){		
		$("#paginate").val(0); 
		loadall();
	});
</script>
<?
include_once("./_tail.php");
?>
