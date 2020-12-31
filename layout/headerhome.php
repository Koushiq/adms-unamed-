
<a href="/adms/bookstore/<?php echo $_SESSION['usertype'].".php" ?>">Home | </a>
<?php
    if($_SESSION['usertype']=="Admin")
    {
        echo '<a href="/adms/bookstore/admin/pendingrequest.php">Pending Requests | </a>';
    }
?>
<a href="/adms/bookstore/logout.php">Logout</a>
