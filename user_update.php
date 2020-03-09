<?php
    $user_id_update = $_GET["id"];
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
                    "where id='$user_id_update'";  
            $result = oci_parse($connection, $sql);
            oci_execute($result);
            $row = oci_fetch_assoc($result); 
        }
        catch(Exception $error){
            echo "Query failed to execute";
        }

        if($row["STUDENT_USER_TYPE"] == "1" && $row["ADMIN_USER_TYPE"] == "0"){
            $user_type = "student";
        }
        else if ($row["STUDENT_USER_TYPE"] == "0" && $row["ADMIN_USER_TYPE"] == "1"){
            $user_type = "admin";
        }
        else if($row["STUDENT_USER_TYPE"] == "1" && $row["ADMIN_USER_TYPE"] == "1"){
            $user_type = "stud-admin";
        }
?>
   <html>
    <head>
        <title>Update user information</title>
    </head>
    <body>
        <form method="post" action="logout.php">
            <p>Click here <input type="submit" value="Log out"></p>
        </form>
        <h3>Add a User </h3>
        <form method="post" action="update_action.php">
            <input type="hidden" name="old_user_id" value="<?php echo $user_id_update; ?>"/>
            <p>
                <label>user login : </label><input type="text" name="update_user_id" value="<?php echo $row["ID"]; ?>"  />
            </p>
            <p>
                <label>user password : </label><input type="text" name="update_user_password" value="<?php echo $row["PASSWORD"]; ?>"/>
            </p>
            <p>
                <label>user type : </label> 

                <select name="update_user_type"   >
                   
                    <option value="student" <?php if ($user_type=="student") echo "selected"; ?>  >Student</option>
                    <option value="admin"   <?php if ($user_type=="admin") echo "selected"; ?>  >Administrator</option>
                    <option value="student-admin"  <?php if ($user_type=="stud-admin") echo "selected"; ?>  > Student - Administrator</option>
                </select>
            </p>
            <p> <input type="submit"  value="update"/>  </p>
        </form>
    </body>

</html>