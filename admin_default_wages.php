<?php 
session_start();
                        $l_id=$_SESSION['id'];
                        $login_session=$_SESSION['user_email'];
                        $login_type = $_SESSION['type'];
                        if($login_session==""){
                           header("Location: logout.php");
                        }else{
                            if($login_type!="admin"){
                                header("Location: logout.php"); 
                            }
                        }


                        include("configs.php");
                        
                    ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Settings</title>
    <!-- Favicon and touch icons -->
    <link rel="shortcut icon" href="assets/dist/img/ico/fav.png">
    <!-- Start Global Mandatory Style
         =====================================================================-->
    <!-- jquery-ui css -->
    <link href="assets/plugins/jquery-ui-1.12.1/jquery-ui.min.css" rel="stylesheet" type="text/css" />
    <!-- materialize css -->
    <link href="assets/plugins/materialize/css/materialize.min.css" rel="stylesheet">
    <!-- Bootstrap css-->
    <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Animation Css -->
    <link href="assets/plugins/animate/animate.css" rel="stylesheet" />
    <!-- Material Icons CSS -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Monthly css -->
    <link href="assets/plugins/monthly/monthly.css" rel="stylesheet" type="text/css" />
    <!-- simplebar scroll css -->
    <link href="assets/plugins/simplebar/dist/simplebar.css" rel="stylesheet" type="text/css" />
    <!-- mCustomScrollbar css -->
    <link href="assets/plugins/malihu-custom-scrollbar/jquery.mCustomScrollbar.css" rel="stylesheet" type="text/css" />
    <!-- custom CSS -->
    <link href="assets/dist/css/stylematerial.css" rel="stylesheet">
