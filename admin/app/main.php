<?php
session_start();

include '../common/inc.common.php';

if(!isset($_SESSION['user_']))
{
	header("Location: index.php");
}
//$res=mysql_query("SELECT * FROM users WHERE user_id=".$_SESSION['user']);
//$userRow=mysql_fetch_array($res);
?>
<!DOCTYPE html>
<!-- Template Name: Clip-One - Responsive Admin Template build with Twitter Bootstrap 3.x Version: 1.3 Author: ClipTheme -->
<!--[if IE 8]><html class="ie8 no-js" lang="en"><![endif]-->
<!--[if IE 9]><html class="ie9 no-js" lang="en"><![endif]-->
<!--[if !IE]><!-->
<html lang="ja" class="no-js">
    <!--<![endif]-->
    <!-- start: HEAD -->
    <head>
        <title>セルフオーダーシステムマネージャー</title>
        <!-- start: META -->
        <meta charset="utf-8" />
        <!--[if IE]><meta http-equiv='X-UA-Compatible' content="IE=edge,IE=9,IE=8,chrome=1" /><![endif]-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
        <meta content="" name="description" />
        <meta content="" name="author" />
        <!-- end: META -->
        <!-- start: MAIN CSS -->
		<link rel="stylesheet" href="../assets/plugins/select2/select2.css">
		<link rel="stylesheet" href="../assets/plugins/datepicker/css/datepicker.css">

		
        <link rel="stylesheet" href="../assets/plugins/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="../assets/plugins/font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="../assets/fonts/style.css">
        <link rel="stylesheet" href="../assets/css/main.css">
        <link rel="stylesheet" href="../assets/css/main-responsive.css">
        <link rel="stylesheet" href="../assets/plugins/iCheck/skins/all.css">
        <link rel="stylesheet" href="../assets/plugins/bootstrap-colorpalette/css/bootstrap-colorpalette.css">
        <link rel="stylesheet" href="../assets/plugins/perfect-scrollbar/src/perfect-scrollbar.css">
        <link rel="stylesheet" href="../assets/css/theme_orange_black.css" type="text/css" id="skin_color">
        <link rel="stylesheet" href="../assets/css/print.css" type="text/css" media="print"/>
        <link rel="stylesheet" href="../assets/plugins/bootstrap-fileupload/bootstrap-fileupload.min.css" rel="stylesheet">
		<link rel="stylesheet" href="../assets/plugins/DataTables/media/css/DT_bootstrap.css" />
        <!--[if IE 7]>
        <link rel="stylesheet" href="../assets/plugins/font-awesome/css/font-awesome-ie7.min.css">
        <![endif]-->
        <!-- end: MAIN CSS -->
        <!-- start: CSS REQUIRED FOR THIS PAGE ONLY -->
        <link rel="stylesheet" href="../assets/plugins/fullcalendar/fullcalendar/fullcalendar.css">
        <!-- end: CSS REQUIRED FOR THIS PAGE ONLY -->
        <link rel="shortcut icon" href="favicon.ico" />
		<style>
            
		.title{
        background-color: #d66514;
        text-decoration: none;
        }
        
        .title1 {
            text-decoration: none;
        }
		
		</style>
    </head>

    <body>
            <div class="">
			
			
			<div style="float: right; font-size:16px; color: floralwhite; width: 580px;">
                <div style="  font-size:20px;padding-top: 12px; padding-left: 300px;">
                    <span style="font-size:16px; color: black; font-size:20px;">
                    者 : </span> <span style="color: black;"><?php echo $_SESSION['user_']; ?></span>  <br></div>
                </div>
			
                <div class="navbar-header">
                    <!-- start: RESPONSIVE MENU TOGGLER -->
                    <button data-target=".navbar-collapse" data-toggle="collapse" class="navbar-toggle" type="button">
                        <span class="clip-list-2"></span>
                    </button>

                </div>
                <div class="navbar-tools">
                    <!-- start: TOP NAVIGATION MENU -->	
                   
                </div>
            </div>
            <!-- end: TOP NAVIGATION CONTAINER -->
        </div>
        <!-- end: HEADER -->
        <!-- start: MAIN CONTAINER -->
        <div class="main-container">
            <div class="navbar-content">
                <!-- start: SIDEBAR -->
                <div class="main-navigation navbar-collapse collapse">
                    
                    <!-- start: MAIN NAVIGATION MENU -->
                    <ul class="main-navigation-menu">

				 
						
					<?php
 if($_SESSION['type']==1 ){
	 ?>	

<!------------担当者を管理---------------->
						
				<li>
                            <a href="javascript:void(0)"><i class="clip-cog-2"></i>
                                <span class="title"> 担当者を管理 </span><i class="icon-arrow"></i>
                                <span class="selected"></span>
                            </a>

                    <ul class="sub-menuI">
        　　　　　　　　 <li>
                                <a href="javascript:loadContainer('../works/users.php','Filter student')">
                                                <span class="title1">担当者を追加/更新する </span>
                                </a>
                    　  </li>								
                    </ul>

                </li> 			

<!---------------注文履歴---------------->	
				<li>
                            <a href="javascript:void(0)"><i class="clip-cog-2"></i>
                                <span class="title">注文履歴 </span><i class="icon-arrow"></i>
                                <span class="selected"></span>
                            </a>

                            <ul class="sub-menuI">
                                <li>
                                        <a href="javascript:loadContainer('../orders/order_filters.php','Filter student')">
                                                    <span class="title1">注文を表示</span>
                                        </a>
                                </li>                                  
                            </ul>
                </li> 	

<!---------------製品管理---------------->	
				<li>
                            <a href="javascript:void(0)"><i class="clip-cog-2"></i>
                                <span class="title">製品管理 </span><i class="icon-arrow"></i>
                                <span class="selected"></span>
                            </a>

                            <ul class="sub-menuI">
                                <li>
                                        <a href="javascript:loadContainer('../drinks/drinks_list.php','Filter student')">
                                                    <span class="title1">製品管理</span>
                                        </a>
                                </li>                                  
                            </ul>
                </li> 	
			
						
					<?php	
}elseif($_SESSION['type']==2){

?>	

	<li>
                            <a href="javascript:void(0)"><i class="clip-cog-2"></i>
                                <span class="title"> STOCKS </span><i class="icon-arrow"></i>
                                <span class="selected"></span>
                            </a>
                            <ul class="sub-menuI">
	 <li>
     <a href="javascript:loadContainer('../clients/stock.php','Filter student')">
                                        <span class="title1">Add NEW STOCK  </span>
                                    </a>
                                </li>
                               
	 <li>
     <a href="javascript:loadContainer('../clients/stock_filters.php','Filter student')">
                                        <span class="title1">Manage STOCK  </span>
                                    </a>
                                </li>	


								
						</ul></li> 


<?php
}elseif($_SESSION['type']==2){
	?>
	
	
	<?php
}
?>

