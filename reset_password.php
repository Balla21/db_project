<?php
    $id_password = trim($_GET["id_password"]);
    var_dump($id_password);
    try{
        // connection to the server
        $connection = oci_connect ("gq047", "pkefhu", "gqiannew2:1521/pdborcl");      
    }catch(Exception $error){
        echo "cannot connect to the database";
        die();
    }

    try{
        $sql = "update project_user set password='*undefined*' where id='$id_password' ";
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