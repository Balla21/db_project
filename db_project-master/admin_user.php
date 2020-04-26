<?php
    $user = trim($_GET["id"]);
?>

<html>
    <head>
        <title>Admin User page</title> 
    </head>
    <body>
        <h3><u> Administrator User Page </h3>
        <p> Change <a href = " <?php echo 'password.php?id='. $user ; ?>  ">password</a></p>
        <form method="post" action="logout.php">
            <p>Click here <input type="submit" value="Log out"></p>
        </form>
        <p><a href="add_user.php?id=<?php  echo $user; ?>"> add user </a></p>
        <p><a href="list_users.php?id=<?php  echo $user; ?>"> list of users </a></p>
 
    </body>
</html>