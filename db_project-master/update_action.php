<?php

    // update the information of the user
        $old_login = $_POST["old_user_id"];
        $update_login = $_POST["update_user_id"];
        $update_password = $_POST["update_user_password"];
        $update_type = $_POST["update_user_type"];
     
        try{
            // connection to the server
            $connection = oci_connect ("gq047", "pkefhu", "gqiannew2:1521/pdborcl");      
        }catch(Exception $error){
            echo "cannot connect to the database";
            die();
        }
    
        try{
            $sql = "update project_user set id='$update_login', password='$update_password' ";
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