<?php
use PHPMailer\Exception;
session_start();
    if ($_POST["save"] ) {
        include("configs.php");

        

        $tut_input = $_POST['tut_val'];



        $stu_input = $_POST['stu_val'];

        $stu_val_2 = $_POST['stu_val_2'];
        $stu_email_val = $_POST['stu_email_val'];
        $as_price_paid = $_POST['as_price_paid'];
        $as_tutor_price = $_POST['as_tutor_price'];
        $as_topic = $_POST['as_topic'];
        $as_description = $_POST['as_description'];
        $date_assigned = $_POST['date_assigned'];
        $date_completed = $_POST['date_completed'];
        $date_due = $_POST['date_due'];
        $as_file_format = $_POST['as_file_format'];
        $status_value = $_POST['status_value'];
        $assn_num_val = $_POST['assn_num_val'];

        $assn_num_val = substr($assn_num_val, 1);
        

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
        if($stu_val_2 != ''){
            $stu_input = 0;

        }else{
           $stu_input =  find_id($sinp); 
           $stu_val_2 = "";
        }

        

        



        $curr_date = date("d/m/Y");
        if($date_assigned ==''){
            $date_assigned = $curr_date;
        }else{
            $t = explode("-", $date_assigned);
            $arr = array($t[2],$t[1],$t[0]);
            $date_assigned = implode("/", $arr);
        }

        if($date_completed !=''){
            $t = explode("-", $date_completed);
            $arr = array($t[2],$t[1],$t[0]);
            $date_completed = implode("/", $arr);
        }


        if($date_due !=''){
            $t = explode("-", $date_due);
            $arr = array($t[2],$t[1],$t[0]);
            $date_due = implode("/", $arr);
        }


        /*echo $tut_input;
        echo $stu_input;
        echo $subject_input;
        echo $tpay_input;
        echo $spay_input;
        echo $curr_date;
        echo $status_input;*/


        $qqq = mysqli_query($db, "SELECT hs_id FROM homework_assignment WHERE hs_id = '$assn_num_val'");
        if(mysqli_num_rows($qqq)==0){
            $query = mysqli_query($db, "INSERT INTO homework_assignment(hs_id, hs_num, teacher_id, student_id, student_name, student_email, topic, description, file_format, price_paid, price_to_tutor, date_assigned, date_completed, date_due, status) VALUES('$assn_num_val', '$assn_num_val', '$tut_input', '$stu_input', '$stu_val_2', '$stu_email_val',  '$as_topic', '$as_description', '$as_file_format', '$as_price_paid', '$as_tutor_price', '$date_assigned', '$date_completed', '$date_due', '$status_value')");

        
            if($query){
                $cur_hs = $assn_num_val;


                function emptyDir($dir) {
                    if (is_dir($dir)) {
                        $scn = scandir($dir);
                        foreach ($scn as $files) {
                            if ($files !== '.') {
                                if ($files !== '..') {
                                    if (!is_dir($dir . '/' . $files)) {
                                        unlink($dir . '/' . $files);
                                    } else {
                                        emptyDir($dir . '/' . $files);
                                        rmdir($dir . '/' . $files);
                                    }
                                }
                            }
                        }
                    }
                }

                $d = "homework/".$cur_hs;
                if(is_dir($d))
                {
                    emptyDir($d);
                    rmdir($d);
                }

                mkdir($d);

                $q = mysqli_query($db, "INSERT INTO homework_review(hs_id, discussion, status) VALUES('$cur_hs', '', 'Active')");
                $q = mysqli_query($db, "INSERT INTO homework_uploads(hs_id, uploads,count) VALUES('$cur_hs', 'n/a',0)");

                $from = 'Learnon! Administrator';
                $subject = 'New Homework Assigned. Please start Working on it!';

                $q = mysqli_query($db, "INSERT INTO teacher_notification(t_from, teacher_id, student_id, t_noti_subject, t_noti_date) VALUES('$from', '$tut_input', '$stu_input', '$subject', '$curr_date')");

                $qq = mysqli_query($db, "SELECT email FROM login WHERE login_id = (SELECT login_id FROM teacher WHERE teacher_id = '$tut_input')");
                $iemail = "";
                while($rr = mysqli_fetch_assoc($qq)){
                    $iemail = $rr["email"];
                }

                send_hw_notification_email($dh, $iemail);

                //echo "done";
            }else{
                echo mysqli_error($db)." ".$assn_num_val;
            }
        }else{
            echo "duplicate";
        }


    }else{

         //header("Location: logout.php?logout");
        echo "not authorised";
    }




    function send_hw_notification_email($db, $iemail){
        
        $s_mail = null;
        $s_pass = null;
        $s_host = null;
        $s_port = null;
        $sq = mysqli_query($db, "SELECT from_hw_email, from_hw_email_pass, from_hw_email_host, from_hw_email_port FROM admin_general_details");
        while($rq = mysqli_fetch_assoc($sq)){
            $s_mail = $rq["from_hw_email"];
            $s_pass = $rq["from_hw_email_pass"];
            $s_host = $rq["from_hw_email_host"];
            $s_port = $rq["from_hw_email_port"];
        }

        $s_pass = my_simple_crypt($s_pass, 'd');

        //$iemail = $to_val;
        require 'PHPMailer/PHPMailerAutoload.php';
        require 'PHPMailer/class.phpmailer.php';

        $mail = new PHPMailer;
            //$mail->IsMAIL();
        $mail->isSMTP();                            // Set mailer to use SMTP
        $mail->Host = $s_host;         // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                     // Enable SMTP authentication
        $mail->Username = $s_mail;        // SMTP username
        $mail->Password = $s_pass; // SMTP password
        $mail->SMTPSecure = 'ssl';                  // Enable TLS encryption, `ssl` also accepted
        $mail->Port = $s_port;                         // TCP port to connect to
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
        

        $mail->isHTML(true);  // Set email format to HTML


        

        $mail->Subject = "New Assignment";
        $mail->Body    = '<p>This is to inform you that you have been assigned a new assignment.<br>Please login to see details.</p><p>For any queries, mail to <a href = "info@learnon.ca">info@learnon.ca</a></p>';



        
        
                
            
        //$mail->send()


        if(!$mail->send()) {
            //echo 'error';
            //echo "prob";
            echo $mail->ErrorInfo;;
        } else {
            
            echo "done";

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

