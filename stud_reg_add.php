<?php
    ob_start();
    session_start();
    use PHPMailer\Exception;
    include("configs.php");
    $error = false;
    $w_mail = 0;

    if(isset($_POST['btn-signup'])){
        include("configs.php");

        $email_input = trim($_POST['email_val']);
        $email_input = strip_tags($email_input);
        $email_input = htmlspecialchars($email_input);

        //basic email validation
        if ( !filter_var($email_input,FILTER_VALIDATE_EMAIL) ) {
            $error = true;
            $emailError = "Please enter valid email address.";
        } else {
        // check email exist or not
            $query = "SELECT email FROM login WHERE email='$email_input'";
            $result = mysqli_query($db, $query);
            $count = mysqli_num_rows($result);
            if($count!=0){
                $error = true;
                $emailError = "Provided Email is already in use.";
            }
        }


        $opsw_input = trim($_POST['opsw_val']);
        $opsw_input = strip_tags($opsw_input);
        $opsw_input = htmlspecialchars($opsw_input);


        $cpsw_input = trim($_POST['cpsw_val']);
        $cpsw_input = strip_tags($cpsw_input);
        $cpsw_input = htmlspecialchars($cpsw_input);


        $opsw_input = md5($opsw_input);


        $fname_input = trim($_POST['fname_val']);
        $fname_input = strip_tags($fname_input);
        $fname_input = htmlspecialchars($fname_input);

        $lname_input = trim($_POST['lname_val']);
        $lname_input = strip_tags($lname_input);
        $lname_input = htmlspecialchars($lname_input);


        $grade_input = $_POST['grade_val'];

        $qg = mysqli_query($db, "SELECT * FROM grade WHERE grade_name = '$grade_input'");
        while($rg = mysqli_fetch_assoc($qg)) {
                    $grade_id_input = $rg["grade_id"];
        } 
 
        /*$sub_input="";
        $sb = $_POST['cb'];
        foreach ($sb as $x) {
            $sub_input = $sub_input.$x.",";
        }*/


        $sub_input =  $_POST['course_val'];


        $pfname_input = trim($_POST['pfname_val']);
        $pfname_input = strip_tags($pfname_input);
        $pfname_input = htmlspecialchars($pfname_input);

        $plname_input = trim($_POST['plname_val']);
        $plname_input = strip_tags($plname_input);
        $plname_input = htmlspecialchars($plname_input);


        $phone_input = $_POST['phone_val'];
        $pphone_input = $_POST['pphone_val'];


        $add_input = trim($_POST['add_val']);
        $add_input = strip_tags($add_input);
        $add_input = htmlspecialchars($add_input);



        $city_input = trim($_POST['city_val']);
        $city_input = strip_tags($city_input);
        $city_input = htmlspecialchars($city_input);



        $province_input = $_POST['province_val'];

        $qp = mysqli_query($db, "SELECT * FROM province WHERE province_name = '$province_input'");
        while($rp = mysqli_fetch_assoc($qp)) {
                    $province_id_input = $rp["province_id"];
        } 


        $postal_input = $_POST['postal_val'];


        $country_input = $_POST['country_val'];
        $qc = mysqli_query($db, "SELECT * FROM country WHERE country_name = '$country_input'");
        while($rc = mysqli_fetch_assoc($qc)) {
                    $country_id_input = $rc["country_id"];
        }



        $notes_input = trim($_POST['notes_val']);
        $notes_input = strip_tags($notes_input);
        $notes_input = htmlspecialchars($notes_input);


        $street_intersection_input = trim($_POST['street_intersection_val']);
        $street_intersection_input = strip_tags($street_intersection_input);
        $street_intersection_input = htmlspecialchars($street_intersection_input);



        $school_input = trim($_POST['school_val']);
        $school_input = strip_tags($school_input);
        $school_input = htmlspecialchars($school_input);




        $how_input = $_POST['how_val'];
        $qh = mysqli_query($db, "SELECT * FROM how_res WHERE how_source = '$how_input'");
        while($rh = mysqli_fetch_assoc($qh)) {
                    $how_id_input = $rh["how_id"];
        }


        $other_how_input = trim($_POST['other_how_val']);
        $other_how_input = strip_tags($other_how_input);
        $other_how_input = htmlspecialchars($other_how_input);





        if(true){
            //echo "<script type='text/javascript'>alert('ok!')</script>";
            $l=1;
            $type = "student";
            $lt1="N/A";
            $lt2 = "FIRST LOGIN";

            $query = "INSERT INTO login(email, password,w_mail,user_type,login_time,login_time_rec, port_status) VALUES('$email_input','$opsw_input','$l','$type','$lt1','$lt2', '1')";
            $res = mysqli_query($db, $query);
            if(!$res){
                echo "<script type='text/javascript'>alert('ERROR1 OCURRED!')</script>";
            }
            $curr_date = date("d/m/Y");

           
            $log_id="";

            $queryl = mysqli_query($db, "SELECT * FROM login WHERE email='".$email_input."'"); 
                                while($row = mysqli_fetch_assoc($queryl)) {
                                    $log_id = $row["login_id"];
                                }

                                
/*
                    echo $log_id."\r\n";
             echo $fname_input."\r\n";
            echo $lname_input."\r\n";
            echo $grade_id_input."\r\n";
            echo $sub_input."\r\n";
            echo $pfname_input."\r\n";
            echo $plname_input."\r\n";
            echo $phone_input."\r\n";
            echo $pphone_input."\r\n";
            echo $add_input."\r\n";
            echo $city_input."\r\n";
            echo $province_id_input."\r\n";
            echo $postal_input."\r\n";
            echo $country_id_input."\r\n";
            echo $notes_input."\r\n";
            echo $street_intersection_input."\r\n";
            echo $school_input."\r\n";
            echo $how_id_input."\r\n";*/



            $ip = $_SERVER['HTTP_CLIENT_IP']?$_SERVER['HTTP_CLIENT_IP']:($_SERVER['HTTP_X_FORWARDE‌​D_FOR']?$_SERVER['HTTP_X_FORWARDED_FOR']:$_SERVER['REMOTE_ADDR']);

            $query1 = "INSERT INTO student(login_id,dates,s_first_name,s_last_name,grade_id,subjects,p_first_name,p_last_name,telephone_main,telephone_opt,address,city,province_id,postal_code,country_id,notes,m_s_intersection,school_name,how_id,s_ip) VALUES('$log_id','$curr_date','$fname_input','$lname_input','$grade_input','$sub_input','$pfname_input','$plname_input','$phone_input','$pphone_input','$add_input','$city_input','$province_input','$postal_input','$country_input','$notes_input','$street_intersection_input','$school_input','$how_input','$ip')";
            $res1 = mysqli_query($db, $query1);

            $not_sub = "New Registration";
            $noti_query = "INSERT INTO notification(login_id,not_subject,not_date) VALUES('$log_id','$not_sub','$curr_date')";
            $res2 = mysqli_query($db, $noti_query);


             if(!$res1){
                echo "<script type='text/javascript'>alert('ERROR2 OCURRED!')</script>";
            }
            if ($res && $res1) {
               // echo "<script type='text/javascript'>alert('Registration complete. please login!')</script>";

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
		
                $iemail = $s_mail;
                    require 'PHPMailer/PHPMailerAutoload.php';
                    require 'PHPMailer/class.phpmailer.php';

                    $mail = new PHPMailer;
                        //$mail->IsMAIL();
                    $mail->isSMTP();                            // Set mailer to use SMTP
                    $mail->Host = $s_host;            // Specify main and backup SMTP servers
                    $mail->SMTPAuth = true;                     // Enable SMTP authentication
                    $mail->Username = $s_mail;          // SMTP username
                    $mail->Password = $s_pass; // SMTP password
                    $mail->SMTPSecure = 'ssl';                  // Enable TLS encryption, `ssl` also accepted
                    $mail->Port = $s_port;                           // TCP port to connect to
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
                    //$mail->addBCC('bcc@example.com');

                    $mail->isHTML(true);  // Set email format to HTML

                    
                        $bodyContent = 'A new Student has registered at learnOn portal';
                    

                    $mail->Subject = 'New Student Registration';
                    $mail->Body    = $bodyContent;



                    $c_date = date("Y-m-d");
                    $c_time = date("H:i:s");

               
                    if(!$mail->send()) {
                        /*echo 'Message could not be sent.';
                        echo 'Mailer Error: ' . $mail->ErrorInfo;*/
                        //echo $s_host."  ".$s_mail."  ".$s_pass;
                        
                    } else {
                         $qqq = mysqli_query($db, "INSERT INTO mail_log(mail_from, mail_to, subject, message, date_sent, time_sent) VALUES('$s_mail', '$iemail', 'New Student Registration', '$bodyContent', '$c_date', '$c_time' )");
                        
                         function bind_to_template($replacements, $template) 
                            {
                                return preg_replace_callback('/@(.+?)@/', function($matches) use ($replacements) 
                                {
                                    return $replacements[$matches[1]];
                                }, $template);
                            }

                              $sq2 = mysqli_query($db, "SELECT * FROM  mail_templates where template_id='10'");
                                                  $rq2 = mysqli_fetch_assoc($sq2);



                           $mail->ClearAllRecipients( );
                            $mail->addAddress($email_input);
                                $name=$fname_input." ".$lname_input;
                             $rowvalues = array(
                                                        'STUDENT_NAME' => $name,
                                                       
                                                       
                                                    );
                                                    $get_realtamp = bind_to_template($rowvalues, $rq2["template_desc"]); 

                                                    $email_body="<html>
                                                        <body>
                                                        $get_realtamp
                                                        </body>
                                                        </html>
                                                            ";

                                                    $bodyContent = utf8_encode(str_replace(chr(194)," ",$email_body));




                            $bodyContent = $bodyContent;
                    

                            $mail->Subject = $rq2["temp_subject"];;
                            $mail->Body    = $bodyContent;  

                            if($mail->send()) {
                                
                                $qqq = mysqli_query($db, "INSERT INTO mail_log(mail_from, mail_to, subject, message, date_sent, time_sent) VALUES('$s_mail', '$email_input', 'Thank You for Registering', '$bodyContent', '$c_date', '$c_time' )");
                            }
                    }

                    header("Location: thank_student.php");
                        exit();





                
            }
        }





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