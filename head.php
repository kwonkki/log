<?
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가


if ($_SERVER["REQUEST_URI"] != "{$g4['path']}/bbs/register_form.php" ){
	if (!$_SESSION['ss_mb_id']){  
		if($_SERVER["REQUEST_URI"] == "{$g4['path']}/login.php"){
			;
		}else{ 
			goto_url("{$g4['path']}/login.php"); 
		}
	}
}

include_once("$g4[path]/lib/outlogin.lib.php");
include_once("$g4[path]/lib/poll.lib.php");
include_once("$g4[path]/lib/visit.lib.php");
include_once("$g4[path]/lib/connect.lib.php");
include_once("$g4[path]/lib/popular.lib.php");
include_once("$g4[path]/lib/latest.lib.php");
include_once("$g4[path]/head.sub.php");
//print_r2(get_defined_constants());

// 사용자 화면 상단과 좌측을 담당하는 페이지입니다.
// 상단, 좌측 화면을 꾸미려면 이 파일을 수정합니다.
?>

<div class="navbar navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <div class="nav-collapse collapse">
            <ul class="nav nav-pills">
              <li title="Home">
                <a href="<?=$g4[path]?>/">
                	<i class="icon-share-alt"></i>
                	Home
                </a>
              </li>
              <li title="Call Log Page">
                <a href="call_log.php">
                	<i class="icon-share-alt"></i>
                	Call Log
                </a>
              </li>
			  
			<li title="Agent Report">
				<a href=agent-report.php>
					<i class="icon-share-alt"></i>
					Agent Report
				</a>
			</li>
				<!-- admin only access this one -->
				<?php
					if($is_admin == 'super'){
				    	echo "

							<li title=\"Summary Report\">
								<a href=\"agent-details.php\">
									<i class=\"icon-share-alt\"></i>
									Summary Report
								</a>
			                </li>
						
						
							<li title=\"Pivot Result\">
								<a href=\"call-result.php\">
									<i class=\"icon-share-alt\"></i>
									Pivot Result
								</a>
			                </li>
							


							<li title=\"Admin Page\">
								<a href=\"admin.php\">
									<i class=\"icon-share-alt\"></i>
									Admin
								</a>
			                </li>
						";
					}
				?>
                        
            </ul>
            
            <a class="brand" href="#">Call Log</a>
            <!-- STR : right menu -->
            <ul class="nav pull-right">
                <li>
                    <form class="navbar-search pull-left" action="">
                        <input type="text" class="search-query span2" placeholder="Search">
                    </form>
                </li>
                <li class="divider-vertical"></li>
                <li>
                    <ul class="nav">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="icon-user"></i>   <?=$member['mb_nick']?>
                                <b class="caret"></b>
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <div style="width: 314px">
                                        <div class="modal-header">

                                            <h3><?=$member['mb_nick']?></h3>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row-fluid">
                                                <div class="span3">
                                                    <img src="./img/defaultPhoto.png" alt="" class="thumbnail span12">
                                                </div>
                                                <div class="span9">
                                                    <a href="#"><i class="icon-cogs"></i></a>
                                                    <a href="#"><i class="icon-cogs"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button href="#" onclick="location.href='<?=$g4['path']?>/bbs/logout.php' " class="btn btn-primary"><i class="icon-off"></i> Log Out</button>
                                        </div>
                                    </div>

                                </li>

                            </ul>
                        </li>
                    </ul>
                </li>
            </ul>
            <!-- END: right menu -->
          </div>
        </div>
      </div>
    </div>