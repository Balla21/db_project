<?php
    $student_id_update = $_GET["id"];
    $section_id_update = $_GET["sec"];
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
                    "from enroll " .
                    "where ern_stud_id='$student_id_update' AND ern_sect_id='$section_id_update'";
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
        <title>Update user information</title>
    </head>
    <body>
        <form method="post" action="logout.php">
            <p>Click here <input type="submit" value="Log out"></p>
        </form>
        <h3> Grade for Student <?php echo $student_id_update; ?> | Section <?php echo $section_id_update;?>:   </h3>
        <form method="post" action="update_grade_action.php">
            <input type="hidden" name="student_id" value="<?php echo $student_id_update; ?>"/>
            <input type="hidden" name="section_id" value="<?php echo $section_id_update; ?>"/>
                <select name="update_student_grade"  >
                    <option value="A" >A</option>
                    <option value="B" >B</option>
                    <option value="C" >C</option>
                    <option value="D" >D</option>
                    <option value="F" >F</option>
		</select>
            </p>
            <p> <input type="submit"  value="update"/>  </p>
        </form>
    </body>

</html>

