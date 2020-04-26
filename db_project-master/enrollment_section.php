<?php 
    $user = $_GET["id"];

    //course number to search
    $crse_numb_search = trim($_POST["crse_numb_search"]);


    //get all the sections per courses
     try{
        // connection to the server
    $connection = oci_connect ("gq047", "pkefhu", "gqiannew2:1521/pdborcl");    
    }catch(Exception $error){
        echo "cannot connect to the database";
        die();
    }

    if($crse_numb_search == NULL || $crse_numb_search == ""){
        $sql_course = "select * from crse_section join course on crse_section.sect_crse_numb = course.crse_numb";
    }
    
    else if(isset($crse_numb_search) && $crse_numb_search != NULL){
        $sql_course = "select * from crse_section join course on crse_section.sect_crse_numb = course.crse_numb";
        $sql_course .= " where course.crse_numb = '$crse_numb_search'";
    }


    try{       
        // sql query 
        $result = oci_parse($connection, $sql_course);
        oci_execute($result);
    }
    catch(Exception $error){
        echo "Query failed to execute";
    }
?>

<html>
    <head>
        <title> Section Information</title>

        <style>
            table, th, td {
                border: 1px solid black;
            }
        </style>
    </head>


    <body>

        <h3><u> Sections </u> </h3>
        
        <!-- Search for course number -->
        <form method="post" action=" <?php echo "enrollment_section.php?id=".$user; ?>">
                <p> 
                    <label>Search sections for a course number </label>
                    <input type="text" name="crse_numb_search" /> 
                    <input type="submit" value="search"/>
                
                </p>
        </form>

        <!-- list all sections -->        
            <table>
                <tr>
                    <th>Section id</th>
                    <th>Course #</th>
                    <th>Course title</th>
                    <th>Credits # </th>
                    <th>Semester </th>
                    <th>Year </th>
                    <th>Time </th>

                    <th>Max Seats</th>
                    <th>Seats available</th>
                    <th>Enrollment deadline </th>
                </tr>

                <?php
                    while ( ($row_section = oci_fetch_assoc($result) ) != false)  {
                ?>
                <tr>
                    <td> <?php echo $row_section["SECT_ID"]; ?> </td>
                    <td> <?php echo $row_section["CRSE_NUMB"]; ?> </td>
                    <td> <?php echo $row_section["TITLE"]; ?> </td>
                    <td> <?php echo $row_section["CREDIT_HRS"]; ?> </td>
                    <td> <?php echo $row_section["SECT_SEMESTER"]; ?> </td>
                    <td> <?php echo $row_section["SECT_YEAR"]; ?> </td>
                    <td> <?php echo $row_section["SECT_TIME"]; ?> </td>

                    <td> <?php echo $row_section["SECT_MAX_STUD"]; ?> </td>
                    <td> <?php
                        $seats_remaining =  intval($row_section["SECT_MAX_STUD"]) - intval($row_section["SECT_NUM_STUDENT"]) ;
                        echo $seats_remaining; 
                    
                    ?> </td>
                    <td> <?php echo $row_section["SECT_DEADLINE"]; ?> </td>
                    
                    <!-- Button for enrolling into a section -->
                    <td>
                            <form method="get" action="enroll.php" >
                                <input type="hidden" name="id_student" value="<?php echo $user; ?>">
                                <input type="text" name="id_section" value="<?php echo $row_section["SECT_ID"]; ?>">
                                <input type="text" name="title_section" value="<?php echo $row_section["TITLE"]; ?>">
                                <input type="submit" value="Enroll"/>
                            </form> 
                        </td>
                </tr>
                <?php }  ?>

            </table>
        
        
    </body>

</html>
