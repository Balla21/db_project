<?php
    $login_search = $_POST["login_search"];  

    try{
        // connection to the server
        $connection = oci_connect ("gq047", "pkefhu", "gqiannew2:1521/pdborcl");      
    }catch(Exception $error){
        echo "cannot connect to the database";
        die();
    }
   

    if($login_search == NULL || $login_search == ""){
        $sql .= "select * from project_user";
    }
    
    else if(isset($login_search) && $login_search != NULL){
        $sql .= "select * from project_user where id='$login_search'";
    }

    try{       
        // sql query 
        $result = oci_parse($connection, $sql);
        oci_execute($result);
    }

    catch(Exception $error){
        echo "Query failed to execute";
    }
?>

<html>
    <head>
        <title>Admin User page</title> 
    </head>
    <body>
        <form method="post" action="logout.php">
            <p>Click here <input type="submit" value="Log out"></p>
        </form>

        <p><a href="admin_user.php">back to Administrator page</a></p>
        <h3><u> List of users : <?php echo $user; ?></u></h3>

        <form method="post" action="list_users.php">
            <p> 
                <label>Search login</label>
                <input type="text" name="login_search" /> 
                <input type="submit" value="search"/>
            
             </p>
        </form>

        <br/>

        <p> List of users (username / password)</p>
        <table>      
            <?php while (($row = oci_fetch_assoc($result)) != false)  { ?>
                <tr> 
                        <td></td>
                        <td> <?php  echo $row["ID"]; ?> </span>
                        <td> / <?php  echo $row["PASSWORD"]; ?> </span>
                        <td>
                            <p>
                                <a href="user_update.php?id=<?php echo $row["ID"]; ?>">
                                <input type="submit" value="update"/></a>
                            </p>
                        </td>

                        <td>
                            <form method="get" action="delete_user.php" >
                                <input type="hidden" name="id_delete" value="<?php echo $row["ID"]; ?>">
                                <input type="submit" value="Delete"/>
                            </form> 
                        </td>
                        <td>
                            <form method="get" action="reset_password.php" >
                                <input type="hidden" name="id_password" value="<?php echo $row["ID"]; ?>">
                                <input type="submit" value="reset password"/>
                            </form>
                        </td> 
                        
                  
                </tr>
            <?php } ?>              
        </table>      
    </body>
</html>