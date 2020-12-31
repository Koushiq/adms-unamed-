<?php
    include ("models/conn.php");
    $registrationErr="";
    $flag= false;
    if(isset($_POST['submit']))
    {
        foreach($_POST as $value)
        {
            if(empty($value))
            {
                $flag=true;
                break;
            }
            
        }
        if($flag==false)
        {
            if($_POST["password"]!=$_POST["confirmpassword"])
            {
                $flag=true;
                $registrationErr="password doesn't match!";
            }
        }
        else
        {
            $registrationErr="all fields are not set";
        }

        if(!$flag)
        {
            $rowCount=get(execute("select * from users where username='".$_POST['username']."' "));
            if(empty($rowCount))
            {
                $sql= "insert into users values ('".$_POST['username']."','Customer','".$_POST['firstname']."','".$_POST['lastname']."','".$_POST['password']."', TO_TIMESTAMP('".date("Y-m-d")."','YYYY-MM-DD HH24:MI:SS.FF'),'pending',NULL,NULL) ";
                execute($sql);
                $registrationErr="Account Added !";
            }
            else
            {
                $registrationErr="username exits!";
            }
        }
       
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
</head>
<body>
    <form action="" method="post">
        <table>
            <tr>
                <th>Username</th>
                <td><input type="text" name="username" id="" placeholder="Enter Username"></td>
            </tr>  
            <tr>
                <th>Firstname</th>
                <td><input type="text" name="firstname" id="" placeholder="Enter Firstname"></td>
            </tr>
            <tr>
                <th>Lastname</th>
                <td><input type="text" name="lastname" id="" placeholder="Enter Lastname"></td>
            </tr>
            <tr>
                <th>Password</th>
                <td><input type="password" name="password" id="" placeholder="Enter Password"></td>
            </tr>
            <tr>
                <th>Re-Password</th>
                <td><input type="password" name="confirmpassword" id="" placeholder="Enter Password"></td>
            </tr>
            <tr> 
                <th>Date of birth</th>
                <td><input type="date" name="dateofbirth" id=""></td>
            </tr>
            <tr>
                <td><input type="submit" value="Register" name="submit"></td>
                <td><a href="index.php">Already Have An Account? Log In here</a></td>
               
            </tr>
            <tr><td></td> <td><?php echo $registrationErr;?></td></tr>
        </table>
    </form>
</body>
</html>