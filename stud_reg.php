<!DOCTYPE html>
<html lang="en">
<head>
  <title>Student Registration</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

  
<div class="container">
    <div class="row" style="background-color: #3967b2;">
      <div class="col-md-4 col-lg-4 col-sm-6 col-xs-12">
        <img src="assets/dist/img/logo3.png" height="100">
      </div>
      <div class="col-md-1 col-lg-1 col-md-offset-7 col-lg-offset-7 col-sm-2 col-xs-4 col-xs-offset-8">
        <a href="index.php"><span style="color: white;"><h4>Log In</h4></span></a>
      </div>
    </div>   

    <div class="row">
      <div class="col-md-10 col-md-offset-1 col-lg-offset-1 col-lg-10 col-sm-12 col-xs-12">
        <br>
        <p style="color: #003366; font-size: 15px;"><b>         
        When you register a student you are creating a LearnOn! Account, you can login at any time to update your information, view your tutor info, pay invoices and buy hours. Your email address will be your username.
        You will be assigned a tutor in aprox 48 hours. You will be notified by email and your new tutor will call you to set up your session.</b>
        </p>
      </div>
    </div>  
    <br>

    <div class="row">
      <div class="col-md-10 col-md-offset-1 col-lg-10 col-lg-offset-1">
        <form method="post" action="stud_reg_add.php" autocomplete="off" id="myform" onsubmit="return do_something()">
          <div class = "row">
            <div class="form-group col-md-4" >
            <label >Email</label>
            <input type="text" id="email" class="form-control"  placeholder="Enter your email" name="email_val" required onblur="checkMailStatus()" >
          </div>

          </div>


              <script type="text/javascript">
                  var check_main = 1;
                  function checkMailStatus(){
                    //document.getElementById("dup_email_prob").style.display = "block";
                      
                  var email=$("#email").val();// value in field email
                  $.ajax({
                      type:'post',
                          url:'check_mail.php',// put your real file name 
                          data:{email: email},
                          success:function(msg){  
                            //alert(msg); // your message will come here.     
                            if(msg!=""){
                                alert(msg);
                                check_main = 1;
                            }else{
                                check_main = 0;
                            }

                            //alert(check_main);
                        }
                   });
                  }


                  function do_something(){

                    console.log(check_main);
                        if(check_main==0){
                          document.getElementById("dup_email_prob").style.display = "none";
                          return true;
                        }else{
                          document.getElementById("dup_email_prob").style.display = "block";
                          return false;
                        }
                  }

              </script>

          <div class = "row">
            <div class="form-group col-md-4" >
            <label >Select Password</label>
            <input type="password" id="pass1" class="form-control"  placeholder="Enter password of choice" name="opsw_val" required>
          </div>

          <div class="form-group col-md-4" >
            <label >Confirm Password</label>
            <input type="password" id="pass2" class="form-control"  placeholder="Confirm password of choice" name="cpsw_val" required onkeyup="checkPass(); return false;">
                      <span id="confirmMessage" class="confirmMessage"></span>
          </div>
          <div class="col-md-4">
              <br>
              <strong>Info!</strong> you will require the email id and password for Login
          </div>
          </div>

              <script type="text/javascript">
                  function checkPass()
                  {
                      //Store the password field objects into variables ...
                      var pass1 = document.getElementById('pass1');
                      var pass2 = document.getElementById('pass2');
                      //Store the Confimation Message Object ...
                      var message = document.getElementById('confirmMessage');
                      //Set the colors we will be using ...
                      var goodColor = "#bcf442";
                      var badColor = "#f44141";
                      //Compare the values in the password field 
                      //and the confirmation field
                      if(pass1.value == pass2.value){
                          //The passwords match. 
                          //Set the color to the good color and inform
                          //the user that they have entered the correct password 
                          pass2.style.backgroundColor = goodColor;
                          message.style.color = goodColor;
                          message.innerHTML = "Passwords Match!"
                      }else{
                          //The passwords do not match.
                          //Set the color to the bad color and
                          //notify the user.
                          pass2.style.backgroundColor = badColor;
                          message.style.color = badColor;
                          message.innerHTML = "Passwords Do Not Match!"
                      }
                  }  
              </script>

          <div class = "row">
           <div class="form-group col-md-4" >
            <label >Student First name</label>
            <input onclick="myFunction()" type="text" class="form-control"  placeholder="First name" name="fname_val" required>
          </div> 
                  <script type="text/javascript">
                      function myFunction(){
                          
                      }
                  </script>   

          <div class="form-group col-md-4" >
            <label >Student Last name</label>
            <input type="text" class="form-control"  placeholder="Last name" name="lname_val" required>
          </div>      
          </div>
          

          <div class="row">
            <div class="form-group col-md-4 " >
            <label >Current Grade / Year :  </label>
              <select name = "grade_val" id = "g_val" class="form-control">
                <?php
                include("configs.php");
                  $query = mysqli_query($db, "SELECT * FROM grade"); 
                  while($row = mysqli_fetch_assoc($query)) {
                      ?>
                      <option value="<?php echo $row["grade_id"];?>"><?php echo $row["grade_name"];?></option>
                      <?php

                  }
                ?>
              </select>
          </div>  
          </div>


              <div class="row">
                  <div class="form-group col-md-8" >
                      <label >Courses</label>
                      <br>
                      Seperate Multiple courses by a comma (,)
                      <br>
                      
                      <textarea class="form-control inputstl"  name = "course_val" placeholder="Enter the courses that you require" >
                      </textarea>

                  </div>  
                  
              </div>






          <div class = "row">
           <div class="form-group col-md-4" >
            <label >Parent's First name</label>
            <input type="text" class="form-control"  placeholder="First name" name="pfname_val" required>
          </div>    

          <div class="form-group col-md-4" >
            <label >Parent's Last name</label>
            <input type="text" class="form-control"  placeholder="Last name" name="plname_val" required>
          </div>      
          </div>
          <div class = "row">
           <div class="form-group col-md-4" >
            <label >Telephone</label>
            <input type="text" class="form-control"  placeholder="Telephone Number" name="phone_val"  onkeypress="return isNumberKey(event)"">
          </div>  
          <div class="form-group col-md-4" >
            <label >Cell/Work phone number</label>
            <input type="text" class="form-control"  placeholder="Optional phone Number" name="pphone_val"  onkeypress="return isNumberKey(event)"">
          </div>  

          <script type="text/javascript">
            function isNumberKey(evt){
                var charCode = (evt.which) ? evt.which : event.keyCode
                if (charCode > 31 && (charCode < 48 || charCode > 57))
                    return false;
                return true;
            }
          </script>
          </div>
          <div class="row">
            <div class="form-group col-md-8" >
            <label >Address</label>
              
              <textarea class="form-control inputstl"  name = "add_val" required>
            </textarea>

          </div>  
            
          </div>

          <div class="row">
            <div class="form-group col-md-8" >
            <label >City</label>
              <input type="text" class="form-control"  placeholder="City" name="city_val" required>
            
          </div>  
            
          </div>

          <div class="row">
            <div class="form-group col-md-4 " >
            <label >Province: </label>
              <select  name="province_val" class="form-control">
               <option>Select Province</option>
                <?php
                include("configs.php");
                  $query = mysqli_query($db, "SELECT * FROM province"); 
                  while($row = mysqli_fetch_assoc($query)) {
                      ?>
                      <option value="<?php echo $row["province_id"];?>"><?php echo $row["province_name"];?></option>
                      <?php

                  }
                ?>
              </select>
          </div>  
          </div>

          <div class="row">
            <div class="form-group col-md-2" >
            <label >Postal Code</label>
            <input type="text" class="form-control"  placeholder="Postal Code" name="postal_val" required maxlength="7" >
          </div> 
          </div>



          <div class="row">
            <div class="form-group col-md-4 " >
            <label >Country:  </label>
              <select  name="country_val" class="form-control">
                <?php
                include("configs.php");
                  $query = mysqli_query($db, "SELECT * FROM country"); 
                  while($row = mysqli_fetch_assoc($query)) {
                      ?>
                      <option  value="<?php echo $row["country_id"];?>"><?php echo $row["country_name"];?></option>
                      <?php

                  }
                ?>
              </select>
          </div>  
          </div>




          <div class="row">
            <div class="form-group col-md-8" >
            <label >Notes</label>
              
              <textarea class="form-control inputstl"  name = "notes_val" >
            </textarea>

          </div>  
            
          </div>

          <div class="row">
            <div class="form-group col-md-8" >
            <label >Major Street Intersection</label>
            <input type="text" class="form-control"  placeholder="Major Street Intersection" name="street_intersection_val" required>
          </div> 
          </div>

          <div class="row">
            <div class="form-group col-md-6" >
            <label >School Name</label>
            <input type="text" class="form-control"  placeholder="School Name" name="school_val" required>
          </div> 
          </div>



          <div class="row">
            <div class="form-group col-md-4 " >
            <label >How you heard about us: </label>
              <select  name="how_val" required class="form-control">
                <?php
                include("configs.php");
                  $query = mysqli_query($db, "SELECT * FROM how_res"); 
                  while($row = mysqli_fetch_assoc($query)) {
                      ?>
                      <option  value="<?php echo $row["how_id"];?>"><?php echo $row["how_source"];?></option>
                      <?php

                  }
                ?>
              </select>
          </div>  
          </div>



          <div class="row">
            <div class="form-group col-md-6" >
            <label >If "Other"</label>
            <input type="text" class="form-control"  placeholder="Enter details" name="other_how_val" >
          </div> 
          </div>


          <div class="row">
            <div class="form-group col-md-12" >
            <label >Terms & Comditions</label>
              
              <textarea class="form-control inputstl"  name = "term_val" rows="10"  readonly="">
  1. You certify that you are at least 18 years old and that you are the legal guardian of the child/children being registered.
   
  2. If you are not over 18, you MUST have parental permission to sign up for LearnOn! Tutoring.
   
  3. Appointments cancelled with less than 24 hours notice will be billed a minimum of 1 hour/session.
   
  4. Appointments changed to another day can however waive this minimum fee.
   
  5. You are billed at the end of every month for all hours/sessions completed throughout the calendar month. Payment is expected within 7 days.
   
  6. Invoices more than 1 month late will have a $20/month late fee applied for every month that it is late.
   
  7. Tutoring sessions are 60 minutes and you will be billed for a minimum 60 minutes, anything over that is billed at a fraction of the rate.
   
  8. We do NOT offer a money back, first class free, "demo" or "trial" session offer.
  9.  There are NO REFUNDS or partial refunds on pre-purchased packages.  We will keep changing tutors until you are happy with one.
   
  10. Tutoring sessions are arranged directly with the LearnOn! office, tutors and clients are not to have ANY contact with each other outside of the prearranged sessions, unless given permission by the office.
   
  11. If you arrange a tutoring session with LearnOn! and fail to appear or be available for the scheduled appointment you will be liable for 1 session of payment.
   
  12. We offer in-home tutoring, however should a tutor, for any reason feel uncomfortable or unsafe at your home he/she can choose to stop going at his/her discretion.
   
  13. Students under the age of 16 should not be left at home alone with the tutor, this is a precautionary measure that should be taken to avoid any possible disputes.
   
  14. Tutoring sessions are paid to LearnOn! and are not to be made to the tutors, we compensate the tutors under already set agreements (please contact us for specific instructions).
   
  15. WE ARE NOT LIABLE FOR ANY DAMAGE (real or imagined), WHICH OCCURS TO A PERSON OR PROPERTY AS A RESULT OR AS A PERCEIVED RESULT OF TUTORING SESSIONS PROVIDED BY LearnOn! By entering into a tutoring agreement with LearnOn! you accept that LearnOn! is not responsible for any damage, loss, theft, or bodily harm that may arise from tutoring sessions arranged with LearnOn! We provide tutors that are trustworthy and responsible, we do checks on them, check with references and take all the precautionary means that are available to us however any issue that arises with an individual tutor must be taken up directly with the tutor and is separate in its entirety from LearnOn!
   
  16. BY ENTERING INTO ANY FORM OF ARRANGEMENT OR AGREEMENT WITH LearnOn!, YOU AGREE TO ABSOLVE LearnOn! FOR LIABILITY, ACTIONS OR CLAIMS FOR ANY DAMAGES, IN ALL AREAS OF LAW, INCLUDING BUT NOT LIMITER TO CRIMINAL, TORT, CONTRACT, PROPERTY AND OTHERS.
   
  17. LearnOn! strives to provide you with the best available tutors and the best academic help possible. We want to help you understand the basics as well as prepare you for exams, however LearnOn! nor any individual tutor will be held accountable or responsible for the academic success or lack thereof demonstrated by the student/client, however we will do everything in our power to help grades/skills improve.
   
  18. YOU the client AGREE that you will NOT solicit any tutor who is assigned to you by LearnOn tutoring for any direct private tutoring services.
   
  19. YOU the client AGREE that you will NOT make direct payment to any tutor and "skip" over LearnOn! Tutoring.
   
  20. If you the client breaks the agreement and makes a direct deal with a tutor assigned to you by LearnOn! Tutoring you are financially liable to LearnOn! Tutoring for all the sessions obtained privately from the tutor. You the client are financially responsible for all legal, collection and court costs that LearnOn! Tutoring incurs in order to enforce this agreement, that includes all lost revenues from paying the tutor directly, soliciting the tutors services privately and skipping over LearnOn! Tutoring.
            </textarea>

          </div>  
            
          </div>

          <div class="row">
            <div class="form-group col-md-12" >
            
            <input type="checkbox" name="terms_val" id ="terms_val" required>I have read and agree to the <b>Terms & Conditions</b>
                      <b><span id="tcmessage" class="confirmMessage"></span><b>
                      <br>
          </div> 
            
          </div>
          
          <div class="row" id="btn_dsp" style="text-align: center;" >
            <div class="form-group col-md-12" >
              <span style="color: red;display: none;" id="dup_email_prob"><b>Email already Exists !</b></span>
            </div> 
          </div> 

          <div class="row" id="btn_dsp" style="text-align: center;">
            <div class="form-group col-md-12" >
              <button type="submit" class="btn-info btn" name="btn-signup" onclick="validates()">Register</button>
            </div> 
          </div>

          

          <div class="row" id="pl_wt" style="text-align: center; display: none;">
            <div class="form-group col-md-12" >
              <h3>Please Wait......</h3>
            </div>
          </div> 
          <br>
          <br>


              <script type="text/javascript">
                  function validates(){
                      var message = document.getElementById('tcmessage');
                      if(document.getElementById("terms_val").checked == false){
                          var badColor = "#f44141";
                          message.style.color = badColor;
                          message.innerHTML = "Please accept the Terms and Conditions"
                      }
                  }
              </script>

        </form>
      </div>
    </div>

</div>

</body>
</html>

<!-- jQuery -->
    <script src="assets/plugins/jQuery/jquery-3.2.1.min.js" type="text/javascript"></script>
    <!-- jquery-ui -->
    <script src="assets/plugins/jquery-ui-1.12.1/jquery-ui.min.js" type="text/javascript"></script>


    <script type="text/javascript">
      $(document).ready(function(){
          
          /*$('#myform').submit(function() {
              $('#btn_dsp').css('display', 'none');
              $('#pl_wt').css('display', 'block');
              var email_val = $('#email_val').val();
                $.ajax({
                  url: "check_register_email.php",
                  type: "post",
                  data: {check: "Yes", email_val: email_val},
                  success: function(response){  
                      //location.reload();
                      alert(response);
                      if(response.includes("ok")){
                          return true;                    
                      }else{
                          return false;
                      }
                      
                  }
                });
              return false; // return false to cancel form action
          });*/

          
      });
    </script>
