<?php
    session_start();
    include("../auth/validateauth.php");
    include("../models/conn.php");
    include("../auth/validateauth.php");
    include("../layout/headerhome.php");
    if($_SESSION['usertype']!="Admin")
    {
        header("location:logout.php");
    }

    if(isset($_GET['username']) && isset($_GET['status']))//check if admin approves or rejects 
    {
        echo "update users set status='".$_GET['status']."' where username='".$_GET['username']."' ";
        execute("update users set status='".$_GET['status']."', actionby='".$_SESSION['username']."' where username='".$_GET['username']."' ");

        header("location:pendingrequest.php");
    }

   
    $res=execute("select * from users where status='pending'");
    //print_r($row);
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pending Requests</title>
</head>
<body>
      <table border="1">
        <tr>
            <th>
                Username
            </th>
           <th>
                Usertype
           </th>
           <th>
                Firstname
           </th>
           <th>
                Lastname
           </th>
           <th>
                Registration Date
           </th>
           <th>
                Status
           </th>
           <th>Action</th>
        </tr>

        
            <?php

                while ($row = oci_fetch_array($res, OCI_ASSOC+OCI_RETURN_NULLS))
                {
                    echo ' <tr>
                        <td>'.$row['USERNAME'].'</td>
                        <td>'.$row['USERTYPE'].'</td>
                        <td>'.$row['FIRSTNAME'].'</td>
                        <td>'.$row['LASTNAME'].'</td>
                        <td>'.$row['REGISTERDATE'].'</td>
                        <td>'.$row['STATUS'].'</td>
                        <td>
                            <a href="pendingrequest.php?username='.$row['USERNAME'].'&status=valid">
                                Approve |
                            </a>
                            <a href="pendingrequest.php?username='.$row['USERNAME'].'&status=invalid">
                                Reject
                            </a>
                        </tr> ';
                }
            ?>
      </table>
</body>
</html>