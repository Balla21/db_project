<?php
    // get the id
    $user = $_GET["id"];

    //get all the sections per courses
    try{
        // connection to the server
        $connection = oci_connect ("gq047", "pkefhu", "gqiannew2:1521/pdborcl");      
    }catch(Exception $error){
        echo "cannot connect to the database";
        die();
    }

    $sql_course = "select * from crse_section join course on crse_section.sect_crse_numb = course.crse_numb";

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
        <title>General section Information</title>

        <style>
            table, th, td {
             border: 1px solid black;
            }
        </style>
    </head>

    <body>
        <h3><u> General Section </u> </h3>
        <table>
            <tr>
                <th>Section id</th>
                <th>Course #</th>
                <th>Course title</th>
                <th>Course description</th>
                <th>Credits # </th>
                <th>Semester </th>
                <th>Year </th>
                <th>Time </th>
                <th>Enrollment deadline </th>
            </tr>

            <?php
                while ( ($row_section = oci_fetch_assoc($result) ) != false)  {
                //var_dump($row_section);
            ?>
            <tr>
                <td> <?php echo $row_section["SECT_ID"]; ?> </td>
                <td> <?php echo $row_section["CRSE_NUMB"]; ?> </td>
                <td> <?php echo $row_section["TITLE"]; ?> </td>
                <td> <?php echo $row_section["DESCRIPTION"]; ?> </td>
                <td> <?php echo $row_section["CREDIT_HRS"]; ?> </td>
                <td> <?php echo $row_section["SECT_SEMESTER"]; ?> </td>
                <td> <?php echo $row_section["SECT_YEAR"]; ?> </td>
                <td> <?php echo $row_section["SECT_TIME"]; ?> </td>
                <td> <?php echo $row_section["SECT_DEADLINE"]; ?> </td>
            </tr>
             <?php }  ?>

        </table>
    
    
    </body>



</html>