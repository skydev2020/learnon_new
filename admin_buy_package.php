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

                        
                    ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Control Panel</title>
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
                        
                        <li class="active">
                            <a><img src="assets/dist/img/Icon/users.png" /><span style="color: white;"><b>Students</b></span><span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li><a href="admin_stud.php?f_name=a&f_city=a&f_sub=a&f_date=a">Student list</a></li>
                                <li><a href="admin_stud_assign.php?f_id=a&s_name=a&t_name=a&f_date=a">Student Assignments</a></li>
                                <li><a href="all_packages.php">Student Packages</a></li>
                                <li><a href="admin_buy_package.php"><span style="color: white;">Buy Package</span></applet></a></li>
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

                        <li class="nav-item">
                            <a><img src="assets/dist/img/Icon/icon8.png" /><span style="color: white;"><b>System</b></span><span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li><a href="admin_system_settings.php">Settings</a></li>
                                <li><a href="admin_default_wages.php">Default Wages</a></li>
                                <li><a href="admin_countries.php">Countries</a></li>
                                <li><a href="admin_states.php">Province / States</a></li>
                                <li><a href="admin_grades.php">Grades</a></li>
                                <li><a href="send_notification.php">Backup / Restore</a></li>
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
                        <div class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1 col-sm-12 col-xs-12">
                            <div class="card">
                                <div class="card-header">
                                    <b><h2>Buy Promotion For Student</h2></b>
                                </div>
                                <div class="card-content">

                                    
                                    <div class="row">
                                        <div class="col-md-2 col-lg-2 col-sm-6 col-xs-12">
                                            <b>Student ID</b>
                                        </div>

                                        <div class="col-md-2 col-lg-2 col-sm-6 col-xs-12">
                                            <input type="text" name="id_val" id="id_val" class="form-control" style="text-align: center;">
                                        </div>

                                        <div class="col-md-2 col-lg-2 col-sm-6 col-xs-12">
                                            <button class="form-control btn-warning" id="btn_load">Load Details</button>
                                        </div>
                                    </div> 

                                    <div class="row" id="er_dsp1" style="display: none;">
                                        <div class="col-md-5 col-lg-5 col-sm-12 col-xs-12">
                                            <span style="color: red;">Please Enter Student ID !!</span>
                                        </div>
                                    </div>

                                    <div class="row" id="details_dsp" style="display: none;">
                                        <div class="col-md-2 col-lg-2 col-sm-6 col-xs-12">
                                            <b>Name</b>
                                        </div>

                                        <div class="col-md-4 col-lg-4 col-sm-12 col-xs-12">
                                            <input type="text" name="name_val" id="name_val" class="form-control" style="text-align: center; font-size: 14px;" readonly="">
                                        </div>


                                        <div class="col-md-1 col-lg-1 col-sm-6 col-xs-12">
                                            <b>Email</b>
                                        </div>

                                        <div class="col-md-4 col-lg-4 col-sm-12 col-xs-12">
                                            <input type="text" name="email_val" id="email_val" class="form-control" style="text-align: center; font-size: 14px;" readonly="">
                                        </div>
                                        
                                    </div> 

                                    <div class="row">
                                        <div class="col-md-2 col-lg-2 col-sm-6 col-xs-12">
                                            <b>Select Promotion</b>
                                        </div>

                                        <div class="col-md-9 col-lg-9 col-sm-12 col-xs-12">
                                            <select style="display: block;" class="form-control" id="package_val">
                                            <?php
                                            include("configs.php");
                                                $qq = mysqli_query($db, "SELECT * FROM  learn_promotion_tbl WHERE promotion_status  = 'Enable'");

                                                while($rr = mysqli_fetch_assoc($qq)){
                                                    echo '<option value="'.$rr["promotion_id"].'">'.$rr["promotion_description"].'</option>';
                                                }

                                            ?>  
                                            </select>
                                        </div>
                                    </div>

                                    

                                    
                                    <div class="row">
                                        <div class="col-md-2 col-lg-2 col-md-offset-5 col-lg-offset-5 col-sm-6 col-sm-offset-3 col-xs-12">
                                            <button class="btn btn-info " id="btn_assn">Buy Promotion</button>
                                        </div>
                                    </div>

                                    <div id="as_prob_dsp" style="display: none;" class="row">
                                        <div class="col-md-4 col-lg-4 col-md-offset-5 col-lg-offset-5 col-sm-6 col-sm-offset-3 col-xs-12">
                                            <span style="color: red;"><b>Error Occurred !</b></span>
                                        </div>
                                    </div>

                                    <div id="as_ok_dsp" style="display: none;" class="row">
                                        <div class="col-md-4 col-lg-4 col-md-offset-5 col-lg-offset-5 col-sm-6 col-sm-offset-3 col-xs-12">
                                            <span style="color: green;"><b> Assigned Succesfully</b></span>
                                        </div>
                                    </div>


                                    <br>
                                    <br>


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
        $('#btn_load').click(function(){
            var id = $('#id_val').val();
            if(id==""){
                $("#er_dsp1").css("display", "block");
            }else{
                $("#er_dsp1").css("display", "none");
                    $.ajax({    
                        url: "get_details_by_id.php",
                        type: "post",
                        data: {get_for_package: "yes", id: id},
                        success: function(response){  
                            //alert(response);
                            var res = response.split("*");
                            $('#name_val').val(res[0]);
                            $('#email_val').val(res[1]);
                            //alert(res[0]);
                            $("#details_dsp").css("display", "block");
                        }
                    });
            }
        });

        $('#btn_assn').click(function(){
            var id = $('#id_val').val();
            var pkg_id = $('#package_val').val();
            if(id==""){
                $("#er_dsp1").css("display", "block");
            }else{
                $("#er_dsp1").css("display", "none");
                    $.ajax({    
                        url: "assign_package.php",
                        type: "post",
                        data: {admin: "yes", id: id, pkg_id: pkg_id},
                        success: function(response){  
                            alert(response);
                            if(response == "ok"){
                                $("#as_prob_dsp").css("display", "none");
                                $("#as_ok_dsp").css("display", "block");
                            }else{
                                $("#as_prob_dsp").css("display", "block ");
                            }
                        }
                    });
            }
        });




    });
</script>