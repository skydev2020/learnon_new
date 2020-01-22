<?php
include("configs.php");
session_start();
use PHPMailer\Exception;
	if( $_POST["add"] ) {

	   $st_name = $_POST['st_name'];
     $id = 0;
     $i = strpos($st_name, "(");
     $len =  strlen($st_name);
     while($st_name[$i]!=")"){
        $id = ($id * 10) +($st_name[$i]+1-1);
        $i++;
     }
	 
     $s_date = $_POST['s_date'];
     $tmp_date = "";
     $arr = explode("-", $s_date);
     $tmp_date = $arr[2]."/".$arr[1]."/".$arr[0];
     $s_date = $tmp_date;

     $s_hour = $_POST['hour'];
     $s_min = $_POST['min'];

     $curr_date = date("d/m/Y");

     if($s_min == 15){
        $duration = 0.25;
     }else if($s_min == 30){
        $duration = 0.5;
     }else if($s_min == 45){
        $duration = 0.75;
     }else{
      $duration = 0.00;
     }

     $duration = $s_hour+$duration;
    
     $notes = $_POST['notes'];


     
    $tmp_qr  = mysql_query("SELECT base_wage, base_invoice,total_hour_worked FROM teacher_assignment WHERE tut_ass_id = '$id'");
    $b_wage = 0;
    $b_invoice = 0;
    $tmp_rw = mysql_fetch_assoc($tmp_qr);
     $b_wage = $tmp_rw["base_wage"];
      $b_invoice = $tmp_rw["base_invoice"];
      $total_hour_worked=$tmp_rw["total_hour_worked"];
    

   $getPakageDeatils = mysql_fetch_array(mysql_query("select * from package_bought where student_id = (SELECT student_id FROM teacher_assignment WHERE tut_ass_id = '$id') "));

   $studentID = $getPakageDeatils["student_id"];
   $promotionID = $getPakageDeatils["package_id"];
   $usedHourse = $getPakageDeatils["used_hour"];
   $total_hour_worked = $total_hour_worked+$duration;
   $due_hour= $getPakageDeatils["due_hour"]+$duration;
   $usedHourseNew = $usedHourse+$duration;
   $remainingHours = $getPakageDeatils["remaining_hour"]-$duration;


   if ($total_hour_worked>6) {
    $b_wage = 21;
   } 
   if ($total_hour_worked>16) {
     $b_wage = 23;
   } 
   if ($total_hour_worked>21) {
     $b_wage = 25;
   }
   

     $date = date("d/m/Y"); 
     $invoicePre = 'INV-'.date('Y');

     $maxInvoice = mysql_fetch_array(mysql_query("select max(invoice_id) as maxInvoice from invoices"));
     $maxInvoice = $maxInvoice["maxInvoice"]+1;
  
     $tt = $maxInvoice + 954;

                                                                    $p_price = "";
                                                                    $p_hrs = "";
                                                                    $calcuPromotion = "";
                                                                    $q2 = mysql_query("SELECT * FROM learn_promotion_tbl WHERE promotion_id = '$promotionID'");
                                                                    $r2 = mysql_fetch_assoc($q2);

                                                                   
                                                                    $p_hrs = $r2["promotion_number_of_hr"];

                                                                    $baseAmountMultiMain = $b_invoice*$p_hrs;
                                                                    if ($r2["promotion_discount_type"]=='Percentage') {

                                                                      $calcuPromotionMain = ($baseAmountMultiMain/100)*$r2["promotion_discount"];
                                                                      $p_priceMain = $baseAmountMultiMain-$calcuPromotionMain;
                                                                     
                                                                    } else {
                                                                      $calcuPromotionMain = $baseAmountMultiMain-$r2["promotion_discount"];
                                                                     $p_priceMain = $calcuPromotionMain;
                                                                     
                                                                   }

                                                                    $baseAmountMulti = $b_invoice*$duration;
                                                                    if ($r2["promotion_discount_type"]=='Percentage') {

                                                                      $calcuPromotion = ($baseAmountMulti/100)*$r2["promotion_discount"];
                                                                      $p_price = $baseAmountMulti-$calcuPromotion;
                                                                     
                                                                    } else {
                                                                      $calcuPromotion = $baseAmountMulti-$r2["promotion_discount"];
                                                                     $p_price = $calcuPromotion;
                                                                     
                                                                    }

                                                                    $balanceAmount = $p_priceMain-$p_price;


                                                                     
                                                         
                                                        




                                                                    if ($getPakageDeatils["remaining_hour"]<$duration) {

 
                                                                      mysql_query("INSERT ignore INTO `invoices` (`invoice_master_num`,`invoice_assign_id`,`invoice_id`, `invoice_num`, `invoice_prefix`, `student_id`, `invoice_date`, `send_date`, `pay_date`, `due_date`, `total_hours`, `hour_charged`, `num_of_sessions`, `bill_amount`, `late_fee`, `total_amount`, `paid_amount`, `balance_amount`, `invoice_notes`, `invoice_status`, `date_modified`, `is_locked`) VALUES ('0','$id','$maxInvoice', '$tt', '$invoicePre', '$studentID', '$s_date', '$date', '$date', '$date', '$duration', '$duration', 1, '$p_price', 0, '$p_price', '$p_price', '$balanceAmount', '$notes', 'Unpaid', '$date', 0)");
 
                                                                       mysql_query("update teacher_assignment set total_hour_worked='$total_hour_worked'   WHERE tut_ass_id = '$id'");

                                                                        //mysql_query("update package_bought set due_hour='$due_hour' where student_id ='$studentID' ");

                                                                    } else {
 
                                                                       mysql_query("INSERT ignore INTO `invoices` (`invoice_master_num`,`invoice_assign_id`,`invoice_id`, `invoice_num`, `invoice_prefix`, `student_id`, `invoice_date`, `send_date`, `pay_date`, `due_date`, `total_hours`, `hour_charged`, `num_of_sessions`, `bill_amount`, `late_fee`, `total_amount`, `paid_amount`, `balance_amount`, `invoice_notes`, `invoice_status`, `date_modified`, `is_locked`) VALUES ('0','$id','$maxInvoice', '$tt', '$invoicePre', '$studentID', '$s_date', '$date', '$date', '$date', '$duration', '$duration', 1, '$p_price', 0, '$p_price', '$p_price', '$balanceAmount', '$notes', 'Paid', '$date', 0)");

                                                                        mysql_query("update teacher_assignment set total_hour_worked='$total_hour_worked'   WHERE tut_ass_id = '$id'");

                                                                        mysql_query("update package_bought set remaining_hour='$remainingHours', used_hour='$usedHourseNew'  where  student_id ='$studentID' ");
                                                                  
                                                                    }
                                                                    

       
   
  

    
     

     $query =  mysql_query("INSERT INTO sessions(tut_ass_id, session_date, session_duration, session_tut_notes, session_creation_date, base_wage, base_invoice, payment_status) VALUES('$id', '$s_date', '$duration', '$notes','$curr_date', '$b_wage', '$b_invoice' ,'UNPAID')");
     echo mysql_error();

     $qq = mysql_query("SELECT session_id FROM sessions WHERE tut_ass_id = '$id' ORDER BY session_id");
     $tmpp_session_id;
     while($rr = mysql_fetch_assoc($qq)){
      $tmpp_session_id = $rr["session_id"];
     }

exit;
     if($query){
        //echo "true";

      $iemail;
      

      $q = mysql_query("SELECT email FROM login WHERE login_id = (SELECT login_id FROM student where student_id = (SELECT student_id FROM teacher_assignment WHERE tut_ass_id = '$id'))");
      if($q){
          while($r = mysql_fetch_assoc($q)){
             $iemail = $r["email"];
          }


            $teacher_name;
            $q = mysql_query("SELECT t_first_name, t_last_name, teacher_id FROM teacher WHERE teacher_id = (SELECT teacher_id FROM teacher_assignment WHERE tut_ass_id = '$id')");

                $tea_id;
                while($r = mysql_fetch_assoc($q)){
                    $teacher_name  = $r["t_first_name"]." ".$r["t_last_name"];
                    $tea_id = $r["teacher_id"];
                }

                //add student notification
                $stu_id;
                $qqq = mysql_query("SELECT student_id FROM teacher_assignment WHERE tut_ass_id = '$id'");
                while($rrr = mysql_fetch_assoc($qqq)){
                  $stu_id = $rrr["student_id"];
                }

                $tmp_date = date("d/m/Y");
                $qqq = mysql_query("INSERT INTO student_notification(s_from, student_id, teacher_id, s_noti_subject, s_noti_msg, s_noti_date) VALUES('$teacher_name', '$stu_id', '$tea_id', 'Session hours Have been logged', '','$tmp_date')");
              

              $s_mail;
              $s_pass;
              $s_host;
              $s_port;
              $sq = mysql_query("SELECT email, email_pass, email_host, email_port FROM admin_general_details");
              while($rq = mysql_fetch_assoc($sq)){
                $s_mail = $rq["email"];
                $s_pass = $rq["email_pass"];
                $s_host = $rq["email_host"];
                $s_port = $rq["email_port"];
              }

              $s_pass = my_simple_crypt($s_pass, 'd');
          

              require 'PHPMailer/PHPMailerAutoload.php';
              require 'PHPMailer/class.phpmailer.php';

              $mail = new PHPMailer;
                //$mail->IsMAIL();
              $mail->isSMTP();                            // Set mailer to use SMTP
              $mail->Host = $s_host;           // Specify main and backup SMTP servers
              $mail->SMTPAuth = true;                     // Enable SMTP authentication
              $mail->Username = $s_mail;        // SMTP username
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



              if($s_hour>=3){
                $temp_email = $iemail;

                 $iemail = $s_mail;    //replace with admin email
                $mail->addAddress($iemail); 
                $mail->Subject = 'Session with more than 3 Hours Logged';
                $bodyContent = "<p>Hours  have been logged by <b>".$teacher_name."</b> for the Session held on <b>".$s_date."</b></p><br> Logged Hours : <b>".$s_hour." Hour and ".$s_min." Minutes</b><p><b>Session ID: ".$tmpp_session_id."</b></p>";
                 $mail->Body    = $bodyContent;




                 $c_date = date("Y-m-d");
                 $c_time = date("H:i:s");

                    $qqq = mysql_query("INSERT INTO mail_log(mail_from, mail_to, subject, message, date_sent, time_sent) VALUES('$s_mail', '$iemail', 'Session with more than 3 Hours Logged', '$bodyContent', '$c_date', '$c_time' )");


                 $mail->send();
                 $iemail = $temp_email;
              }

              $check_regex = date("m/Y");
              $sum = 0;
              $qq = mysql_query("SELECT session_duration FROM sessions WHERE tut_ass_id = '$id' AND session_date LIKE '%$check_regex%'");
              while($rr=mysql_fetch_assoc($qq)){
                $sum = $sum + $rr["session_duration"];
              }


              if($sum>=10){
                $temp_email = $iemail;

                 $iemail = $s_mail;     //replace with admin email
                $mail->addAddress($iemail); 
                $mail->Subject = 'Session with more than 10 Hours Logged';
                $bodyContent = "<p>Hours  have been logged by <b>".$teacher_name."</b> for the Session held on <b>".$s_date."</b></p><br> Logged Hours : <b>".$sum." for the month ".date("F")."</b><p><b>Session ID: ".$tmpp_session_id."</b></p>";
                 $mail->Body    = $bodyContent;


                 $c_date = date("Y-m-d");
                 $c_time = date("H:i:s");

                    $qqq = mysql_query("INSERT INTO mail_log(mail_from, mail_to, subject, message, date_sent, time_sent) VALUES('$s_mail', '$iemail', 'Session with more than 10 Hours Logged', '$bodyContent', '$c_date', '$c_time' )");


                 $mail->send();
                 $iemail = $temp_email;
              }



              
              $bodyContent = "<p>Hours have been logged by <b>".$teacher_name."</b> for the Session held on <b>".$s_date."</b></p><br> Logged Hours : <b>".$s_hour." Hour and ".$s_min." Minutes</b><p>If you have any dispute regarding the hours logged by the tutor then please flag the issue in the <b>\"MY SESSIONS\"</b> section of your account and let us know !</p>";

              

              $mail->Subject = 'Session Hours Logged';
              $mail->Body    = $bodyContent;

              $c_date = date("Y-m-d");
                 $c_time = date("H:i:s");

                    $qqq = mysql_query("INSERT INTO mail_log(mail_from, mail_to, subject, message, date_sent, time_sent) VALUES('$s_mail', '$iemail', 'Session Hours Logged', '$bodyContent', '$c_date', '$c_time' )");

              if(!$mail->send()) {
                  echo $iemail;

                }else{

                    echo "true";
              }


      }else{
         echo "failed";
      }


      
     }else{
        echo mysql_error();
     }

   
  }else{
    	echo "false";
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