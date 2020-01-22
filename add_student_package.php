<?php

session_start();
    if ($_POST["save"] ) {
        include("configs.php");

        

       
       $status_value = $_POST['status_value'];
       $p_name_val = $_POST['p_name_val'];
       $p_desc_val = $_POST['p_desc_val'];
       $hour_val = $_POST['hour_val'];
       $usa_price = $_POST['usa_price'];
       $canada_price = $_POST['canada_price'];
       $other_price = $_POST['other_price'];





       $qq = mysqli_query($db, "INSERT INTO student_packages(package_name, package_description, price_canada, price_usa, price_others, hours, status, count) VALUES('$p_name_val', '$p_desc_val', '$canada_price', '$usa_price', '$other_price', '$hour_val', '$status_value', 0)");


       $qq = mysqli_query($db, "UPDATE student_packages SET package_name = '$p_name_val', package_description = '$p_desc_val', price_canada = '$canada_price', price_usa = '$usa_price', price_others = '$other_price', hours = '$hour_val', status = '$status_value' WHERE package_id = '$id'");
       if($qq){
            echo "done";
       }else{
            echo "problem entereing to database";
       }


    }else{

         //header("Location: logout.php?logout");
        echo "not authorised";
    }

?>

