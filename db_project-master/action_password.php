<?php
    $id = trim($_POST["id"]);
    $new_password = trim($_POST["new_password"]);

    var_dump($id);
    var_dump($new_password);

    try{
        // connection to the server
        $connection = oci_connect ("gq047", "pkefhu", "gqiannew2:1521/pdborcl");      
    }catch(Exception $error){
        echo "cannot connect to the database";
        die();
    }

    try{
        $sql = "update project_user set password='$new_password' where id='$id' ";
        $result = oci_parse($connection, $sql);
        $objConnect = oci_execute($result);
        oci_commit($objConnect);
        if($objConnect){
            header("Location:index.php");
        }
        var_dump($objConnect);
    }catch(Exception $error){
        echo "Query failed to execute";
    }


?>
