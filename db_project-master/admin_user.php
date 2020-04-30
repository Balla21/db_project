<?php
    $user = $_GET["id"];
    try{
        // connection to the server
        $connection = oci_connect ("gq047", "pkefhu", "gqiannew2:1521/pdborcl");
    }catch(Exception $error){
        echo "cannot connect to the database";
        die();
    }

    $sql = "select * from project_user where id='$user'";

    try{
        // sql query 
        $result = oci_parse($connection, $sql);
        oci_execute($result);
    }
    catch(Exception $error){
        echo "Query failed to execute";
    }
    $row = oci_fetch_assoc($result);
    //var_dump($row);
?>

<html>
    <head>
        <title>Admin User page</title> 
    </head>
    <body>
        <h3><u> Administrator User Page: Update for Part 2 </h3>
        <form method="post" action="logout.php">
            <p>Click here to logout : <input type="submit" value="Log out"></p>
        </form>

	<p> Change <a href = " <?php echo 'password.php?id='. $user ; ?>  ">password</a></p>
        <p><a href="add_user.php?id=<?php  echo $user; ?>"> add user </a></p>
        <p><a href="list_users.php?id=<?php  echo $user; ?>"> list of users </a></p>
 
    </body>
</html>