<li>
                           
                                 <a href="logout.php?logout" style="text-decoration: blink; color: yellow;font-weight:bold;padding-left: 60px; font-size: 20px;">ログアウト</a> 
                       
                           </li> 
                       
                       
                    </ul>
                    <!-- end: MAIN NAVIGATION MENU -->
                </div>
                <!-- end: SIDEBAR -->
            </div>
            
            <!-- start: PAGE -->
            <div class="main-content">
			
				
                <!-- start: PANEL CONFIGURATION MODAL FORM -->
                <div class="modal fade" id="panel-config" tabindex="-1" role="dialog" >

                    <!-- /.modal-dialog -->
                </div>
                <!-- /.modal -->
                <!-- end: SPANEL CONFIGURATION MODAL FORM -->
                
                <div class="container">
                    <!-- start: PAGE HEADER -->
                  
                    <!-- start: PAGE CONTENT -->
                    <div class="row" id="content-replacer">    
                        
                    <div style="margin-top: 360px; margin-left:45%;" >
                         <img   src="h_logo.png" alt="where is the image"> <br>

                    </div>     
                    
                         
                                        
                    </div>
                    <!-- end: PAGE CONTENT-->
                </div>
            </div>
            <!-- end: PAGE -->
        </div>
        <!-- end: MAIN CONTAINER -->
        
        <!-- start: FOOTER -->
        <div class="footer clearfix">

                <span style="color: #c9ad86;"> ® <script type="text/javascript">
                    document.write(new Date().getFullYear());
                </script> Niseko Prince Hotel Nagisatei • All Rights Reserved</span>
           
            <div class="footer-items">
                <span class="go-top"><i class="clip-chevron-up"></i></span>
            </div>
        </div>
        <!-- end: FOOTER -->
        <div id="event-management" class="modal fade" tabindex="-1" data-width="760" style="display: none;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                            &times;
                        </button>
                        <h4 class="modal-title">Event Management</h4>
                    </div>
                    <div class="modal-body"></div>
                    <div class="modal-footer">
                        <button type="button" data-dismiss="modal" class="btn btn-light-grey">
                            Close
                        </button>
                        <button type="button" class="btn btn-danger remove-event no-display">
                            <i class='fa fa-trash-o'></i> Delete Event
                        </button>
                        <button type='submit' class='btn btn-success save-event'>
                            <i class='fa fa-check'></i> Save
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!-- start: MAIN JAVASCRIPTS -->
        <!--[if lt IE 9]>
        <script src="../assets/plugins/respond.min.js"></script>
        <script src="../assets/plugins/excanvas.min.js"></script>
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <![endif]-->
        <!--[if gte IE 9]><!-->
        <script src="../assets/js/jquery.min.js"></script>
        <!--<![endif]-->
        <script src="../assets/plugins/jquery-ui/jquery-ui-1.10.2.custom.min.js"></script>
        <script src="../assets/plugins/bootstrap/js/bootstrap.min.js"></script>
        <script src="../assets/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js"></script>
        <script src="../assets/plugins/blockUI/jquery.blockUI.js"></script>
        <script src="../assets/plugins/iCheck/jquery.icheck.min.js"></script>
        <script src="../assets/plugins/perfect-scrollbar/src/jquery.mousewheel.js"></script>
        <script src="../assets/plugins/perfect-scrollbar/src/perfect-scrollbar.js"></script>
        <script src="../assets/plugins/less/less-1.5.0.min.js"></script>
        <script src="../assets/plugins/jquery-cookie/jquery.cookie.js"></script>
        <script src="../assets/plugins/bootstrap-colorpalette/js/bootstrap-colorpalette.js"></script>
        <script src="../assets/js/main.js"></script>
		<script src="../assets/plugins/DataTables/media/js/jquery.dataTables.min.js" type="text/javascript" ></script>
		<script src="../assets/plugins/DataTables/media/js/DT_bootstrap.js" type="text/javascript" ></script>
        <!-- end: MAIN JAVASCRIPTS -->
        <!-- start: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
		
        <!--<script src="../assets/plugins/flot/jquery.flot.js"></script>
        <script src="../assets/plugins/flot/jquery.flot.pie.js"></script>
        <script src="../assets/plugins/flot/jquery.flot.resize.min.js"></script>
        <script src="../assets/plugins/jquery.sparkline/jquery.sparkline.js"></script>
        <script src="../assets/plugins/jquery-easy-pie-chart/jquery.easy-pie-chart.js"></script> 
        <script src="../assets/plugins/jquery-ui-touch-punch/jquery.ui.touch-punch.js"></script>
        <script src="../assets/plugins/fullcalendar/fullcalendar/fullcalendar.js"></script>
        <script src="../assets/js/index.js"></script>-->
        <script src="../assets/js/loadFile.js"></script>
        <!-- end: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
		<!-- start: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
		<script src="../assets/plugins/jquery-validation/dist/jquery.validate.min.js"></script>
                <script src="../assets/plugins/bootstrap-fileupload/bootstrap-fileupload.min.js"></script>
		<script src="../assets/plugins/summernote/build/summernote.min.js"></script> 
		<script src="../assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
		<script src="../assets/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>
		<script src="../assets/plugins/bootstrap-daterangepicker/moment.min.js"></script>
                <script src="../assets/plugins/ckeditor/ckeditor.js"></script>
		<script src="../assets/plugins/ckeditor/adapters/jquery.js"></script>

                <script src="../assets/js/form-validation.js"></script>
		<script src="../assets/js/form-elements.js"></script>
		<!-- end: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->

        <script>
            jQuery(document).ready(function() {
                Main.init();
                //Index.init();
                //FormValidator.init();
            });
        </script>
    </body>
    <!-- end: BODY -->
</html>