</head>
<body style="background-color: white;">









    <div id="wrapper">
        <!--navbar top-->
        <nav class="navbar navbar-inverse navbar-fixed-top">
            <!-- Logo -->
            <a class="navbar-brand pull-left" href="dashboard.php">
                <img src="assets/dist/img/logo3.png" alt="logo" width="205" height="60">
            </a>

            <a href="logout.php" class="pull-right" style="margin-right: 20px;">Log Out</a>
            
            
            
        </nav>
        <!-- Sidebar -->
        <div id="sidebar-wrapper" class="waves-effect" data-simplebar>
            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <?php include('inc/adminmenu.php');?> <!-- Sidebarul<ul class="nav" id="side-menu">
                        <li class="nav-item " >
                            <a class="nav-link " href="dashboard.php">
                                <img src="assets/dist/img/Icon/home.png" /><span style="color: white;"><b>Home</b></span>
                            </a>
                        </li>
                        
                        <li>
                            <a><img src="assets/dist/img/Icon/users.png" /><span style="color: white;"><b>Students</b></span><span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li><a href="admin_stud.php?f_name=a&f_city=a&f_sub=a&f_date=a">Student list</a></li>
                                <li><a href="admin_stud_assign.php?f_id=a&s_name=a&t_name=a&f_date=a">Student Assignments</a></li>
                                <li><a href="all_packages.php">Student Packages</a></li>
                                <li><a href="admin_buy_package.php">Buy Package</a></li>
                            </ul>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="admin_teacher.php">
                                <img src="assets/dist/img/Icon/icon1.png" /><span style="color: white;"><b>Tutors</b></span><span class="fa arrow"></span>
                            </a>
                            <ul class="nav nav-second-level">
                                <li><a href="admin_teacher.php?f_name=a&f_email=a&f_status=a&f_certified=a&f_date=a">Tutor list</a></li>
                                <li><a href="admin_teacher_assign.php?f_id=a&s_name=a&t_name=a&f_date=a">Tutor Assignments</a></li>
                                <li><a href="admin_teacher_rejected.php?f_name=a&f_email=a&f_date=a">Rejected Tutor list</a></li>
                            </ul>
                        </li>


                        <li class="nav-item">
                            <a class="nav-link" href="all_sessions.php?f_id=a&t_name=a&s_name=a&f_duration=a&f_ses_date=a&f_sub_date=a">
                                <img src="assets/dist/img/Icon/icon5.png" /><span style="color: white;"><b>Sessions</b></span>
                            </a>
                        </li>


         
                        <li>
                            <a><img src="assets/dist/img/Icon/icon3.png" /><span style="color: white;"><b>Homework Assignments</b></span><span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li><a href="admin_homework_assign.php?f_id=a&t_name=a&s_name=a&f_status=a&f_as_date=a&f_due_date=a&f_comp_date=a">Homework Assignments</a></li>
                                <li ><a href="admin_stud_assign_chat.php"><span>Assignments Chat</span></a></li>
                                
                            </ul>
                        </li>


                        
                        <li>
                            <a><img src="assets/dist/img/Icon/payment.png" /><span style="color: white;"><b>Payments</b></span><span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li><a href="invoices.php?iid=a&sn=a&st=a&fd=a">Student Invoices</a></li>
                                <li><a href="paycheques.php?iid=a&tn=a&st=a&ad=a">Tutor Paycheques</a></li><li><a href="tutorUnpaidSession.php?iid=a&tn=a&st=a&ad=a">Tutor Session Payment</a></li>
                                
                            </ul>
                        </li>

                        <li class="nav-item">
                            <a><img src="assets/dist/img/Icon/icon7.png" /><span style="color: white;"><b>CMS</b></span><span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li><a href="all_coupons.php">Coupons</a></li>
                                <li><a href="admin_activity_log.php">Activity Log</a></li> 
                                <li><a href="admin_mail_log.php?f_mail=a">Mail Log</a></li>
                                
                                <li><a href="send_email.php">Send Email</a></li>
                                <li><a href="send_notification.php">Send Notifications</a></li>
                                <li><a href="promotion_management.php">Promotion Management</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#"><img src="assets/dist/img/Icon/icon6.png" /><span style="color: white;"><b>Reports</b><span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li><a href="report_cards.php">Report Cards</a></li>
                                <li><a href="view_monthly_data.php">View Monthly Data</a></li>
                                
                                <li><a href="tutor_report.php">Tutor Report</a></li>
                                <li><a href="student_report.php">Student Report</a></li>
                            </ul>							
							
                        </li>
                        <li class="active">
                            <a><img src="assets/dist/img/Icon/icon8.png" /><span style="color: white;"><b>System</b></span><span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li ><a href="admin_system_settings.php">Settings</a></li>
                                <li ><a href="admin_default_wages.php"><span style="color: white;">Default Wages</span></a></li>
                                <li><a href="admin_countries.php">Countries</a></li>
                                <li><a href="admin_states.php">Province / States</a></li>
                                <li><a href="admin_grades.php">Grades</a></li>

                            </ul>
                        </li>
                        
                        <li class="side-last"></li>
                    </ul>
                    
                    <!-- ./sidebar-nav -->
                </div>
                <!-- ./sidebar -->
            </div>
            <!-- ./sidebar-nav -->
        </div>
        <!-- ./sidebar-wrapper -->
        <div id="page-content-wrapper">
            <div class="page-content">
                <!-- Content Header (Page header) -->
                <section class="content-header" style="background-color: #DFE2DB;">
                    <br>
                    <div class="row" style="margin-bottom: 5px; ">
                        <div class="col-md-7">
                            <h1> Control Panel</h1>
                        </div>  
                        <div class="col-md-5">
                            <p style="color: black; font-family: Verdana; margin-top: 20px;">
                                    Hi LearnOn !, You are logged in as Administrator
                            </p>  
                        </div>
                           
                    </div>
                </section>
                <!-- page section -->
                <div class="container-fluid">
                    
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="card">
                                <div class="card-header">
                                    
                                    <b><h2>Default Wages</h2></b>
                                </div>
                                <div class="card-content">
                                    <div class="row">
                                        <div class="col-md-4 col-lg-4 col-sm-12 col-xs-12">
                                            <b>Tutor Pay Rate</b>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
                                            <span style="color: red"><b>*</b></span>Pay rates for United States
                                        </div>
                                        <div class="col-lg-3  col-md-3 col-sm-12 col-xs-12">
                                            <input type="text" name="t_us_val" id="t_us_val" class="form-control" style="text-align: center;">
                                            
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
                                            <span style="color: red"><b>*</b></span>Pay rates for Canada
                                        </div>
                                        <div class="col-lg-3  col-md-3 col-sm-12 col-xs-12">
                                            <input type="text" name="t_canada_val" id="t_canada_val" class="form-control" style="text-align: center;">
                                            
                                        </div>
                                    </div>

                                   <!-- <div class="row">
                                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
                                            <span style="color: red"><b>*</b></span>Pay rates for Alberta
                                        </div>
                                        <div class="col-lg-3  col-md-3 col-sm-12 col-xs-12">
                                            <input type="text" name="t_alberta_val" id="t_alberta_val" class="form-control" style="text-align: center;">
                                            
                                        </div>
                                    </div> -->
                                    <hr>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-4 col-lg-4 col-sm-12 col-xs-12">
                                            <b>Student Pay Rate</b>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
                                            <span style="color: red"><b>*</b></span>Invoice rate for United States
                                        </div>
                                        <div class="col-lg-3  col-md-3 col-sm-12 col-xs-12">
                                            <input type="text" name="s_us_val" id="s_us_val" class="form-control" style="text-align: center;">
                                            
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
                                            <span style="color: red"><b>*</b></span>Invoice rate for Canada
                                        </div>
                                        <div class="col-lg-3  col-md-3 col-sm-12 col-xs-12">
                                            <input type="text" name="s_canada_val" id="s_canada_val" class="form-control" style="text-align: center;">
                                            
                                        </div>
                                    </div>

                                    <!--<div class="row">
                                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
                                            <span style="color: red"><b>*</b></span>Invoice rate for Alberta
                                        </div>
                                        <div class="col-lg-3  col-md-3 col-sm-12 col-xs-12">
                                            <input type="text" name="s_alberta_val" id="s_alberta_val" class="form-control" style="text-align: center;">
                                            
                                        </div>
                                    </div>-->


                                    

                                    <div class="row" id="prob_disp_w" style="display: none;">
                                        <div class="col-lg-6 col-md-6 col-md-offset-3 col-lg-offset-3 col-sm-12 col-xs-12 ">
                                            <span style="color: red">* Marked Fields are Mandatory !!</span>
                                        </div>
                                        
                                    </div>

                                    

                                    <div class="row">
                                        <div class="col-lg-1 col-md-1 col-sm-4 col-xs-4 col-sm-offset-4 col-xs-offset-4 col-md-offset-10 col-lg-offset-10">
                                            <button class="btn btn-info" id="btn_save">SAVE CHANGES</button>
                                        </div>
                                        
                                    </div>


                                </div>

                                

                            </div>
                        </div>
                    </div>
                        
                    
                        
                         
                       
                </div>
                <!-- ./cotainer -->
            </div>
            <!-- ./page-content -->
        </div>
        <!-- ./page-content-wrapper -->
        
    </div>
    <!-- ./page-wrapper -->
    <!-- Preloader -->
    <div id="preloader">
        <div class="preloader-position">
            <div class="preloader-wrapper big active">
                <div class="spinner-layer spinner-teal">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="gap-patch">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Preloader -->
    <!-- Start Core Plugins
         =====================================================================-->
    <!-- jQuery -->
    <script src="assets/plugins/jQuery/jquery-3.2.1.min.js" type="text/javascript"></script>
    <!-- jquery-ui -->
    <script src="assets/plugins/jquery-ui-1.12.1/jquery-ui.min.js" type="text/javascript"></script>
    <!-- Bootstrap -->
    <script src="assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- materialize  -->
    <script src="assets/plugins/materialize/js/materialize.min.js" type="text/javascript"></script>
    <!-- metismenu-master -->
    <script src="assets/plugins/metismenu-master/dist/metisMenu.min.js" type="text/javascript"></script>
    <!-- SlimScroll -->
    <script src="assets/plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
    <!-- m-custom-scrollbar -->
    <script src="assets/plugins/malihu-custom-scrollbar/jquery.mCustomScrollbar.concat.min.js" type="text/javascript"></script>
    <!-- scroll -->
    <script src="assets/plugins/simplebar/dist/simplebar.js" type="text/javascript"></script>
    <!-- custom js -->
    <script src="assets/dist/js/custom.js" type="text/javascript"></script>
    <!-- End Core Plugins
         =====================================================================-->
    <!-- Start Page Lavel Plugins
         =====================================================================-->
    <!-- Sparkline js -->
    <script src="assets/plugins/sparkline/sparkline.min.js" type="text/javascript"></script>
    <!-- Counter js -->
    <script src="assets/plugins/counterup/jquery.counterup.min.js" type="text/javascript"></script>
    <!-- ChartJs JavaScript -->
    <script src="assets/plugins/chartJs/Chart.min.js" type="text/javascript"></script>
    <!-- Monthly js -->
    <script src="assets/plugins/monthly/monthly.js" type="text/javascript"></script>
    <!-- End Page Lavel Plugins
         =====================================================================-->
    <!-- Start Theme label Script
         =====================================================================-->
    <!-- main js-->
    <script src="assets/dist/js/main.js" type="text/javascript"></script>
    <!-- End Theme label Script
         =====================================================================-->
    
