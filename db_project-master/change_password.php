<?php
    $user_connected = $_GET["id"];

    // get user info
    try{
        // connection to the server
        $connection = oci_connect ("gq047", "pkefhu", "gqiannew2:1521/pdborcl");      
    }catch(Exception $error){
        echo "cannot connect to the database";
        die();
    }

    try{
             
        // sql query
        $sql = "select id, password" .
                "from project_user " .
                "where id='$user_connected'";  
        $result = oci_parse($connection, $sql);
        oci_execute($result);
        $row = oci_fetch_assoc($result);
        var_dump($row);   
    }
    catch(Exception $error){
        echo "Query failed to execute";
    }

?>

<html>
<head>
    <title>Password change Form</title>
</head>

<body>
    <h3><u>Login Form</u></h3>
    <form method="post" action="logout.php">
            <p>Click here to logout : <input type="submit" value="Log out"></p>
        </form>
    <form method="post" action="change_password.php">
        <p>
            <label>Login : </label><input type="text" name="user_login" value=" <?php echo $row['id']; ?> " />
        </p>

        <p>
            <label>password : </label><input type="password" name="user_password" />
        </p>

        <p>
            <label>password : </label><input type="password" name="user_password" />
        </p>
        <p> <input type="submit"  value="send"/>  </p>
    </form>
    
</body>

</html>