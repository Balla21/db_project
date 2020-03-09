<?php 
    $user=trim($_GET["id"]);
    $new_user_id = trim($_POST["new_user_id"]);
    $new_user_password = trim($_POST["new_user_password"]);
    $new_user_type = trim($_POST["new_user_type"]);

    try{
        // connection to the server
        $connection = oci_connect ("gq047", "pkefhu", "gqiannew2:1521/pdborcl");      
    }catch(Exception $error){
        echo "cannot connect to the database";
        die();
    }

    try{
        $sql = "insert into project_user ";
        if($new_user_type == "student"){
           $sql .= "values('$new_user_id', '$new_user_password', 1,1,0 )" ; 
        }
        else if($new_user_type == "admin"){
            $sql .= "values('$new_user_id', '$new_user_password', 1,0,1 )" ; 
        }
        
        else if($new_user_type == "student-admin"){
            $sql .= "values('$new_user_id', '$new_user_password', 1,1,1 )" ; 
        }
        $result = oci_parse($connection, $sql);
        $objConnect = oci_execute($result);
        oci_commit($objConnect); 
        if($objConnect){
            $location = "list_users.php?id=$user";
            header("Location:$location");
        }
    }catch(Exception $error){
        echo "Query failed to execute";
    }

?>


<html>
    <head>
        <title>Add User</title>
    </head>
    <body>
        <form method="post" action="logout.php">
            <p>Click here <input type="submit" value="Log out"></p>
        </form>
        <h3>Add a User </h3>
        <form method="post" action="add_user.php">
            <p>
                <label>user login : </label><input type="text" name="new_user_id" />
            </p>
            <p>
                <label>user password : </label><input type="password" name="new_user_password" />
            </p>
            <p>
                <label>user type : </label> 
                <select name="new_user_type">
                    <option></option>
                    <option value="student">Student</option>
                    <option value="admin">Administrator</option>
                    <option value="student-admin"> Student - Administrator</option>
                </select>
            </p>
            <p> <input type="submit"  value="Register"/>  </p>
        </form>
    </body>

</html>