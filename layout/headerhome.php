
<a href="<?php echo $_SESSION['usertype'].".php" ?>">Home | </a>
<?php
    if($_SESSION['usertype']=="admin")
    {
        echo '<a href="admin/pendingrequest.php">Pending Requests | </a>';
    }
?>
<a href="logout.php">Logout</a>