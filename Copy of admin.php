<?
include_once("./_common.php");

$g4['title'] = "";
include_once("./_head.php");




?>


<div class="main-body">
	<div class="row">
		<div class="span4">
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
		<div class="span4">
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
		</div><!-- span6 -->
	</div><!--END : 1 row -->
<!-- ##################################################################################################################################################-->	
	<!-- STR : 2 Row -->
	<div class="row">
		<!-- STR : Outcome -->
		<div class="span6">
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
		</div><!-- END : span6 -->
		<!-- END : Outcome -->
		
		
		
	</div><!-- row -->
	
	
	
</div><!-- main-body -->

<?
include_once("./_tail.php");
?>
