<?php
    $student_search = $_POST["student_ID"];
    $section_search = $_POST["section"];

    try{
        // connection to the server
        $connection = oci_connect ("gq047", "pkefhu", "gqiannew2:1521/pdborcl");
    }catch(Exception $error){
        echo "cannot connect to the database";
        die();
    }


    if($section_search == NULL || $section_search == "" || $student_search == NULL ||  $student_search == ""){
        $sql .= "select * from enroll";
    }else {
	$sql .= "select * " .
		"from enroll " .
		"where enr_stud_id LIKE '%$student_search%' AND enr_sect_id LIKE '%$section_search%'";
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
        <h3><u> List of students : <?php echo $user; ?></u></h3>

        <form method="post" action="update_grade.php">
            <p>
                <label>Search </label>
                <input type="text" name="student_ID" /> 
		<input type="text" name="section" />
                <input type="submit" value="find"/>
             </p>
        </form>

        <br/>

        <p> List of users (ID / section)</p>
        <table>
            <?php while (($row = oci_fetch_assoc($result)) != false)  { ?>
		<tr>
                        <td></td>
                        <td> <?php  echo $row["ENR_STUD_ID"]; ?> </span>
                        <td> | <?php  echo $row["ENR_SECT_ID"]; ?> </span>
			<td>
                            <p>
                                <a href="update_enroll.php?id=<?php echo $row["ENR_STUD_ID"]; ?>&amp;sec=<?php echo $row["ENR_SECT_ID"]; ?>">
                                <input type="submit" value="update"/></a>
                            </p>
                        </td>
                </tr>
            <?php } ?>
        </table>
    </body>
</html>
