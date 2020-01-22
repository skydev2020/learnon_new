<?php
    session_start();
                        $l_id=$_SESSION['id'];
                        $login_session=$_SESSION['user_email'];
                        if(!isset($_SESSION['user_email'])){
                           header("Location: index.php");
                        }
                        else{
                            require ("fpdf/fpdf.php");
                            //session_start();
                            include("configs.php");
                            $astd_id = $_GET["astd_id"];
                            //$l_id=2;
                            
                            $l_id = my_simple_crypt($astd_id, 'd');

                                $temp_email = "";
                                $temp_sign_up_date = "";
                                $temp_f_name = "";
                                $temp_l_name = "";
                                $temp_home_phone = "";
                                $temp_cell_phone = "";
                                $temp_home_address = "";
                                $temp_city = "";
                                $temp_state = "";
                                $temp_postal_code = "";
                                $temp_country = "";
                                $temp_ip = ""; 


                                $q = mysqli_query($db, "SELECT email FROM login WHERE login_id = '$l_id'");
                                while($r = mysqli_fetch_assoc($q)){
                                    $temp_email = $r["email"];
                                }


                            
                            $name = "";
                            $qg = mysqli_query($db, "SELECT * FROM student WHERE login_id = '$l_id'");
                                while($rg = mysqli_fetch_assoc($qg)) {
                                            $name = $rg["s_first_name"];
                                            $name = $name." ".$rg["s_last_name"];

                                            
                                            $temp_ip = $rg["s_ip"];
                                            $temp_sign_up_date = $rg["dates"];
                                            $temp_f_name = $rg["s_first_name"];
                                            $temp_l_name = $rg["s_last_name"];
                                            $temp_home_phone = $rg["telephone_main"];
                                            $temp_cell_phone = $rg["telephone_opt"];
                                            $temp_home_address = $rg["address"];
                                            $temp_city = $rg["city"];
                                            $temp_state = $rg["province_id"];
                                                $qq = mysqli_query($db, "SELECT * FROM province WHERE province_id = '$temp_state'");
                                                while($r = mysqli_fetch_assoc($qq)){
                                                    $temp_state = $r["province_name"];
                                                } 
                                            $temp_postal_code = $rg["postal_code"];
                                            $temp_country = $rg["country_id"];
                                                $qq = mysqli_query($db, "SELECT * FROM country WHERE country_id = '$temp_country'");
                                                while($r = mysqli_fetch_assoc($qq)){
                                                    $temp_country = $r["country_name"];
                                                }
                                } 
                            $pdf =  new FPDF();
                            $pdf->AddPage();
                            $pdf->SetFont("Arial","U","30");
                            $pdf->MultiCell(0,10," LearnOn Client Contract ",0,"C");
                            $pdf->MultiCell(0,20,"",0,"C");

                            $gap = "                 ";
                            $pdf->SetFont("Arial","","12");
                            $pdf->MultiCell(0,5,"User Id:   ".$gap.$temp_email);
                            $pdf->MultiCell(0,5,"",0,"C");

                            $gap = "              ";
                            $pdf->SetFont("Arial","","12");
                            $pdf->MultiCell(0,5,"IP Address:".$gap.$temp_ip);
                            $pdf->MultiCell(0,5,"",0,"C");

                            $gap = "         ";
                            $pdf->SetFont("Arial","","12");
                            $pdf->MultiCell(0,5,"Signup Date:   ".$gap.$temp_sign_up_date);
                            $pdf->MultiCell(0,5,"",0,"C");

                            $gap = "           ";
                            $pdf->SetFont("Arial","","12");
                            $pdf->MultiCell(0,5,"First Name:    ".$gap.$temp_f_name);
                            $pdf->MultiCell(0,5,"",0,"C");

                            $gap = "              ";
                            $pdf->SetFont("Arial","","12");
                            $pdf->MultiCell(0,5,"Last Name: ".$gap.$temp_l_name);
                            $pdf->MultiCell(0,5,"",0,"C");

                            $gap = "              ";
                            $pdf->SetFont("Arial","","12");
                            $pdf->MultiCell(0,5,"Telephone: ".$gap.$temp_home_phone);
                            $pdf->MultiCell(0,5,"",0,"C");

                            $gap = "  ";
                            $pdf->SetFont("Arial","","12");
                            $pdf->MultiCell(0,5,"Cell/Work Phone:   ".$gap.$temp_cell_phone);
                            $pdf->MultiCell(0,5,"",0,"C");

                            $gap = "       ";
                            $pdf->SetFont("Arial","","12");
                            $pdf->MultiCell(0,5,"Home Address:  ".$gap.$temp_home_address);
                            $pdf->MultiCell(0,5,"",0,"C");

                            $gap = "     ";
                            $pdf->SetFont("Arial","","12");
                            $pdf->MultiCell(0,5,"State/Province:    ".$gap.$temp_state);
                            $pdf->MultiCell(0,5,"",0,"C");

                            $gap = "          ";
                            $pdf->SetFont("Arial","","12");
                            $pdf->MultiCell(0,5,"Postal Code:   ".$gap.$temp_postal_code);
                            $pdf->MultiCell(0,5,"",0,"C");

                            $gap = "                 ";
                            $pdf->SetFont("Arial","","12");
                            $pdf->MultiCell(0,5,"Country:   ".$gap.$temp_country);
                            $pdf->MultiCell(0,5,"",0,"C");

                            $gap = "                       ";
                            $pdf->SetFont("Arial","","12");
                            $pdf->MultiCell(0,5,"Email: ".$gap.$temp_email);
                            $pdf->MultiCell(0,5,"",0,"C");


                            $pdf->MultiCell(0,10,"",0,"C");
                            $pdf->SetFont("Arial","BI","15");
                            $pdf->SetTextColor(11,11,11);
                            
                            $pdf->MultiCell(0,10,"",0,"C");
                            $pdf->MultiCell(0,10,"",0,"C");
                            $pdf->SetFont("Arial","","12");
                            $wr = "1. You certify that you are at least 18 years old and that you are the legal guardian of the child/children being registered. ";
                            $pdf->MultiCell(0,5,$wr);
                            //$pdf->SetTextColor(242,9,9);
                            $wr = "2. If you are not over 18, you MUST have parental permission to sign up for LearnOn! Tutoring.";
                            $pdf->MultiCell(0,10,"",0,"C");
                            $pdf->MultiCell(0,5,$wr);
                            //$pdf->SetTextColor(11,11,11);
                            $wr = "3. Appointments cancelled with less than 24 hours notice will be billed a minimum of 1 hour/session. ";
                            $pdf->MultiCell(0,10,"",0,"C");
                            $pdf->MultiCell(0,5,$wr);
                            //$pdf->MultiCell(0,10,"",0,"C");

                            $wr = "4. Appointments changed to another day can however waive this minimum fee. ";
                            $pdf->MultiCell(0,10,"",0,"C");
                            $pdf->MultiCell(0,5,$wr);

                            $wr = "5. You are billed at the end of every month for all hours/sessions completed throughout the calendar month. Payment is expected within 7 days. ";
                            $pdf->MultiCell(0,10,"",0,"C");
                            $pdf->MultiCell(0,5,$wr);

                            $wr = "6. Invoices more than 1 month late will have a $20/month late fee applied for every month that it is late. ";
                            $pdf->MultiCell(0,10,"",0,"C");
                            $pdf->MultiCell(0,5,$wr);

                            $wr = "7. Tutoring sessions are 60 minutes and you will be billed for a minimum 60 minutes, anything over that is billed at a fraction of the rate. ";
                            $pdf->MultiCell(0,10,"",0,"C");
                            $pdf->MultiCell(0,5,$wr);

                            $wr = "8. We do NOT offer a money back, first class free, \"demo\" or \"trial\" session offer. ";
                            $pdf->MultiCell(0,10,"",0,"C");
                            $pdf->MultiCell(0,5,$wr);

                            $wr = "9. There are NO REFUNDS or partial refunds on pre-purchased packages. We will keep changing tutors until you are happy with one. ";
                            $pdf->MultiCell(0,10,"",0,"C");
                            $pdf->MultiCell(0,5,$wr);

                            $wr = "10. Tutoring sessions are arranged directly with the LearnOn! office, tutors and clients are not to have ANY contact with each other outside of the prearranged sessions, unless given permission by the office. ";
                            $pdf->MultiCell(0,10,"",0,"C");
                            $pdf->MultiCell(0,5,$wr);

                            $wr = "11. If you arrange a tutoring session with LearnOn! and fail to appear or be available for the scheduled appointment you will be liable for 1 session of payment. ";
                            $pdf->MultiCell(0,10,"",0,"C");
                            $pdf->MultiCell(0,5,$wr);
                            
                            $wr = "12. We offer in-home tutoring, however should a tutor, for any reason feel uncomfortable or unsafe at your home he/she can choose to stop going at his/her discretion. ";
                            $pdf->MultiCell(0,10,"",0,"C");
                            $pdf->MultiCell(0,5,$wr);

                            $wr = "13. Students under the age of 16 should not be left at home alone with the tutor, this is a precautionary measure that should be taken to avoid any possible disputes. ";
                            $pdf->MultiCell(0,10,"",0,"C");
                            $pdf->MultiCell(0,5,$wr);

                            $wr = "14. Tutoring sessions are paid to LearnOn! and are not to be made to the tutors, we compensate the tutors under already set agreements (please contact us for specific instructions). ";
                            $pdf->MultiCell(0,10,"",0,"C");
                            $pdf->MultiCell(0,5,$wr);

                            $wr = "15. WE ARE NOT LIABLE FOR ANY DAMAGE (real or imagined), WHICH OCCURS TO A PERSON OR PROPERTY AS A RESULT OR AS A PERCEIVED RESULT OF TUTORING SESSIONS PROVIDED BY LearnOn! By entering into a tutoring agreement with LearnOn! you accept that LearnOn! is not responsible for any damage, loss, theft, or bodily harm that may arise from tutoring sessions arranged with LearnOn! We provide tutors that are trustworthy and responsible, we do checks on them, check with references and take all the precautionary means that are available to us however any issue that arises with an individual tutor must be taken up directly with the tutor and is separate in its entirety from LearnOn! ";
                            $pdf->MultiCell(0,10,"",0,"C");
                            $pdf->MultiCell(0,5,$wr);

                            //$pdf->MultiCell(0,10,"",0,"C");

                            $wr = "16. BY ENTERING INTO ANY FORM OF ARRANGEMENT OR AGREEMENT WITH LearnOn!, YOU AGREE TO ABSOLVE LearnOn! FOR LIABILITY, ACTIONS OR CLAIMS FOR ANY DAMAGES, IN ALL AREAS OF LAW, INCLUDING BUT NOT LIMITER TO CRIMINAL, TORT, CONTRACT, PROPERTY AND OTHERS. ";
                            $pdf->MultiCell(0,10,"",0,"C");
                            $pdf->MultiCell(0,5,$wr);

                            $wr = "17. LearnOn! strives to provide you with the best available tutors and the best academic help possible. We want to help you understand the basics as well as prepare you for exams, however LearnOn! nor any individual tutor will be held accountable or responsible for the academic success or lack thereof demonstrated by the student/client, however we will do everything in our power to help grades/skills improve. ";
                            $pdf->MultiCell(0,10,"",0,"C");
                            $pdf->MultiCell(0,5,$wr);

                            $wr = "18. YOU the client AGREE that you will NOT solicit any tutor who is assigned to you by LearnOn tutoring for any direct private tutoring services. ";
                            $pdf->MultiCell(0,10,"",0,"C");
                            $pdf->MultiCell(0,5,$wr);

                            $wr = "19. YOU the client AGREE that you will NOT make direct payment to any tutor and \"skip\" over LearnOn! Tutoring. ";
                            $pdf->MultiCell(0,10,"",0,"C");
                            $pdf->MultiCell(0,5,$wr);

                            $wr = "20. If you the client breaks the agreement and makes a direct deal with a tutor assigned to you by LearnOn! Tutoring you are financially liable to LearnOn! Tutoring for all the sessions obtained privately from the tutor. You the client are financially responsible for all legal, collection and court costs that LearnOn! Tutoring incurs in order to enforce this agreement, that includes all lost revenues from paying the tutor directly, soliciting the tutors services privately and skipping over LearnOn! Tutoring. ";
                            $pdf->MultiCell(0,10,"",0,"C");
                            $pdf->MultiCell(0,5,$wr);

                            
                                $pdf->SetFont("Arial","BI","15");
                            $wr = "                             I, ".$name.", have carefully read and agree to the Terms & Conditions ";
                            $pdf->MultiCell(0,10,"",0,"C");
                            $pdf->MultiCell(0,5,$wr);


                            /*$l_id = md5($l_id+10);
                            $fn = "contract#".$l_id."."."pdf";
                            $filename="contracts/".$fn;
                            $pdf->Output($filename,'F');*/

                            $pdf->Output();
                        }





                        function my_simple_crypt( $string, $action ) {
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