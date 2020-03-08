<?php
    $user = $_GET["id"];
?>

<html>
    <head>
        <title>Student User page</title> 
    </head>
    <body>
        <h3><u> Student Page : <?php echo $user; ?></u></h3>
        <form method="post" action="logout.php">
            <p>Click here to logout : <input type="submit" value="Log out"></p>
        </form>

       <p> Change <a href = " <?php echo 'password.php?id='. $user ; ?>  ">password</a></p>
       
    </body>
</html>