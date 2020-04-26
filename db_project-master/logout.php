<?php
    // go back to the login page
    $_POST["user_login"] = "";
    $_POST["user_password"] = "";
    header("Location:index.php");
?>