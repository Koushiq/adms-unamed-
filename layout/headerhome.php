
<a href="/adms/bookstore/<?php echo $_SESSION['usertype'].".php" ?>">Home | </a>
<?php
    if($_SESSION['usertype']=="Admin")
    {
        echo '<a href="/adms/bookstore/admin/pendingrequest.php">Pending Requests | </a>';
        echo '<a href="/adms/bookstore/admin/approvedrequest.php">Approved Requests | </a>';
        echo '<a href="/adms/bookstore/admin/acitivtiy.php">General Activity | </a>';
        echo '<a href="/adms/bookstore/admin/regActivity.php">Registration Activity | </a>';
    }
?>
<a href="/adms/bookstore/logout.php">Logout</a>
