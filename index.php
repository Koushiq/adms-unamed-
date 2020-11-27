<?php
    session_start();
    $loginerr= "";
      if(isset($_POST['submit']))
      {
        include ("models/conn.php");
          if (!empty($_POST['username']) && !empty($_POST['password']))
          {
             $res= execute("select * from users where username='".$_POST['username']."' and password='".$_POST['password']."'");
             $row = get($res);
             
             if(!empty($row))
             {
                 $_SESSION["username"]=$row["USERNAME"];
                header("location:".$row["USERTYPE"].".php");
             }
             else
             {
                $loginerr="incorrect credentials";
             }
          }
          else
          {
              $loginerr="can't be empty";
          }
      }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <form action="" method="post">
       <fieldset>
       <table>
            <tr>
                <td>
                    <label for="username">Username</label>
                </td>

                <td>
                
                    <input type="text" name="username" id="" placeholder="Enter Username">
                </td>
            </tr>
            <tr>
            <td>
                <label for="password">Password</label>
            </td>
                <td>
                
                    <input type="password" name="password" id="" placeholder="Enter Password">
                </td>
            </tr>
            <tr>
                <td><input type="submit" value="Login"  name="submit"></td>
            </tr>
            <tr>
                <td><?php echo $loginerr ;?></td>
            </tr>
        </table>
       </fieldset>
    </form>
</body>
</html>