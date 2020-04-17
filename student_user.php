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
    var_dump($row);
?>

<html>
    <head>
        <title>Student User page</title> 
    </head>
    <body>
        <h3><u> Student Page : <?php echo $user; ?></u></h3>
        <form method="post" action="logout.php">
            <p>Click here to logout : <input type="submit" value="Log out"></p>
        </form>

       <p> Change <a href = " <?php echo 'password.php?id='. $user ; ?>  ">password</a></p>
        
        <!-- display student information -->
       <p>student id : <?php echo $row["USER_STUD_ID"]; ?> </p>
       <p> <b>Name :</b> <?php echo $row["USER_STUD_LNAME"] .', '.$row["USER_STUD_FNAME"]  ; ?> </p>
       <p> <b>Age :</b> <?php echo $row["USER_STUD_AGE"]; ?> </p>
       <p>  <b>Address :</b> <?php echo  $row["USER_STUD_ADDRESS"] .', '. $row["USER_STUD_CITY"] .', '.$row["USER_STUD_STATE"].', '.$row["USER_STUD_ZIPCODE"]  ; ?> </p>
       <p> <b>Type :</b> 
            <?php
                if( $row["USER_STUD_TYPE"] == 1) echo "Undergraduate";
                else if($row["USER_STUD_TYPE"] == 2) echo "Graduate";
            ?>
       </p>
       <p><b>Status (probation/ no probation):</b> 
            <?php
                if( $row["USER_STUD_PROBATION"] == 0) echo "No probation";
                else if($row["USER_STUD_PROBATION"] == 1) echo "Probation";
            ?>
       </p>
       
    </body>
</html>