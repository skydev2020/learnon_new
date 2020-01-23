<?php 
    session_start();
    include("configs.php");
    $l_id=$_SESSION['id'];
    $login_session=$_SESSION['user_email'];
    $login_type = $_SESSION['type'];
    if($login_session==""){
        header("Location: logout.php");
    }else{
        if($login_type!="teacher"){
            header("Location: logout.php"); 
        }
    }


    $tid;
    $qq = mysqli_query($db, "SELECT teacher_id FROM teacher WHERE login_id = '$l_id'");
    while($rr = mysqli_fetch_assoc($qq)){
        $tid = $rr["teacher_id"];
    }

    if(isset($_GET['f_id'])){
        $filter_id =  $_GET['f_id'];
    }

    
    if(isset($_GET['s_name'])){
        $filter_s_name =  $_GET['s_name'];
    }
    if(isset($_GET['f_duration'])){
        $filter_f_duration = $_GET['f_duration'];
    }

    if(isset($_GET['f_ses_date'])){
        $filter_ses_date = $_GET['f_ses_date'];
    }
    

    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>My Sessions</title>
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
          <div class="content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <div style="text-align: center;"><h4 class="modal-title">Log Hours</h4></div>
            </div>
            <div class="modal-body">
                <div >
                   
                        
                        <div class="row">
                            <div class="form-group col-md-4 col-lg-4 col-sm-12 col-xs-12">
                                <span style="color: red;">*</span><b>Select Student </b>
                            </div>

                            <div class="form-group col-md-8 col-lg-8 col-sm-12 col-xs-12">
                                <select  id="student_val" name="student_val" style="display: block;" class="form-control">
                                <option>Select</option>
                                    <?php
                                    
                                        $query = mysqli_query($db, "SELECT tut_ass_id, student_id FROM teacher_assignment WHERE teacher_id = '$tid' AND final_status ='Enabled'"); 
                                        while($row = mysqli_fetch_assoc($query)) {
                                            $tmp_as_id = $row["tut_ass_id"];
                                            $tmp_stu_id = $row["student_id"];

                                            $q1 = mysqli_query($db, "SELECT s_first_name, s_last_name FROM student WHERE student_id = '$tmp_stu_id'");
                                            while($r1 = mysqli_fetch_assoc($q1)){
                                                ?>
                                                    <option><?php echo $r1["s_first_name"]." ".$r1["s_last_name"]." (".$tmp_as_id.")";?></option>
                                                <?php
                                            }
                                            

                                        }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-4 col-lg-4 col-sm-12 col-xs-12">
                                <span style="color: red;"><b>*</b></span> <b>Date of Session</b>
                                
                            </div>

                            <div class="form-group col-md-6 col-lg-6 col-sm-12 col-xs-12">
                                <input type="Date" name="session_date_val" id="session_date_val" class="form-control">
                            </div>

                            
                        </div>


                        <div class="row">
                            
                            <div class="form-group col-md-4 col-lg-4 col-sm-12 col-xs-12">
                                <span style="color: red;"><b>*</b></span> <b>Duration of Session :</b> 
                            </div>

                            <div class="form-group col-md-1 col-lg-1 col-sm-4 col-xs-4">
                                <input style="width: 50px" type="text" id="hour_val" name="hour_val" maxlength="2" value="0" class="form-control">
                            </div>

                            <div class="form-group col-md-1 col-lg-1 col-sm-4 col-xs-4">
                                Hour(s)
                            </div>

                            <div class="form-group col-md-3 col-md-offset-1 col-lg-3 col-lpg-offset-1 col-sm-4 col-xs-4">
                                <select id="minute_val" name="minute_val" class="form-control" style="display: block;">
                                     <option value="00">00</option>
                                    <option value="15">15</option>
                                    <option value="30">30</option>
                                    <option value="45">45</option>
                                </select>
                            </div>

                            <div class="form-group col-md-1 col-lg-1 col-sm-4 col-xs-4">
                                Minute(s)
                            </div>

  
                            
                        </div>
                        


                        <div class="row">
                            <div class="form-group col-md-4 col-lg-4 col-sm-12 col-xs-12">
                                <b>Notes about Session or Student progress :</b>
                            </div>

                            <div class="form-group col-md-8 col-lg-8 col-sm-12 col-xs-12">
                                <textarea class="form-control "  name = "notes_val" id="notes_val"></textarea>
                            </div>
                        </div>


                        <div class="row" id="prob_dsp" style="display: none;">
                            <div class="col-md-6 col-lg-6 col-md-offset-4 col-lg-offset-4 col-sm-12 col-xs-12">
                                <span style="color: red;"><b>* Marked Field are mandatory</b></span>
                            </div>
                        </div>

                        <div class="row" id="fail_dsp" style="display: none;">
                            <div class="col-md-6 col-lg-6 col-md-offset-4 col-lg-offset-4 col-sm-12 col-xs-12">
                                <span style="color: red;"><b>Hours logging failed. Please try after some time</b></span>
                            </div>
                        </div>
                        


                                  
                        <div style="text-align: center;"><button  class="btn-login btn btn-default" name="add_session" id="add_session">SAVE</button></div>  
                        <br>
                        <div class="row" >
                            <div class="col-md-4">
                                <span id="wait" style="display: none;">Please Wait.....</span>
                            </div>
                        </div>    
                    
                </div>
            </div>
            
          </div>
          
        </div>
  </div>








    <div id="wrapper">
        <!--navbar top-->
        <nav class="navbar navbar-inverse navbar-fixed-top">
            <!-- Logo -->
            <a class="navbar-brand pull-left" href="teacher_home">
                <img src="assets/dist/img/logo3.png" alt="logo" width="205" height="60">
            </a>

            <a href="logout.php" class="pull-right" style="margin-right: 20px;">Log Out</a>
            
            
            
        </nav>
        <!-- Sidebar -->
        <div id="sidebar-wrapper" class="waves-effect" data-simplebar>
            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <?php include('inc/teachermenu.php');?> <!-- Sidebarul<ul class="nav" id="side-menu">
                        <li class="nav-item ">
                            <a class="nav-link " href="teacher_home.php">
                                <img src="assets/dist/img/Icon/home.png" /><span style="color: white;"><b>Home</b></span>
                            </a>
                        </li>
                        
                        <li>
                            <a class="nav-link " href="teacher_info.php">
                                <img src="assets/dist/img/Icon/user.png" /><span style="color: white;"><b>My Profile</b></span>
                            </a>
                        </li>

                        <li>
                            <a class="nav-link " href="teacher_contract_view.php">
                                <img src="assets/dist/img/Icon/icon2.png" /><span style="color: white;"><b>My Contract</b></span>
                            </a>
                        </li>


                        <li class="nav-item">
                            <a class="nav-link" href="">
                                <img src="assets/dist/img/Icon/payment.png" /><span style="color: white;"><b>Payment Records</b></span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="teacher_student_assign_list.php?f_id=a&f_name=a&f_status=a&f_date=a">
                            <img src="assets/dist/img/Icon/users.png" /><span style="color: white;"><b>Student List</b></span>
                        </li>


                        <li class="active" >
                            <a class="nav-link" href="teacher_sessions.php?f_id=a&s_name=a&f_duration=a&f_ses_date=a">
                            <img src="assets/dist/img/Icon/icon5.png" /><span style="color: white;"><b>My Sessions</b></span>
                        </li>
                        

                        

                        <li class="nav-item">
                            <a class="nav-link" href="teacher_manage_homework.php"><img src="assets/dist/img/Icon/icon6.png" /><span style="color: white;"><b>Homework Assignments</b></a>
                        </li>

                        <li class="nav-item">
                            <a target="_blank" class="nav-link" href="http://learnon.ca/tutor-help-center/"><img src="assets/dist/img/Icon/icon8.png" /><span style="color: white;"><b>Tutoring Resources</b></a>
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
                                   <?php
                                        
                                        $idss = $_SESSION['id'];
                                        $query = mysqli_query($db, "SELECT * FROM teacher WHERE login_id='".$idss."'"); 
                                        while($row = mysqli_fetch_assoc($query)) {
                                            echo "Hi ".$row["t_first_name"].", You are logged in as TUTOR";
                                            //$tid = $row["teacher_id"];
                                        }
                                    ?>
                            </p>  
                        </div>
                           
                    </div>
                </section>
                <!-- page section -->
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12 pull-right">
                            <b>Last Login:</b>
                                    <span style="float: right;">
                                    <?php
                                        include("configs.php");
                                        $query = mysqli_query($db, "SELECT * FROM login WHERE email='".$_SESSION['user_email']."'"); 
                                        while($row = mysqli_fetch_assoc($query)) {
                                            echo "<b>".$row["login_time_rec"]."</b>";
                                        }
                                    ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12  col-md-12  col-sm-12 col-xs-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3>My Sessions</h3> 
                                </div>
                                <div class="card-content">


                                    <div class="row">

                                        <div class="col-xs-12 col-sm-12 col-md-1 col-lg-1">
                                            ID
                                            <input type="text" name="s_id" id="s_id">
                                        </div>

                                        
                                        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                                            Student Name
                                            <input type="text" name="s_name" id="s_name"  >
                                        </div>

                                        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                                            Duration
                                            <select id="s_duration" style="display: block;" class="form-control">
                                                <option ></option>
                                                <option value="0.5">30 Minutes</option>
                                                <option value="0.75">45 Minutes</option>
                                                <option value="1">1 Hour</option>
                                                <option value="1.25">1 Hour 15 Minutes</option>
                                                <option value="1.5">1 Hour 30 Minutes</option>
                                                <option value="1.75">1 Hour 45 Minutes</option>
                                                <option value="2">2 Hour</option>
                                                <option value="2.25">2 Hours 15 Minutes</option>
                                                <option value="2.5">2 Hours 30 Minutes</option>
                                                <option value="2.75">2 Hours 45 Minutes</option>
                                                <option value="3">3 Hour</option>
                                                <option value="3.25">3 Hours 15 Minutes</option>
                                                <option value="3.5">3 Hours 30 Minutes</option>
                                                <option value="3.75">3 Hours 45 Minutes</option>
                                                <option value="4">4 Hour</option>
                                                <option value="4.25">4 Hours 15 Minutes</option>
                                                <option value="4.5">4 Hours 30 Minutes</option>
                                                <option value="4.75">4 Hours 45 Minutes</option>
                                                <option value="5">5 Hour</option>
                                                <option value="6">More than 5 Hours</option>

                                                
                                            </select>
                                        </div>

                                        

                                        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                                            Date of Session
                                            <input type="date" name="s_date" id="s_date">
                                        </div>
                                    </div>

                                    <div class="row">
                                        

                                        <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2 col-md-offset-2 col-lg-offset-2 pull-right">
                                            <button style="margin-top: 20px;" id="btn_search" class="btn btn-info">Search</button>
                                        </div>
                                    </div>
                                    <br>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <button style="background-color: #006699; color: white;" class="btn btn-default navbar-btn pull-left" data-toggle="modal" data-target="#myModal1" style="margin: 2px;" id="log_hour" ><b>Log Hours</b></button>
                                        </div>
                                    </div>
                                    <!-- Table content -->
                                    <div class="row">
                                        <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
                                            <table class="responsive-table highlight bordered ">
                                                <thead style="background-color: #006699; color: white;">
                                                    <tr>
                                                        <th style="text-align: center; color: white;"><b>Student Name</b></th>
                                                        <th style="text-align: center; color: white;"><b>Session Date</b></th>
                                                        <th style="text-align: center; color: white;"><b>Session Duration</b></th>
                                                        <th style="text-align: center; color: white;"><b>Session Notes</b></th>
                                                        <th style="text-align: center; color: white;"><b>Status</b></th>
                                                        <th style="text-align: center; color: white;"><b>Action</b></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                        include("configs.php");
                                                             
                                                        if($filter_id != "a"){
                                                            $qc = mysqli_query($db, "SELECT * FROM sessions WHERE session_id = '$filter_id'");
                                                        }

                                                        if($filter_s_name != "a"){
                                                            $qc = mysqli_query($db, "SELECT * FROM sessions WHERE tut_ass_id IN (SELECT tut_ass_id FROM teacher_assignment WHERE teacher_id = '$tid' AND student_id IN(SELECT student_id FROM student WHERE concat(s_first_name, ' ', s_last_name) LIKE '%$filter_s_name%')) ORDER BY session_id DESC");
                                                            
                                                        }


                                                        if($filter_f_duration != "a"){
                                                            $qc = mysqli_query($db, "SELECT * FROM sessions WHERE tut_ass_id IN (SELECT tut_ass_id FROM teacher_assignment WHERE teacher_id = '$tid') AND session_duration = '$filter_f_duration' ORDER BY session_id DESC");
                                                            
                                                        }

                                                        if($filter_ses_date != "a"){
                                                            $tmp = explode("-", $filter_ses_date);
                                                            $tt = $tmp[2]."/".$tmp[1]."/".$tmp[0];

                                                            $qc = mysqli_query($db, "SELECT * FROM sessions WHERE tut_ass_id IN (SELECT tut_ass_id FROM teacher_assignment WHERE teacher_id = '$tid') AND session_date = '$tt' ORDER BY session_id DESC");
                                                            
                                                        }

                                                        if($filter_id == "a" && $filter_s_name == "a" && $filter_f_duration == "a" && $filter_ses_date == "a"){
                                                            $qc = mysqli_query($db, "SELECT * FROM sessions WHERE tut_ass_id IN (SELECT tut_ass_id FROM teacher_assignment WHERE teacher_id = '$tid') ORDER BY session_id DESC");
                                                            
                                                        }
                                                        while($rc = mysqli_fetch_assoc($qc)) {
                                                            echo '<tr>';

                                                            $tpv = $rc["tut_ass_id"];
                                                            $tmpq = mysqli_query($db, "SELECT s_first_name, s_last_name FROM student WHERE student_id = (SELECT student_id FROM teacher_assignment WHERE tut_ass_id ='$tpv')");



                                                            while ($tmpr = mysqli_fetch_assoc($tmpq)) {
                                                                
                                                                    echo '<td style="text-align: center;">';
                                                                        echo $tmpr["s_first_name"]." ".$tmpr["s_last_name"];
                                                                    echo '</td>';
                                                            }
                                                                

                                                                echo '<td style="text-align: center;">';
                                                                    echo $rc["session_date"];
                                                                echo '</td>';

                                                                echo '<td style="text-align: center;">';
                                                                    echo $rc["session_duration"];
                                                                echo '</td>';

                                                                echo '<td style="text-align: center;">';
                                                                    echo $rc["session_tut_notes"];
                                                                echo '</td>';
                
                                                                $tmp_status = $rc["session_flag"];
                                                                if($tmp_status=="n/a" || $tmp_status==""){
                                                                            echo '<td style="text-align: center;">';
                                                                                echo 'PENDING';
                                                                            echo '</td>';
                                                                }else if($tmp_status=="FLAGGED"){
                                                                    echo '<td style="text-align: center;">';
                                                                                echo '<span style = "color: red;">'.$tmp_status.'</span>';
                                                                            echo '</td>';
                                                                }else if($tmp_status =="SOLVED"){
                                                                        echo '<td style="text-align: center;">';
                                                                                echo '<span style = "color: green;">'.$tmp_status.'</span>';
                                                                            echo '</td>';
                                                                }else{
                                                                        echo '<td style="text-align: center;">';
                                                                                echo 'PENDING';
                                                                            echo '</td>';
                                                                }
                                                                
                                                                echo '<td style="text-align: center;">';
                                                                    $temp = my_simple_crypt( $rc["session_id"] , 'e' );
                                                                    echo '<a href = "teacherv_session_info.php?astd_id='.$temp.'">View</a>';
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
        $('#add_session').click(function(){
            var err="";
            var st_name =  $('#student_val').val();
            if(st_name=="Select"){
                err = err.concat("\n Please select a Student");
            }
            var s_date = $('#session_date_val').val();
            if(s_date==""){
                err = err.concat("\n Please select a Date");
            }

            var hour = $('#hour_val').val();
            var min = $('#minute_val').val();
            var notes = $('#notes_val').val();
            if(err!=""){
                alert("Resolve the following errors !!".concat(err));
                $("#prob_dsp").css("display", "block");
                return false;
            }else{
                document.getElementById('wait').style.display = 'block';
                 
                    $.ajax({
                        url: "save_session_details.php",
                        type: "post",
                        data: {st_name: st_name, s_date: s_date, hour: hour, min: min, notes: notes, add: "yes"},
                        success: function(response){
                            console.log(response);
                            $("#wait").css("display", "none");
                             window.location.href = "teacher_sessions.php?f_id=a&s_name=a&f_duration=a&f_ses_date=a";
                             // if(response=="true"){
                             //    window.location.href = "teacher_sessions.php?f_id=a&s_name=a&f_duration=a&f_ses_date=a";
                             // }else{
                             //    //alert(response);
                             //    $("#wait").css("display", "none");
                             //    $("#fail_dsp").css("display", "block");
                             // }
                        }
                    });
            }
            
        });


        $('#btn_search').click(function(){
            var s_name = $('#s_name').val();
            var s_id = $('#s_id').val();
            var s_duration = $('#s_duration').val();
            var sub = $('#s_submit_date').val();
            var dt = $('#s_date').val();
            
            if(s_name==""){
                s_name="a";
            }
            if(s_id==""){
                s_id="a";
            }
            if(s_duration==""){
                s_duration="a";
            }
            
            if(dt==""){
                dt="a";
            }

            window.location = "teacher_sessions.php?f_id="+s_id+"&s_name="+s_name+"&f_duration="+s_duration+"&f_ses_date="+dt;

        });



    });
</script>