<?php
    session_start();
    include("layout/headerhome.php");
    include("auth/validateauth.php");
    include("models/conn.php");
    echo ' <h1>Welcome '. $_SESSION["username"].'</h1>';

    if(isset($_POST['submit']))
    {
        $sql = "CREATE OR REPLACE PROCEDURE insertUser
                IS
                BEGIN
                    insert into users values ('".$_POST['username']."','".$_POST['usertype']."','".$_POST['firstname']."','".$_POST['lastname']."','".$_POST['password']."',CURRENT_TIMESTAMP,'valid','".$_SESSION['username']."',CURRENT_TIMESTAMP);
                END;";

        execute($sql);


        $sql  = "begin insertUser; end;";

        execute($sql);
        
    }


?>

<form action="" method="post">
    <h3>Add Admin/ShopKeeper</h3>
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
            <th>Date of birth</th>
            <td><input type="date" name="dateofbirth" id=""></td>
        </tr>
        <tr>
            <th>Usertype</th>
            <td>
                <select name="usertype" id="cars">
                    <option value="Admin">Admin</option>
                    <option value="Shopkeeper">ShopKeeper</option>
                </select>
            </td>
        </tr>
        <tr>
            <td><input type="submit" value="Register" name="submit"></td>
        </tr>
        
    </table>
</form>