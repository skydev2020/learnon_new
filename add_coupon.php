<?php
	  @ob_start();
	session_start();
	include("configs.php");
	if( $_POST["save"] ) {

	   $c_name_val = $_POST['c_name_val'];
	   $c_code_val = $_POST['c_code_val'];
	   $c_disc_val = $_POST['c_disc_val'];
	   $start_date_val = $_POST['start_date_val'];
	   $end_date_val = $_POST['end_date_val'];
	   $status_value = $_POST['status_value'];

       $qq = mysqli_query($db, "INSERT INTO coupon(coupon_name, coupon_code, discount, start_date, end_date, status) VALUES('$c_name_val', '$c_code_val', '$c_disc_val', '$start_date_val', '$end_date_val', '$status_value')");
       if($qq){
       		echo "done";
       }else{
       		echo mysqli_error($db);
       }
	  

	}else{
		echo "rest";
	}

?>