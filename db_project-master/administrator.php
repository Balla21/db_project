<?
include "utilityFunctions.php";

$sessionid =$_GET["sessionid"];
verify_session($sessionid);


// Generate the query section

echo("
  <form method=\"post\" action=\"administrator.php?sessionid=$sessionid\">
  ID: <input type=\"number\" size=\"5\" maxlength=\"5\" name=\"q_id\">
  First Name: <input type=\"text\" size=\"20\" maxlength=\"50\" name=\"q_fname\">
  Last Name: <input type=\"text\" size=\"20\" maxlength=\"100\" name=\"q_lname\">
  Address: <input type=\"text\" size=\"20\" maxlength=\"100\" name=\"q_address\">
  Type: <input type=\"text\" size=\"20\" maxlength=\"100\" name=\"q_type\">
  <input type=\"submit\" value=\"Search\">
  </form>

  <form method=\"post\" action=\"admin_welcomepage.php?sessionid=$sessionid\">
  <input type=\"submit\" value=\"Go Back\">
  </form>

  <form method=\"post\" action=\"usr_add.php?sessionid=$sessionid\">
  <input type=\"submit\" value=\"Add A New User\">
  </form>
");



// Interpret the query requirements
$q_id = $_POST["q_id"];
$q_fname = $_POST["q_fname"];
$q_lname = $_POST["q_lname"];
$q_address = $_POST["q_address"];
$q_type = $_POST["q_type"];

$whereClause = " 1=1 ";

if (isset($q_id) and trim($q_id)!= "") {
  $whereClause .= " and id = $q_id";
}

if (isset($q_fname) and $q_fname!= "") {
  $whereClause .= " and fname like '%$q_fname%'";
}

if (isset($q_lname) and $q_lname!= "") {
  $whereClause .= " and lname like '%$q_lname%'";
}

if (isset($q_address) and $q_address!= "") {
  $whereClause .= " and address like '%$q_address%'";
}

if (isset($q_type) and $q_type!= "") {
  $whereClause .= " and type like '%$q_type%'";
}


// Form the query and execute it
$sql = "select id, fname, lname, address, type from usr where $whereClause order by id";
//echo($sql);

$result_array = execute_sql_in_oracle ($sql);
$result = $result_array["flag"];
$cursor = $result_array["cursor"];

if ($result == false){
  display_oracle_error_message($cursor);
  die("Client Query Failed.");
}


// Display the query results
echo "<table border=1>";
echo "<tr> <th>ID</th> <th>First Name</th> <th>Last Name</th>  <th>Address</th> <th>Type</th> <th>Update</th> <th>Delete</th></tr>";

// Fetch the result from the cursor one by one
while ($values = oci_fetch_array ($cursor)){
  $id = $values[0];
  $fname = $values[1];
  $lname = $values[2];
  $address = $values[3];
  $type = $values[4];
  echo("<tr>" .
    "<td>$id</td> <td>$fname</td> <td>$lname</td> <td>$address</td> <td>$type</td>".
    " <td> <A HREF=\"usr_update.php?sessionid=$sessionid&id=$id\">Update</A> </td> ".
    " <td> <A HREF=\"usr_delete.php?sessionid=$sessionid&id=$id\">Delete</A> </td> ".
    "</tr>");
}

oci_free_statement($cursor);

echo "</table>";
?>
