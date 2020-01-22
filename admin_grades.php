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




    <div class="modal fade" id="myModal1" role="dialog">
        <div class="modal-dialog">
        
          <!-- Modal content-->
          <div class="content" style="margin: 0px;">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <div style="text-align: center;"><h2 class="modal-title">Add / Update Grades</h2></div>
            </div>
            <div class="modal-body">
                <div >
                   
                        <input type="text" name="as_id" id="as_id" style="display: none; " value="0">
                        <div class="row">
                            <div class="form-group col-md-8 col-lg-8 col-sm-12 col-xs-12">
                                <b>Grade name</b>
                                <input type="text" name="grade_val" id="grade_val" maxlength="30" class="form-control">
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-12 col-lg-12 col-sm-12 col-xs-12">
                                <b>Subjects</b>
                                <textarea id="subject_val" name="subject_val" class="form-control" rows="5"></textarea>
                            </div>
                        </div>
                        

                                  
                        

                        <br>
                        <div class="row" style="display: none;" id="prob_dsp">
                            <div class="form-group col-md-6 col-md-offset-3 col-sm-12 col-xs-12">
                                <span style="color: red; " ><b>Grade name can not be Empty !!</b></span>
                            </div>
                        </div> 

                        <div style="text-align: center;"><button type="submit" class="btn-login btn btn-info" name="btn_save" id="btn_save">SAVE</button></div>     
                    
                </div>
            </div>
            
          </div>
          
        </div>
    </div>





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
                                <li ><a href="admin_default_wages.php">Default Wages</a></li>
                                <li ><a href="admin_countries.php">Countries</a></li>
                                <li><a href="dataTables.html">Province / States</a></li>
                                <li ><a href="admin_grades.php"><span style="color: white;">Grades</span></a></li>
                                
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
                                    
                                    <b><h2>Grades</h2></b>
                                </div>
                                <div class="card-content">
                                    
                                    <div class="row">
                                        
                                        <div class="col-lg-12  col-md-12 col-sm-12 col-xs-12">
                                            <table class="responsive-table highlight bordered table2excel" id="mytable">
                                                <thead style="background-color: #006699; color: white;">
                                                    <tr>
                                                        <th style="text-align: center; color: white;"><b>ID</b></th>
                                                        <th style="text-align: center; color: white;"><b>Grade Name</b></th>
                                                        <th style="text-align: center; color: white;"><b>Subjects</b></th>
                                                        
                                                        <th style="text-align: center; color: white;"><b>Action</b></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                        include("configs.php");

                                                        $qc = mysqli_query($db, "SELECT * FROM grade");


                                                        
                                                        
                                                        while($rc = mysqli_fetch_assoc($qc)) {
                                                            echo '<tr>';
                                                                echo '<td style="text-align: center;">';
                                                                    echo $rc["grade_id"];
                                                                echo '</td>';



                                                                echo '<td style="text-align: center;">';
                                                                    echo $rc["grade_name"];
                                                                echo '</td>';

                                                                echo '<td style="text-align: center;">';
                                                                    echo "<textarea rows=5 class= 'form-control' readonly>".$rc["subjects"]."</textarea>";
                                                                echo '</td>';
                                                                
                                                                

                                                                
                                                                echo '<td style="text-align: center;">';
                                                                    $tt = my_simple_crypt($rc["grade_id"],'e');
                                                                echo '<a data-toggle="modal" data-target="#myModal1" href="#myModal1"  data-id="'.$rc["grade_id"].'" </b>EDIT</a> / '.'<a href="delete_grade.php?astd_id='.$tt.'">DELETE</a>';
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

                                    

                                    
                                    

                                    


                                    

                                    <div class="row" id="prob_disp_w" style="display: none;">
                                        <div class="col-lg-6 col-md-6 col-md-offset-3 col-lg-offset-3 col-sm-12 col-xs-12 ">
                                            <span style="color: red">* Marked Fields are Mandatory !!</span>
                                        </div>
                                        
                                    </div>

                                    

                                    <div class="row">
                                        <div class="col-lg-1 col-md-1 col-sm-4 col-xs-4 col-sm-offset-4 col-xs-offset-4 col-md-offset-10 col-lg-offset-10">
                                            <button class="btn  btn-info " data-toggle="modal" data-target="#myModal1"  id="add_but"><b>Add Grade</b></button>
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
            $('#add_but').click(function(){
                $('#as_id').val("0");
                $('#grade_val').val("");
                $('#subject_val').val("");
                $("#prob_dsp").css("display", "none");
            });   



            $('a[href="#myModal1"]').click(function(){
                //alert($(this).data('id'));
                var t_id_tmp = $(this).data('id');
               
                $('#as_id').val(t_id_tmp);
                $.ajax({
                  url: "grade_details.php",
                  type: "post",
                  data: {get: "yes", id: t_id_tmp},
                  success: function(response){  
                       
                      $res = response.split("*101*");
                      $('#grade_val').val($res[0]);
                      $('#subject_val').val($res[1]);
                      //alert(response);
                  }
                });
            });


            $('#btn_save').click(function(){
                //alert("clicked");
                var chk_val = $('#as_id').val();
                var grade_val = $('#grade_val').val();
                var subject_val = $('#subject_val').val();
                if(grade_val == ""){
                    $("#prob_dsp").css("display", "block");
                }else{
                    
                        $.ajax({    
                          url: "grade_details.php",
                          type: "post",
                          data: {save: "yes", grade_val: grade_val, subject_val: subject_val, id: chk_val},
                          success: function(response){  
                              //alert(response);
                              /*if(response == "don"){
                                alert("Information Updated Successfully !!");
                              }else{
                                //alert("Some error occurred !! :(");
                                alert(response);
                              }*/
                              location.reload();
                            }
                        });
                    

                }
                
                
            });

 
    });
</script>