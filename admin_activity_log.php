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
                        <li class="nav-item active" >
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


                        <li class="nav-item">
                            <a class="nav-link" href="admin_homework_assign.php?f_id=a&t_name=a&s_name=a&f_status=a&f_as_date=a&f_due_date=a&f_comp_date=a"><img src="assets/dist/img/Icon/icon3.png" /><span style="color: white;"><b>Homework Assignments</b></span>
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

                        <li class="nav-item">
                            <a><img src="assets/dist/img/Icon/icon8.png" /><span style="color: white;"><b>System</b></span><span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li><a href="admin_system_settings.php">Settings</a></li>
                                <li><a href="admin_default_wages.php">Default Wages</a></li>
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
                        <div class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1 col-sm-12 col-xs-12">
                            <div class="card">
                                <div class="card-header">
                                    
                                    <b><h2>Overview</h2></b>
                                </div>
                                <div class="card-content">
                                    Last Login:
                                    <span style="float: right;">
                                    <?php
                                        include("configs.php");
                                        $query = mysqli_query($db, "SELECT * FROM login WHERE email='".$_SESSION['user_email']."'"); 
                                        while($row = mysqli_fetch_assoc($query)) {
                                            echo "<b>".$row["login_time_rec"]."</b>";
                                        }
                                    ?>
                                    </span>
                                </div>

                                <div class="card-content">
                                    Number of students registered:
                                    <span style="float: right;">
                                    <?php
                                        $count=0;
                                        include("configs.php");
                                        $query = mysqli_query($db, "SELECT * FROM student"); 
                                        while($row = mysqli_fetch_assoc($query)) {
                                            $count++;
                                        }
                                        echo "<b>$count</b>";
                                        $tot_student = $count;
                                    ?>
                                    </span>
                                        
                                </div>

                                <div class="card-content">
                                    Number of tutors registered:
                                    <span style="float: right;">
                                    <?php
                                        $count=0;
                                        include("configs.php");
                                        $query = mysqli_query($db, "SELECT * FROM teacher"); 
                                        while($row = mysqli_fetch_assoc($query)) {
                                            $count++;
                                        }
                                        echo "<b>$count</b>";
                                    ?>
                                    </span>
                                        
                                </div>

                                <div class="card-content">
                                    % of Registered Students who have ACTUALLY received a Class:
                                    <span style="float: right;">
                                    <?php
                                        $count=0;
                                        include("configs.php");
                                        $query = mysqli_query($db, "SELECT COUNT(DISTINCT(student_id)) AS c FROM teacher_assignment WHERE tut_ass_id IN (SELECT tut_ass_id FROM sessions)"); 
                                        $tot=0;
                                        while($row = mysqli_fetch_assoc($query)) {
                                            $tot = $row["c"];
                                        }
                                        if($tot_student!=0){
                                            $act_per = (100*$tot)/$tot_student;
                                        }else{
                                            $act_per = 0;
                                        }
                                        $act_per = round($act_per,2);
                                        echo "<b>".$act_per."%</b>";
                                    ?>
                                    </span>
                                        
                                </div>  

                                <div class="card-content">
                                    Number of students registered this year:
                                    <span style="float: right;">
                                    <?php
                                        $count=0;
                                        $yr = date("Y");
                                        $yr = "%".$yr."%";
                                        include("configs.php");
                                        $query = mysqli_query($db, "SELECT * FROM student WHERE dates like '".$yr."'"); 
                                        while($row = mysqli_fetch_assoc($query)) {
                                            $count++;
                                        }
                                        echo "<b>$count</b>";
                                    ?>
                                    </span>
                                        
                                </div>


                                <div class="card-content">
                                    Number of tutors registered this year:
                                    <span style="float: right;">
                                    <?php
                                        $count=0;
                                        $yr = date("Y");
                                        $yr = "%".$yr."%";
                                        include("configs.php");
                                        $query = mysqli_query($db, "SELECT * FROM teacher WHERE dates like '".$yr."'"); 
                                        while($row = mysqli_fetch_assoc($query)) {
                                            $count++;
                                        }
                                        echo "<b>$count</b>";
                                    ?>
                                    </span>
                                        
                                </div>


                                <div class="card-content">
                                    % of Registered Students who have ACTUALLY received a Class  this Year:
                                    <span style="float: right;">
                                    <?php
                                        $count=0;
                                        $yr = date("Y");
                                        $yr = "%".$yr;
                                        include("configs.php");
                                        $query = mysqli_query($db, "SELECT COUNT(DISTINCT(student_id)) AS c FROM teacher_assignment WHERE tut_ass_id IN (SELECT tut_ass_id FROM sessions WHERE session_date LIKE '$yr') "); 
                                        $tot=0;
                                        while($row = mysqli_fetch_assoc($query)) {
                                            $tot = $row["c"];
                                        }

                                        if($tot_student!=0){
                                            $act_per = (100*$tot)/$tot_student;
                                        }else{
                                            $act_per = 0;
                                        }
                                        $act_per = round($act_per,2);

                                        //$act_per = 100*$tot/$tot_student;
                                        echo "<b>".$act_per."%</b>";
                                    ?>
                                    </span>
                                        
                                </div> 


                            </div>
                        </div>
                    </div>
                        
                        
                    <div class="row">
                        <div class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1 col-sm-12 col-xs-12">
                            <div class="card">
                                <div class="card-header">
                                    
                                    <h4 class="title" style="text-align: center; margin-bottom: 0px;"><b>Notifications<b></h4>
                                </div>
                                <div class="card-content">
                                    <!-- Table content -->
                                    <table class="responsive-table highlight bordered ">
                                        <thead style="background-color: #006699; color: white;">
                                            <tr>
                                            <th style="text-align: center; color: white; color: white;"><b>From</b></th>
                                            <th style="text-align: center; color: white;"><b>Subject</b></th>
                                            <th style="text-align: center; color: white;"><b>Date </b></th>
                                            <th style="text-align: center; color: white;"><b>View</b></th>
                                            <th style="text-align: center; color: white;"><b>Status</b></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                include("configs.php");

                                                $itm_count = "";
                                                $qq = mysqli_query($db, "SELECT item_count FROM admin_website_details");
                                                while($rr = mysqli_fetch_assoc($qq)){
                                                    $itm_count = $rr["item_count"];
                                                }

                                                $qc = mysqli_query($db, "SELECT * FROM notification ORDER BY not_id DESC LIMIT $itm_count");
                                                while($rc = mysqli_fetch_assoc($qc)) {
                                                    $not_id;
                                                    $utype="";
                                                    $name = "";
                                                    $idd;
                                                    $rsp;
                                                    $nc_id = $rc["login_id"];
                                                    $rsp = $rc["response"];
                                                    $not_id = $rc["not_id"];
                                                    $q1 = mysqli_query($db, "SELECT * FROM login WHERE login_id='$nc_id'");
                                                    while($r1 = mysqli_fetch_assoc($q1)) {
                                                        $utype = $r1["user_type"];
                                                    }

                                                    if($utype=="student"){
                                                        $q2 = mysqli_query($db, "SELECT * FROM student WHERE login_id='$nc_id'");
                                                        while($r2 = mysqli_fetch_assoc($q2)) {
                                                            $name = $r2["s_first_name"].' '.$r2["s_last_name"];
                                                            $idd  = $r2["login_id"];
                                                        }
                                                    }else{
                                                        continue;
                                                        $q3 = mysqli_query($db, "SELECT * FROM teacher WHERE login_id='$nc_id'");
                                                        while($r3 = mysqli_fetch_assoc($q3)) {
                                                            $name = $r3["t_first_name"].' '.$r3["t_last_name"];
                                                            $idd  = $r3["login_id"];
                                                        }
                                                    }




                                                    echo '<tr>';
                                                        echo '<td style="text-align: center;">';
                                                            echo $name.' ('.$utype.')';
                                                        echo '</td>';

                                                        echo '<td style="text-align: center;">';
                                                            echo $rc["not_subject"];
                                                        echo '</td>';

                                                        echo '<td style="text-align: center;">';
                                                            echo $rc["not_date"];
                                                        echo '</td>';


                                                        $sub = $rc["not_subject"];
                                                        echo '<td style="text-align: center;">';
                                                            if($utype =="student" ){
                                                                $temp = my_simple_crypt( $idd , 'e' );
                                                                if($sub == "New Registration"){
                                                                    echo '<a href = "admin_stud_info.php?astd_id='.$temp.'" onclick="change_response();">View</a>';
                                                                }

                                                                if($sub == "Start New Tutoring"){
                                                                    echo '<a href = "admin_tutoring_status_info.php?astd_id='.$temp.'" onclick="change_response();">View</a>';
                                                                }else if($sub == "Stop Tutoring"){
                                                                    echo '<a href = "admin_tutoring_status_info.php?astd_id='.$temp.'" onclick="change_response();">View</a>';
                                                                }else if($sub == "Change Tutor Requested"){
                                                                    echo '<a href = "admin_tutoring_status_info.php?astd_id='.$temp.'" onclick="change_response();">View</a>';
                                                                }
                                                                else if($sub == "Tutoring Resumed"){
                                                                    echo '<a href = "admin_tutoring_status_info.php?astd_id='.$temp.'" onclick="change_response();">View</a>';
                                                                }else if(strpos($sub, "Homework")!== false){
                                                                    echo '<a href = "admin_homework_assign.php?f_id=a&t_name=a&s_name=a&f_status=a&f_as_date=a&f_due_date=a&f_comp_date=a">View</a>';
                                                                }else if(strpos($sub, "Flagged")!== false){
                                                                    $tt = explode(": ", $sub);
                                                                    $t1 = explode("]",$tt[1]);
                                                                    $t_id = $t1[0];

                                                                    echo '<a href = "adminv_session_info.php?astd_id='.my_simple_crypt($t_id, 'e').'">View</a>';

                                                                    
                                                                }
                                                                
                                                            }else if($utype =="teacher"){
                                                                $temp = my_simple_crypt( $idd , 'e' );
                                                                if($sub == "New Registration"){
                                                                    echo '<a href = "admin_teacher_info.php?astd_id='.$temp.'" onclick="change_response();">View</a>';
                                                                }else if(strpos($sub, "Homework")!== false){
                                                                    echo '<a href = "admin_homework_assign.php?f_id=a&t_name=a&s_name=a&f_status=a&f_as_date=a&f_due_date=a&f_comp_date=a">View</a>';
                                                                }
                                                            }
                                                            //echo $rc["not_date"];\
                                                        echo '</td>';

                                                        echo '<td style="text-align: center;">';
                                                            if($rsp =='y'){
                                                                echo '<span style = "color: green;"><b> Responded </b></span>';
                                                            }else{
                                                                
                                                                echo '<span style = "color: red;"><b> Waiting </b></span>';
                                                            
                                                            }
                                                            echo '<button style="background-color: #006699; color: white; float: right;" data-id="'.$not_id.'" class = "chng_resp">Change</button> ';
                                                        echo '</td>';
                                                            
                                                        



                                                    echo '</tr>';
                                                }





                                                function my_simple_crypt( $string, $action ) {
                                                    // you may change these values to your own
                                                    $secret_key = 'my_simple_secret_key';
                                                    $secret_iv = 'my_simple_secret_iv';
                                                 
                                                    $output = false;
                                                    $encrypt_method = "AES-256-CBC";
                                                    $key = hash( 'sha256', $secret_key );
                                                    $iv = substr( hash( 'sha256', $secret_iv ), 0, 16 );
                                                 
                                                    if( $action == 'e' ) {
                                                        $output = base64_encode( openssl_encrypt( $string, $encrypt_method, $key, 0, $iv ) );
                                                    }
                                                    else if( $action == 'd' ){
                                                        $output = openssl_decrypt( base64_decode( $string ), $encrypt_method, $key, 0, $iv );
                                                    }
                                                 
                                                    return $output;
                                                }


                                            ?>
                                        </tbody>
                                    </table>
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
        
        $(".chng_resp").click(function(){
            var not_id = $(this).data('id');
                    $.ajax({
                        url: "change_notification_response_status.php",
                        type: "post",
                        data: {change: "yes", not_id: not_id},
                        success: function(response){
                             location.reload();
                        }
                    });
        });
    });
</script>