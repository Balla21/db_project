<?php
    $user = $_GET["id"];
?>

<html>
    <head>
        <title>Student Admin User page</title> 
    </head>
    <body>
        <h3><u> Student-Administrator Page : <?php echo $user; ?></u></h3>
        <form method="post" action="logout.php">
            <p>Click here to logout <input type="submit" value="Log out"></p>
            <p>view student page : <a href="student_user.php?id=<?php  echo $user; ?>">student </a> </p>
            <p>view Administrator page : <a href="admin_user.php?id=<?php  echo $user; ?>">administrator </a> </p>

        </form>

        <p> Change <a href = " <?php echo 'password.php?id='. $user ; ?>  ">password</a></p>
    </body>
</html>