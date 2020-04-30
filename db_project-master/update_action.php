<?php

    // update the information of the user
        $old_login = $_POST["old_user_id"];
        $update_login = $_POST["update_user_id"];
        $update_password = $_POST["update_user_password"];
	$update_last_name = $_POST["update_user_last_name"];
	$update_first_name = $_POST["update_user_first_name"];
	$update_address = $_POST["update_user_address"];
	$update_city = $_POST["update_user_city"];
	$update_state = $_POST["update_user_state"];
	$update_zipcode = $_POST["update_user_zipcode"];
	$update_status = $_POST["update_user_status"];
	



        $update_type = $_POST["update_user_type"];
     
        try{
            // connection to the server
            $connection = oci_connect ("gq047", "pkefhu", "gqiannew2:1521/pdborcl");
        }catch(Exception $error){
            echo "cannot connect to the database";
            die();
        }

        try{
            $sql = "update project_user set id='$update_login', password='$update_password',user_stud_lname='$update_last_name',user_stud_fname='$update_first_name',user_stud_address='$update_address',user_stud_city='$update_city',user_stud_state='$update_state',user_stud_zipcode='$update_zipcode', user_stud_probation='$update_status'";
	    if($update_type == "student"){
                $sql .= ", student_user_type=1, admin_user_type=0 ";
            }
            else if($update_type == "admin"){
                $sql .= ", student_user_type=0, admin_user_type=1 ";
            }
            else if($update_type == "student-admin"){
                $sql .= ", student_user_type=1, admin_user_type=1 ";
            }
            $sql .= "where id='$old_login' ";

            
            $result = oci_parse($connection, $sql);
            $objConnect = oci_execute($result);
            oci_commit($objConnect);
            if($objConnect){
                header("Location:list_users.php");
            }
            var_dump($objConnect);
        }catch(Exception $error){
            echo "Query failed to execute";
        }


?>
