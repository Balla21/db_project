<?php
    $user_connected = trim($_GET["id"]);
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
        $sql = "select *" .
                "from project_user " .
                "where id='$user_connected'";  
        $result = oci_parse($connection, $sql);
        oci_execute($result);
        $row = oci_fetch_assoc($result); 
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
    <form method="post" action="action_password.php">
        <p>
            <label>Login : </label><input type="text" name="id" value=" <?php echo $row['ID']; ?> " />
        </p>


        <p>
            <label>old password : </label><input type="password" name="old_password" value=" <?php echo $row['PASSWORD']; ?> "/>
        </p>

        <p>
            <label> new password : </label><input type="password" name="new_password" />
        </p>
        <p> <input type="submit"  value="change"/>  </p>
    </form>
    
</body>

</html>