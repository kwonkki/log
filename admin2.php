<?
include_once("./_common.php");

$g4['title'] = "";
include_once("./_head.php");

$category = sql_query("SELECT * FROM call_category");
$outcome = sql_query("SELECT * FROM call_outcome INNER JOIN call_result ON call_outcome.result_id=call_result.result_id");


?>


<div class="main-body">

	
	<!-- row -->
	<div class="row">
		<div class="span12">
			
				<ul class="nav nav-tabs" id="myTab">
                              <li class="active"><a href="#category"  data-toggle="tab">Category</a></li>
                              <li><a href="#outcome"  data-toggle="tab">Outcome</a></li>
                              <li><a href="#result"  data-toggle="tab">Result</a></li>
                            </ul>
                               
                            <div class="tab-content">
                              <div class="tab-pane active" id="category">
                              	<h2>Category</h2>
                                <div style="margin-top:10px;margin-bottom:10px;">
	                                <a class="btn btn-inverse btn-large">Add Category</a>
                                </div>
                              	<table class="table table-striped" style="border:1px solid #CCC">
                                	<thead>
                                        <tr>
                                          <th>Category Id</th>
                                          <th>Category Name</th>                                          <th>&nbsp;</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    	<?php while($row = sql_fetch_array($category)){ ?>
                                        <tr>
                                            <td><?php echo $row['category_id']; ?></td>
                                            <td><?php echo $row['category_name']; ?></td>
                                            <td><a class="btn btn-inverse">Edit</a></td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                              	</table>
                              </div>
                              <div class="tab-pane" id="outcome">
                              	<h2>Outcome</h2>
                                <div style="margin-top:10px;margin-bottom:10px;">
	                                <a class="btn btn-inverse btn-large">Add Outcome</a>
                                </div>
                              	<table class="table table-striped" style="border:1px solid #CCC">
                                	<thead>
                                        <tr>
                                          <th>Outcome Id</th>
                                          <th>Outcome Name</th>
                                          <th>Result</th>                                          <th>&nbsp;</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    	<?php while($row = sql_fetch_array($outcome)){ ?>
                                        <tr>
                                            <td><?php echo $row['outcomeid']; ?></td>
                                            <td><?php echo $row['outcome_name']; ?></td>
                                            <td><?php echo $row['result_name']; ?></td>
                                            <td><a class="btn btn-inverse">Edit</a></td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                              	</table>
                              </div>
                              <div class="tab-pane" id="result">
                              	<table>
                                	<tr>
                                    	<td><h2>Result</h2></td>
                                    </tr>
                              	</table>
                              </div>
                            </div>
				
			
		</div>
	</div><!-- row -->
	
	
	
	
</div><!-- main-body -->


<?
include_once("./_tail.php");
?>
