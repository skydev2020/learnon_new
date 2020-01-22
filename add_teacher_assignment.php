<?php
session_start();
use PHPMailer\Exception;
    if ($_POST["save"] ) {
        include("configs.php");

        

        $tut_input = $_POST['tut_val'];



        $stu_input = $_POST['stu_val'];
        

        $spay_input = trim($_POST['spay_value']);
        $spay_input = strip_tags($spay_input);
        $spay_input = htmlspecialchars($spay_input);


        $tpay_input = trim($_POST['tpay_value']);
        $tpay_input = strip_tags($tpay_input);
        $tpay_input = htmlspecialchars($tpay_input);


        $subject_input = trim($_POST['subject_value']);
        $subject_input = strip_tags($subject_input);
        $subject_input = htmlspecialchars($subject_input);

        $status_input = $_POST['status_value'];


        
        

        $tinp = $tut_input;
        $sinp = $stu_input;



         function find_id($val){
            $l = strlen($val);
            //$val = str_split($val);
            
            $ans="";
            $flag = 0;
            $i=0;
            while ($i<$l) {
                if($flag==1){
                    $ans = $ans.$val[$i];
                }
                if($val[$i] == "("){
                    $flag = 1;
                }

                if($val[$i] == ")"){
                    break;
                }

                $i = $i + 1;
            }
            return substr($ans, 0,-1);
        }


       $tut_input = find_id($tinp);

        $stu_input =  find_id($sinp);




        function bind_to_template($replacements, $template) 
            {
                return preg_replace_callback('/@(.+?)@/', function($matches) use ($replacements) 
                {
                    return $replacements[$matches[1]];
                }, $template);
            }





        $curr_date = date("d/m/Y");


        /*echo $tut_input;
        echo $stu_input;
        echo $subject_input;
        echo $tpay_input;
        echo $spay_input;
        echo $curr_date;
        echo $status_input;*/

        $isTeachstdAlreadyExisit = mysqli_num_rows(mysqli_query($db, "select * from teacher_assignment where teacher_id='$tut_input'   and student_id='$stu_input'  and final_status='Enabled'"));
       
        if ($isTeachstdAlreadyExisit>0) {
            // echo "Teacher or student Assigned already";
             //exit;
        }


        $query = "INSERT INTO teacher_assignment(teacher_id, student_id, subjects, base_wage, base_invoice, assign_date, status_by_tutor, status_by_student, final_status) VALUES('$tut_input','$stu_input','$subject_input','$tpay_input','$spay_input','$curr_date','$status_input','$status_input','$status_input')";
        $res = mysqli_query($db, $query);

        $qq =mysqli_query($db, "SELECT tut_ass_id FROM teacher_assignment ORDER BY tut_ass_id DESC");
        $cur_id;
        while($rr = mysqli_fetch_assoc($qq)){
            $cur_id = $rr["tut_ass_id"];
            break;
        }



        $qq = mysqli_query($db, "SELECT std_id FROM stu_tea_details WHERE student_id = '$stu_input'");
        if(mysqli_num_rows($qq) == 0){
            $qp = mysqli_query($db, "INSERT INTO stu_tea_details(student_id, status, tut_ass_id) VALUES('$stu_input', 'Active', '$cur_id')");
        }else{
                   $curr_date = date("d/m/Y");

            $qp = mysqli_query($db, "UPDATE stu_tea_details SET tut_ass_id = '$cur_id', status = 'Active', change_date = '$curr_date' WHERE student_id = '$stu_input'");
        }


        $ttemp = "Learnon! Administrator";
        $noti_sub = "Tutor Assigned";

        $query1 = "INSERT INTO student_notification(s_from, student_id, teacher_id, s_noti_subject, s_noti_date) VALUES('$ttemp','$stu_input','$tut_input','$noti_sub','$curr_date')";
        $res1 = mysqli_query($db, $query1);



        $ttemp = "Learnon! Administrator";
        $noti_sub = "Student Assigned";

        $query2 = "INSERT INTO teacher_notification(t_from, teacher_id, student_id, t_noti_subject, t_noti_date) VALUES('$ttemp','$tut_input','$stu_input','$noti_sub','$curr_date')";
        $res2 = mysqli_query($db, $query2);


        if($res && $res1 && $res2){

            $qryl = mysqli_query($db, "SELECT * FROM login WHERE login_id= (SELECT login_id FROM student WHERE student_id='$stu_input')"); 
                                    while($ryl = mysqli_fetch_assoc($qryl)) {
                                        $iemail = $ryl["email"];
                                    }

                                    $qry2 = mysqli_query($db, "SELECT * FROM login WHERE login_id= (SELECT login_id FROM teacher WHERE teacher_id='$tut_input')"); 
                                    while($ry2 = mysqli_fetch_assoc($qry2)) {
                                        $temail = $ry2["email"];
                                    }
            
                    $s_mail;
                    $s_pass;
                    $s_host;
                    $s_port;
                    $sq = mysqli_query($db, "SELECT email, email_pass, email_host, email_port FROM admin_general_details");
                    while($rq = mysqli_fetch_assoc($sq)){
                        $s_mail = $rq["email"];
                        $s_pass = $rq["email_pass"];
                        $s_host = $rq["email_host"];
                        $s_port = $rq["email_port"];
                    }

                    $s_pass = my_simple_crypt($s_pass, 'd');


                    // $iemail = 'info@learnon.ca';           // MAIL SEND BEGIN
                    require 'PHPMailer/PHPMailerAutoload.php';
                    require 'PHPMailer/class.phpmailer.php';

                    $mail = new PHPMailer;
                        

                    
                        $mail->isSMTP();                            // Set mailer to use SMTP
                        $mail->Host = $s_host;             // Specify main and backup SMTP servers
                        $mail->SMTPAuth = true;                     // Enable SMTP authentication
                        $mail->Username = $s_mail;          // SMTP username
                        $mail->Password = $s_pass; // SMTP password
                        $mail->SMTPSecure = 'ssl';                  // Enable TLS encryption, `ssl` also accepted
                        $mail->Port = $s_port;                          // TCP port to connect to
                        $mail->SMTPOptions = array(
                        'ssl' => array(
                        'verify_peer' => false,
                        'verify_peer_name' => false,
                        'allow_self_signed' => true
                        )
                        );

                        $mail->setFrom($s_mail);
                        $mail->addReplyTo($s_mail);
                        

                        $mail->addAddress($iemail);   // Add a recipient
                        //$mail->addCC('cc@example.com');
                        //$mail->addBCC('bcc@example.com'); $temail

                        $mail->isHTML(true);  // Set email format to HTML


                       


                        $qry = mysqli_query($db, "SELECT * FROM student WHERE student_id='$stu_input'"); 
                                        while($ry = mysqli_fetch_assoc($qry)) {
                                            $name = $ry["s_first_name"]." ".$ry["s_last_name"];

                           
                                        }
                                         $tid = 11;
                            $query = mysqli_query($db, "SELECT * FROM mail_templates WHERE template_id='".$tid."'"); 
                                      $row = mysqli_fetch_assoc($query);
                                            $bodyContent = $row["template_desc"];
                                            $subject = $row["temp_subject"];
                                   
                                            $rowvalues = array(
                                                        'STUDENT_NAME' => $name,
                                                       
                                                    );
                                                    $get_realtamp = bind_to_template($rowvalues, $bodyContent); 

                                                    $email_body="<html>
                                                        <body>
                                                        $get_realtamp
                                                        </body>
                                                        </html>
                                                            ";

                                                    $bodyContent = utf8_encode(str_replace(chr(194)," ",$email_body));

                        $mail->Subject = $subject;

                         $tp = $bodyContent;
                         $mail->Body = $tp;


                        $c_date = date("Y-m-d");
                        $c_time = date("H:i:s");

                        $qqq = mysqli_query($db, "INSERT INTO mail_log(mail_from, mail_to, subject, message, date_sent, time_sent) VALUES('$s_mail', '$iemail', 'Tutor Assigned', '$tp', '$c_date', '$c_time' )");

                        if($mail->send()){
                            
                             $mail->isSMTP();                            // Set mailer to use SMTP
                        $mail->Host = $s_host;             // Specify main and backup SMTP servers
                        $mail->SMTPAuth = true;                     // Enable SMTP authentication
                        $mail->Username = $s_mail;          // SMTP username
                        $mail->Password = $s_pass; // SMTP password
                        $mail->SMTPSecure = 'ssl';                  // Enable TLS encryption, `ssl` also accepted
                        $mail->Port = $s_port;                          // TCP port to connect to
                        $mail->SMTPOptions = array(
                        'ssl' => array(
                        'verify_peer' => false,
                        'verify_peer_name' => false,
                        'allow_self_signed' => true
                        )
                        );

                        $mail->setFrom($s_mail);
                        $mail->addReplyTo($s_mail);
                        

                        $mail->addAddress($temail);   // Add a recipient
                        //$mail->addCC('cc@example.com');
                        //$mail->addBCC('bcc@example.com'); $temail

                        $mail->isHTML(true);  // Set email format to HTML


                       


                        $qry = mysqli_query($db, "SELECT * FROM  teacher WHERE teacher_id='$tut_input'"); 
                                        while($ry = mysqli_fetch_assoc($qry)) {
                                            $name = $ry["t_first_name"]." ".$ry["t_last_name"];

                           
                                        }
                                         $tid = 9;
                            $query = mysqli_query($db, "SELECT * FROM mail_templates WHERE template_id='".$tid."'"); 
                                      $row = mysqli_fetch_assoc($query);
                                            $bodyContent = $row["template_desc"];
                                            $subject = $row["temp_subject"];
                                   
                                            $rowvalues = array(
                                                        'TUTOR_NAME' => $name,
                                                       
                                                    );
                                                    $get_realtamp = bind_to_template($rowvalues, $bodyContent); 

                                                    $email_body="<html>
                                                        <body>
                                                        $get_realtamp
                                                        </body>
                                                        </html>
                                                            ";

                                                    $bodyContent = utf8_encode(str_replace(chr(194)," ",$email_body));

                        $mail->Subject = $subject;

                         $tp = $bodyContent;
                         $mail->Body = $tp;


                        $c_date = date("Y-m-d");
                        $c_time = date("H:i:s");

                        $qqq = mysqli_query($db, "INSERT INTO mail_log(mail_from, mail_to, subject, message, date_sent, time_sent) VALUES('$s_mail', '$iemail', 'Tutor Assigned', '$tp', '$c_date', '$c_time' )");
                        $mail->send();
                        
                        echo "done";

                        }else{
                            echo 'Message could not be sent.';
                            echo 'Mailer Error: ' . $mail->ErrorInfo;
                        }
                        
                    





                   /* if(!$mail->send()) {
                       //header("Location: dashboard.php");
                        echo "done";
                        
                    } else {
                       //header("Location: admin_teacher_assign.php");
                       // exit();
                        echo "some error occurred";
                    }       // MAIL SEND END*/


        }else{
            //header("Location: dashboard.php");
            //echo mysqli_error();
            echo "problem";
        }


    }else{

         //header("Location: logout.php?logout");
        echo "not authorised";
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

