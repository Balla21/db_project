<?php 
    $userid = $_POST["user_login"];
    $userpassword = $_POST["user_password"];

    try{
        // connection to the server
        $connection = oci_connect ("gq047", "pkefhu", "gqiannew2:1521/pdborcl");      
    }catch(Exception $error){
        echo "cannot connect to the database";
        die();
    }

    try{
             
        // sql query
        $sql = "select id, student_user_type, admin_user_type " .
                "from project_user " .
                "where id='$userid' AND password='$userpassword' ";  
        $result = oci_parse($connection, $sql);
        oci_execute($result);
        $row = oci_fetch_assoc($result);
    }

    catch(Exception $error){
        echo "Query failed to execute";
    }

    // the user is a student
    if($row["STUDENT_USER_TYPE"] == "1" && $row["ADMIN_USER_TYPE"] == "0"){
        header("Location:student_user.php?id=$userid");
    }
    else if ($row["STUDENT_USER_TYPE"] == "0" && $row["ADMIN_USER_TYPE"] == "1"){
        header("Location:admin_user.php?id=$userid");
    }
    else if($row["STUDENT_USER_TYPE"] == "1" && $row["ADMIN_USER_TYPE"] == "1"){
        header("Location:student_admin_user.php?id=$userid");
    }
    else{
        header("Location:index.php");
    }

?>