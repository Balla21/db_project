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
        <title>Student User page</title> 

        <style>
            table, th, td {
             border: 1px solid black;
            }
        </style>
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



    <!-- display section courses taken by student -->   
        
       <h3><u> Student Section Information </u></h3>
       <?php
            $student_id = $row["USER_STUD_ID"];
            
            try{
                // connection to the server
                $connection = oci_connect ("gq047", "pkefhu", "gqiannew2:1521/pdborcl");
            }catch(Exception $error){
                echo "cannot connect to the database";
                die();
            }

            $sql_stud_section = "select * from enroll";
            $sql_stud_section .= " join project_user on project_user.user_stud_id  = enroll.enr_stud_id";
            $sql_stud_section .= " join crse_section on crse_section.sect_id = enroll.enr_sect_id";
            $sql_stud_section .= " join course on course.crse_numb = crse_section.sect_crse_numb";
            $sql_stud_section .= " where enr_stud_id = '$student_id' "; 

            try{       
                // sql query 
                $result_stud_section = oci_parse($connection, $sql_stud_section);
                oci_execute($result_stud_section);
            }
            catch(Exception $error){
                echo "Query failed to execute";
            }
        
            
       ?>

       <table>  
            <tr>
                <td>section</td>
                <td>course #</td>
                <td>title </td>
                <td>Semester</td>
                <td>Year</td>
                <td>credits #</td>
                <td>Grade</td>
		        <td>Completion Status</td>
            </tr>

                  
            <?php
                $sum_course_credit = 0;
                $grade = 0;
                $total_courses = 0;
                $total_hours = 0;
                while ( ($row_stud_sect = oci_fetch_assoc($result_stud_section) ) != false)  {
                  if( ($row_stud_sect["ENR_COMPLETION"])  ==  1){  
		            $total_courses += 1;
                    $total_hours += intval($row_stud_sect["CREDIT_HRS"]);
                    if ( strtolower($row_stud_sect["ENR_GRADE"])  == 'a'){
                        $grade = 4.0;
                    }
                    else if ( strtolower($row_stud_sect["ENR_GRADE"])  == 'b' ){
                        $grade = 3.0;
                    }
                    else if ( strtolower($row_stud_sect["ENR_GRADE"])  == 'c' ){
                        $grade = 2.0;
                    }
                    else if ( strtolower($row_stud_sect["ENR_GRADE"])  == 'd' ){
                        $grade = 1.0;
                    }
                    else{
                        $grade = 0.0;
                    }
                    
                    $sum_course_credit += ($grade * intval($row_stud_sect["CREDIT_HRS"]) );
		  }

            ?>

            <tr>
                <td><?php echo $row_stud_sect["ENR_SECT_ID"]; ?> </td>
                <td><?php echo $row_stud_sect["SECT_CRSE_NUMB"]; ?> </td>
                <td><?php echo $row_stud_sect["TITLE"]; ?> </td>
                <td><?php echo $row_stud_sect["SECT_SEMESTER"]; ?> </td>
		        <td><?php echo $row_stud_sect["SECT_YEAR"]; ?> </td>
                <td><?php echo $row_stud_sect["CREDIT_HRS"]; ?> </td>
                <td><?php echo $row_stud_sect["ENR_GRADE"]; ?> </td>
                <td><?php 
                	  if( $row_stud_sect["ENR_COMPLETION"] != 1) echo "In progress";
                	  else  echo "Completed";
            	?> </td>

            </tr>
                    

            <?php } ?> 
       </table>

       <p> total number of courses completed: <?php echo $total_courses; ?>  </p>
       <p> total number of hours earned: <?php echo $total_hours; ?>  </p>
       <p> Average Gpa : <?php
            $gpa = $sum_course_credit / $total_hours;
            echo  $gpa; ?>  
       </p>


    <!-- General section information -->
    <p><a href=" <?php  echo "general_section.php?id=". $user ; ?>  "> General Section information</a></p>

    <!-- Enrollment section information -->
    <p><a href=" <?php  echo "enrollment_section.php?id=". $user ; ?>  "> Enrollment Section </a></p>



    </body>
</html>