</body>
</html>



<script type="text/javascript">
    $(document).ready(function(){
        //alert("good done");
                $.ajax({
                  url: "get_admin_rate_details.php",
                  type: "post",
                  data: {rate: "yes"},
                  success: function(response){  
                      //alert(response);
                      var res = response.split("#");
                      var len = res.length - 1;
                      var i =0;
                      while(i<len){
                        var tmp = res[i];
                        var rr = tmp.split("*");
                        if(i==0){
                            $('#t_us_val').val(rr[0]);
                            $('#s_us_val').val(rr[1]);
                        }else if(i==1){
                            $('#t_canada_val').val(rr[0]);
                            $('#s_canada_val').val(rr[1]);
                        }else if(i==2){
                            $('#t_alberta_val').val(rr[0]);
                            $('#s_alberta_val').val(rr[1]);
                        }
                        i++;
                      }
                  }
                });



                $('#btn_save').click(function(){
                    var t_us_val = $('#t_us_val').val();
                    var t_canada_val = $('#t_canada_val').val();
                    var t_alberta_val = $('#t_alberta_val').val();
                    var s_us_val = $('#s_us_val').val();
                    var s_canada_val = $('#s_canada_val').val();
                    var s_alberta_val = $('#s_alberta_val').val();
                    
                    if(t_us_val == "" || t_canada_val == "" || t_alberta_val == ""  || s_us_val == "" || s_canada_val == "" || s_alberta_val == ""){
                        $("#prob_disp_w").css("display", "block");
                    }else{
                        $("#prob_disp_w").css("display", "none");

                        $.ajax({
                          url: "save_admin_rate_details.php",
                          type: "post",
                          data: {rate: "yes", t_us_val: t_us_val, t_canada_val: t_canada_val, t_alberta_val: t_alberta_val, s_us_val: s_us_val, s_canada_val: s_canada_val, s_alberta_val: s_alberta_val},
                          success: function(response){  
                              location.reload();
                             // alert(response);
                          }
                        });
                    }
                    

                });

                
    });
</script>