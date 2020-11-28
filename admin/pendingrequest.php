<?php
    session_start();
    include("../auth/validateauth.php");
    if($_SESSION['usertype']!="admin")
    {
        header("location:logout.php");
    }

    if(isset($_GET['username']) && isset($_GET['status']) && ($_GET['status']=='valid' || $_GET['status']=='rejected' ) )//check if admin approves or rejects 
    {
        execute("update users set status=".$_GET['status']." where username=".$_GET['username']." ");
    }

    include("../models/conn.php");
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
                    echo " <tr>
                        <td>".$row['USERNAME']."</td>
                        <td>".$row['USERTYPE']."</td>
                        <td>".$row['FIRSTNAME']."</td>
                        <td>".$row['LASTNAME']."</td>
                        <td>".$row['REGISTEREDAT']."</td>
                        <td>".$row['STATUS']."</td>
                        <td><a href=".'pendingrequest.php?username="'.$row["USERNAME"].'"&status="valid"'.">Approve</a> | <a href=".'pendingrequest.php?username="'.$row["USERNAME"].'"&status="rejected"'.">Reject</a></td>
                    </tr> ";
                }
            ?>
           
        
      
    
      </table>
</body>
</html>