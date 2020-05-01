<?php

    // update the information of the user
        $student_id = $_POST["student_id"];
	$section_id = $_POST["section_id"];

        $update_student_grade = $_POST["update_student_grade"];

        try{
            // connection to the server
            $connection = oci_connect ("gq047", "pkefhu", "gqiannew2:1521/pdborcl");
        }catch(Exception $error){
            echo "cannot connect to the database";
            die();
        }

        try{
           $sql = "update enroll set enr_grade='$update_student_grade', enr_completion=1 where enr_stud_id='$student_id' AND enr_sect_id='$section_id'";

            $result = oci_parse($connection, $sql);
            $objConnect = oci_execute($result);
            oci_commit($objConnect);
            if($objConnect){
                header("Location:update_grade.php");
            }
            var_dump($objConnect);
        }catch(Exception $error){
            echo "Query failed to execute";
        }


?>


