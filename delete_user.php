<?php
    $user_id_delete = trim($_GET["id_delete"]);
    try{
        // connection to the server
        $connection = oci_connect ("gq047", "pkefhu", "gqiannew2:1521/pdborcl");      
    }catch(Exception $error){
        echo "cannot connect to the database";
        die();
    }

    try{
        $sql = "delete from project_user where id='$user_id_delete' ";
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