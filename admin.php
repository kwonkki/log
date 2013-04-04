<?
include_once("./_common.php");

$g4['title'] = "";
include_once("./_head.php");

if ( !($is_admin == 'super')) {  
	alert("you are not allowed to access this page", "{$g4['path']}");	
}




?>


<div class="main-body">



	<h2>CSD Management</h2>
	<p>You can create and delete the CSD Login ID and manage the ID</p>
	<div class="row">
		<div class="span12">
			<div class="well">
				<div class="navbar navbar-heading">
					<div class="navbar-inner">
						<div class="container" style="width: auto;">
							<a class="brand" href="#">CSD</a>
							
							<a class="btn btn-info pull-right" href="#myModal-CSD" role="button" data-toggle="modal">
                            	<i class="icon-edit icon-white"></i>  
                            	Add                                            
							</a>
							<!-- STR: Add modal -->
							<div class="modal hide fade" id="myModal-CSD">
							  <div class="modal-header">
							    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							    <h3>Add CSD</h3>
							  </div>
							  <div class="modal-body">
							  	<!-- STR : form -->
								<form id="edit-profile" name="form_csd" class="form-horizontal form_csd">
									<fieldset>
										
										<div class="control-group">											
											<label class="control-label" for="CSD ID">CSD ID</label>
											<div class="controls">
												<input type="text" class="input-medium" name="mb_id" id="mb_id" value="" >												
											</div> <!-- /controls -->				
										</div> <!-- /control-group -->
										
										<div class="control-group">											
											<label class="control-label" for="password1">Password</label>
											<div class="controls">
												<input type="password" class="input-medium" name="mb_password" id="mb_password" value="">
											</div> <!-- /controls -->				
										</div> <!-- /control-group -->
										
										<div class="control-group">											
											<label class="control-label" for="LEVEL">LEVEL</label>
											<div class="controls">
												<input type="text" class="input-medium" name="mb_level" id="mb_level" value="">
												<p>Level should be 1 ~ 10</p>
											</div> <!-- /controls -->				
										</div> <!-- /control-group -->
										
										
										<div class="control-group">											
											<label class="control-label" for="CSD NICK NAME">CSD NICK NAME</label>
											<div class="controls">
												<input type="text" class="input-medium" name="mb_nick" id="mb_nick" value="">
												
												<!-- CSD name -->
												<input type="hidden" class="input-medium" name="mb_name" id="mb_name" value="csd">
											</div> <!-- /controls -->				
										</div> <!-- /control-group -->
										
										
										<div class="control-group">											
											<label class="control-label" for="email">Email Address</label>
											<div class="controls">
												<input type="text" class="input-large" name="mb_email" id="mb_email" value="">
											</div> <!-- /controls -->				
										</div> <!-- /control-group -->
										

											
										<div class="form-actions">
											<button type="submit" class="btn btn-primary">Save</button> 
											<button class="btn">Cancel</button>
										</div> <!-- /form-actions -->
									</fieldset>
								</form>					  	
							  	<!-- END : form -->
							    
							  </div>
							</div>							
							<!-- END: modal -->
							<!-- STR: Edit modal -->
							<div class="modal hide fade" id="myModal-CSDEdit">
							  <div class="modal-header">
							    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							    <h3>Edit CSD</h3>
							  </div>
							  <div class="modal-body">
							  	<!-- STR : form -->
								<form id="edit-profile" name="form_csd" class="form-horizontal form_csd_edit">
								<input type="hidden" name="w" value="u">
								<input type="hidden" name="mb_id" id="mb_id" value="">
									<fieldset>
										<div class="control-group">											
											<label class="control-label" for="CSD ID">CSD ID</label>
											<div class="controls">
												<input type="text" class="input-medium" name="mb_id_fake" id="mb_id_fake" value="" disabled>												
											</div> <!-- /controls -->				
										</div> <!-- /control-group -->
										
										<div class="control-group">											
											<label class="control-label" for="password1">Password</label>
											<div class="controls">
												<input type="password" class="input-medium" name="mb_password" id="mb_password" value="">
												<p>If you don't want to change the password, <br>dont input the password</p>
											</div> <!-- /controls -->				
										</div> <!-- /control-group -->
										
										<div class="control-group">											
											<label class="control-label" for="LEVEL">LEVEL</label>
											<div class="controls">
												<input type="text" class="input-medium" name="mb_level" id="mb_level" value="">
												<p>Level should be 1 ~ 10</p>
											</div> <!-- /controls -->				
										</div> <!-- /control-group -->
										
										
										<div class="control-group">											
											<label class="control-label" for="CSD NICK NAME">CSD NICK NAME</label>
											<div class="controls">
												<input type="text" class="input-medium" name="mb_nick" id="mb_nick" value="">
												
												<!-- CSD name -->
												<input type="hidden" class="input-medium" name="mb_name" id="mb_name" value="csd">
											</div> <!-- /controls -->				
										</div> <!-- /control-group -->
										
										
										<div class="control-group">											
											<label class="control-label" for="email">Email Address</label>
											<div class="controls">
												<input type="text" class="input-large" name="mb_email" id="mb_email" value="">
											</div> <!-- /controls -->				
										</div> <!-- /control-group -->
										

											
										<div class="form-actions">
											<button type="submit" class="btn btn-primary">Save</button> 
											<button class="btn">Cancel</button>
										</div> <!-- /form-actions -->
									</fieldset>
								</form>					  	
							  	<!-- END : form -->
							    
							  </div>
							</div>							
							<!-- END: modal -->
						</div>
					</div>
				</div><!-- title -->
				
				<table class="table table-bordered table-striped csd">
	            <colgroup>
	              <col class="span1">
	              <col class="span1">
	              <col class="span1">
	              <col class="span1">
	              <col class="span1">
	              <col class="span1">
	            </colgroup>
	            <thead>
	              <tr>
	                <th>CSD ID</th>
	                <th>CSD NickName</th>
	                <th>CSD Level</th>
	                <th>CSD Email</th>
	                <th>CSD last access</th>
	                <th>Action</th>
	              </tr>
	            </thead>
	            <tbody>
	            
				<?
				$sql_common = " from $g4[member_table] ";
				$sql = " select *
				          $sql_common
				       ";
				$result = sql_query($sql);
				
					for ($i=0; $row=sql_fetch_array($result); $i++) {
				?>
					<tr>
						<td><?= $row[mb_id] ?></td>
						<td><?= $row[mb_nick] ?></td>
						<td><?= $row[mb_level] ?></td>
						<td><?= $row[mb_email] ?></td>
						<td><?= $row[mb_today_login] ?></td>
						<td>
							<a class="btn btn-primary" href="#myModal-CSDEdit" onclick="javascript:getCsdInfo('<?= $row[mb_id] ?>' , '<?= $row[mb_nick] ?>', '<?= $row[mb_level] ?>', '<?= $row[mb_email] ?>' )" role="button" data-toggle="modal" >
	                            <i class="icon-edit icon-white"></i> 
	                            Edit
                            </a>
							<a class="btn btn-danger" href="#" onclick="javascript:delete_csd('<?= $row[mb_id] ?>')">
	                            <i class="icon-trash icon-white"></i> 
	                            Delete
                            </a>
						</td>
					</tr>					            
				
				<?
				}
				?>   				
	              
	              
	            </tbody>
				</table>				
				
			</div>
		</div><!-- span6 -->
		
	</div><!--END : CSD -->
	
	<hr class="bs-docs-separator">
	<h2>Call Log Configuration</h2>
	<p>If you are not familiar this, Don't delete the data</p>
	
	
	<div class="row">
		<div class="span12">
			<div class="well">
				<div class="navbar navbar-heading">
					<div class="navbar-inner">
						<div class="container" style="width: auto;">
							<a class="brand" href="#">Category</a>
							
							<a class="btn btn-info pull-right" href="#myModal" role="button" data-toggle="modal">
                            	<i class="icon-edit icon-white"></i>  
                            	Add                                            
							</a>
							<!-- STR: modal -->
							<div class="modal hide fade" id="myModal">
							  <div class="modal-header">
							    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							    <h3>Add Category</h3>
							  </div>
							  <div class="modal-body">
							  	<!-- STR : form -->
									<form name="form_category" id="form_category">
										<div class="control-group">
										  <input type="text" name="category_name"  class="category_name" onkeyup="category_nameCheck()"  placeholder="Type the Category" >										  
										  <br>
										  <button type="submit" class="btn">Submit</button>
										</div>
									</form>							  	
							  	<!-- END : form -->
							    
							  </div>
							</div>							
							<!-- END: modal -->
							
							
							
							
						</div>
					</div>
				</div><!-- title -->
				
				<table class="table table-bordered table-striped category">
	            <colgroup>
	              <col class="span1">
	              <col class="span4">
	              <col class="span1">
	            </colgroup>
	            <thead>
	              <tr>
	                <th>#</th>
	                <th>Category Name</th>
	                <th>Action</th>
	              </tr>
	            </thead>
	            <tbody>
	            
				<?
				
				$sql = " select * from call_category group by `category_name` order by `category_id` desc
						   ";
				$category = sql_query($sql);
				
					for ($i=0; $row=sql_fetch_array($category); $i++) {
				?>
					<tr>
						<td><?= $row['category_id'] ?></td>
						<td><?= $row['category_name'] ?></td>
						<td>
							<a class="btn btn-danger" href="#" onclick="javascript:delete_category('<?= $row['category_id'] ?>')">
	                            <i class="icon-trash icon-white"></i> 
	                            Delete
                            </a>
						</td>
					</tr>					            
				
				<?
				}
				?>   				
	              
	              
	            </tbody>
				</table>				
				
			</div>
		</div><!-- span6 -->
		
	</div><!--END : 1 row -->
	
	
	
	<div class="row">
		<div class="span12">
			<div class="well">
				<div class="navbar navbar-heading">
					<div class="navbar-inner">
						<div class="container" style="width: auto;">
							<a class="brand" href="#">Result</a>
							
							<a class="btn btn-info pull-right" href="#myModal-Result" role="button" data-toggle="modal">
                            	<i class="icon-edit icon-white"></i>  
                            	Add                                            
							</a>
							<!-- STR: modal -->
							<div class="modal hide fade" id="myModal-Result">
							  <div class="modal-header">
							    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							    <h3>Add Result</h3>
							  </div>
							  <div class="modal-body">
							  	<!-- STR : form -->
									<form name="form_result" id="form_result">
										<div class="control-group">
										  <input type="text" name="result_name"  class="result_name" onkeyup="result_nameCheck()"  placeholder="Type the Result" >										  
										  <br>
										  <button type="submit" class="btn">Submit</button>
										</div>
									</form>							  	
							  	<!-- END : form -->
							    
							  </div>
							</div>							
							<!-- END: modal -->							
							
							
							
						</div>
					</div>
				</div><!-- title -->
				
				<table class="table table-bordered table-striped result">
	            <colgroup >
	              <col class="span1">
	              <col class="span4">
	              <col class="span1">
	            </colgroup>
	            <thead>
	              <tr>
	                <th>#</th>
	                <th>Result Name</th>
	                <th>Action</th>
	              </tr>
	            </thead>
	            <tbody>
	            
	            
				<?
				$sql = " select * from call_result group by `result_name` order by `result_id` desc
			   	";
				$Result = sql_query($sql);
				
				
					for ($i=0; $row=sql_fetch_array($Result); $i++) {
				?>
					<tr>
						<td><?= $row['result_id'] ?></td>
						<td><?= $row['result_name'] ?></td>
						<td>
							<a class="btn btn-danger" href="#" onclick="javascript:delete_result('<?= $row['result_id'] ?>')">
	                            <i class="icon-trash icon-white"></i> 
	                            Delete
                            </a>
						</td>
					</tr>					            
				
				<?
				}
				?>   	
	              
	              
	                       
	            </tbody>
				</table>	
			</div>
		</div><!-- span12 -->
		
	</div><!--END : 2 row -->
