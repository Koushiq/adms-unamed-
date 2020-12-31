<?php
    session_start();
    include("layout/headerhome.php");
    include("auth/validateauth.php");
    include("models/customer.php");
    echo ' <h1>Welcome '. $_SESSION["username"].'</h1>';

?>