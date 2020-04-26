<?php 
    $enrolled_section = false;
    $user = trim($_GET["id_student"]);
    $course_title = trim($_GET["title_section"]);
    $sect_id = trim($_GET["id_section"]);
   

    // get the student id of the user
    try{
        // connection to the server
        $connection = oci_connect ("gq047", "pkefhu", "gqiannew2:1521/pdborcl");      
    }catch(Exception $error){
        echo "cannot connect to the database";
        die();
    }
    $sql_student_id = "select user_stud_id from project_user where id = '$user'";
    try{       
        // sql query 
        $result = oci_parse($connection, $sql_student_id);
        oci_execute($result);
    }
    catch(Exception $error){
        echo "Query failed to execute";
    }
    $row = oci_fetch_assoc($result);
    $student_id = $row["USER_STUD_ID"];
    

    //verify if student is already enrolled
    $sql_enrolled_student = "select * from enroll where enr_stud_id = '$student_id' and enr_sect_id='$sect_id'";
/*
    $sql_enrolled_student = "select * from enroll";
    $sql_enrolled_student .= " join project_user on project_user.user_stud_id  = enroll.enr_stud_id";
    $sql_enrolled_student .= " join crse_section on crse_section.sect_id = enroll.enr_sect_id";
    $sql_enrolled_student .= " join course on course.crse_numb = crse_section.sect_crse_numb";
    $sql_enrolled_student .= " where enr_stud_id = '$student_id' and enr_sect_id='$sect_id' ";
*/
    try{       
        // sql query 
        $result_enrolled_student= oci_parse($connection, $sql_enrolled_student);
        oci_execute($result_enrolled_student);
    }
    catch(Exception $error){
        echo "Query failed to execute";
    }
    $row_enrolled_student = oci_fetch_assoc($result_enrolled_student);

    if($row_enrolled_student != false){
        //student is already enrolled in this section
        if( isset($row_enrolled_student["ENR_STUD_ID"])  || isset($row_enrolled_student["ENR_STUD_ID"])){ 
            $enrolled_section = true;
            header("location:student_user.php?id=$user");
        }
    }
    
    //student not enrolled in section
    else{
        try {
            $sql_insert = "insert into enroll values ('$student_id','$sect_id','IP','05-01-2020')";
            $result_insert = oci_parse($connection, $sql_insert);
            $objConnect = oci_execute($result_insert);
            oci_commit($objConnect); 
            if($objConnect){
                $location = "student_user.php?id=$user";
                header("location:$location");
            }
        }
        catch(Exception $error){
            echo "Query failed to execute";
        }
        
    }
    
?>