<!-- ##################################################################################################################################################-->	
	<!-- STR : 3 Row -->
	<div class="row">
		<!-- STR : Outcome -->
		<div class="span12">
			<div class="well">
				<div class="navbar navbar-heading">
					<div class="navbar-inner">
						<div class="container" style="width: auto;">
							<a class="brand" href="#">Outcome</a>
							
							<a class="btn btn-info pull-right" href="#myModal-outcome" role="button" data-toggle="modal">
                            	<i class="icon-edit icon-white"></i>  
                            	Add                                            
							</a>
							<!-- STR: modal -->
							<div class="modal hide fade" id="myModal-outcome">
							  <div class="modal-header">
							    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							    <h3>Add Outcome</h3>
							  </div>
							  <div class="modal-body">
							  	<!-- STR : form -->
									<form name="form_outcome" id="form_outcome">
									<input type="text" name="outcome_name"  class="outcome_name" onkeyup="outcome_nameCheck()"  placeholder="Type the Outcome" >
										<div class="control-group">
											<select class="span2 outcome_result" name="outcome_result">
								                <option>Select the Result</option>
													<?
														$sql4 = " select DISTINCT  `result_name`, `result_id`  from call_result order by `result_id` desc
														   ";
														$result4 = sql_query($sql4);    
														
														for ($i=0; $row=sql_fetch_array($result4); $i++) {
													
													?>
													<option value="<?=$row['result_id']?>"><?=$row['result_name']?></option> 
													<?
														}
													?>	
							             	</select>
										  <br>
										  <button type="submit" class="btn">Submit</button>
										</div>
									</form>							  	
							  	<!-- END : form -->
							    
							  </div>
							</div>							
							<!-- END: modal -->
						</div>
					</div>
				</div><!-- title -->
				
				<table class="table table-bordered table-striped outcome">
	            <colgroup>
	              <col class="span1">
	              <col class="span2">
	              <col class="span2">
	              <col class="span1">
	            </colgroup>
	            <thead>
	              <tr>
	                <th>#</th>
	                <th>Outcome Name</th>
	                <th>Result</th>
	                <th>Action</th>
	              </tr>
	            </thead>
	            <tbody>
	            
				<?
				
				$sql = " 	SELECT
									a.outcome_id		as outcome_id
									, a.outcome_name	as outcome_name
									, a.result_id		as result_id	
									, b.result_id		as result_id2	
									, b.result_name		as result_name
							FROM  `call_outcome` a
							LEFT JOIN  `call_result` b ON a.result_id = b.result_id
							order by a.outcome_id desc
						   ";
				$outcome = sql_query($sql);
				
					for ($i=0; $row=sql_fetch_array($outcome); $i++) {
				?>
					<tr>
						<td><?= $row['outcome_id'] ?></td>
						<td><?= $row['outcome_name'] ?></td>
						<td><?= $row['result_name'] ?></td>
						<td>
							<a class="btn btn-danger" href="#" onclick="javascript:delete_outcome('<?= $row['outcome_id'] ?>')">
	                            <i class="icon-trash icon-white"></i> 
	                            Delete
                            </a>
						</td>
					</tr>					            
				
				<?
				}
				?>   				
	              
	              
	            </tbody>
				</table>				
				
			</div>
		</div><!-- END : span12 -->
		<!-- END : Outcome -->
		
		
		
	</div><!-- 3 row -->
	
	
	
</div><!-- main-body -->

<?
include_once("./_tail.php");
?>
