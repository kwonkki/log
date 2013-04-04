<?
include_once("./_common.php");

$g4['title'] = "";
include_once("./_head.php");

$rheader = sql_query("SELECT * FROM call_result");
$agents = sql_query("SELECT mb_no, mb_nick FROM ".$g4['table_prefix']."member");

if($_POST['start']!="" && $_POST['end']!=""){
$concatstr = "AND date_format(call_end,'%Y-%m-%d') BETWEEN '".$_POST['start']."' AND '".$_POST['end']."'";
}

?>


<div class="main-body">
	<div class="row">
		  <div class="span8 offset2">
		  	<div id="myCarousel" class="carousel slide">
	            <div class="carousel-inner">
	              <div class="item">
	                <img src="img/carousel-images-1.jpg" alt="">
	                <div class="carousel-caption">
	                  <h4>First Thumbnail label</h4>
	                  <p><?=$member['mb_email']?></p>
	                </div>
	              </div>
	              <div class="item">
	                <img src="img/carousel-images-2.jpg" alt="">
	                <div class="carousel-caption">
	                  <h4>Second Thumbnail label</h4>
	                  <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
	                </div>
	              </div>
	              <div class="item active">
	                <img src="img/carousel-images-3.jpg" alt="">
	                <div class="carousel-caption">
	                  <h4>Third Thumbnail label</h4>
	                  <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
	                </div>
	              </div>
	            </div>
	            <a class="left carousel-control" href="#myCarousel" data-slide="prev">‹</a>
	            <a class="right carousel-control" href="#myCarousel" data-slide="next">›</a>
	          </div>
		  </div>
	</div><!-- row -->
	
	<h1 class="main">WELCOME, HAVE A NICE DAY</h1>
	<div class="row">
		<div class="span4">
			<div class="well">
				<div class="navbar navbar-heading">
					<div class="navbar-inner">
						<div class="container" style="width: auto;">
							<a class="brand" href="#">CSD</a>
						</div>
					</div>
				</div>
				<p><img src="./img/ba01.png" ></p>
				<p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.</p>
			</div>
		</div>
		<div class="span4">
			<div class="well">
				<div class="navbar navbar-heading">
					<div class="navbar-inner">
						<div class="container" style="width: auto;">
							<a class="brand" href="#">CRM</a>
						</div>
					</div>
				</div>
				<p><img src="./img/ba01.png" ></p>
				<p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.</p>
			</div>
		</div>
		<div class="span4">
			<div class="well">
				<div class="navbar navbar-heading">
					<div class="navbar-inner">
						<div class="container" style="width: auto;">
							<a class="brand" href="#">Technical Support</a>
						</div>
					</div>
				</div>
				<p><img src="./img/ba01.png" ></p>
				<p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.</p>
			</div>
		</div>
	</div><!-- row -->
	

	
</div><!-- main-body -->



<?
include_once("./_tail.php");
?>
