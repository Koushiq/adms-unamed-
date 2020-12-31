<?php
    session_start();
    include("../auth/validateauth.php");
    include("../models/conn.php");


?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Activity</title>
</head>
<body>
    <?php
        include("../layout/headerhome.php");

       /*  $sql = "select sum(count(*)) from users 
        where registerdate >= TO_TIMESTAMP('2020-12-31','YYYY-MM-DD HH24:MI:SS.FF') and registerdate <= TO_TIMESTAMP('2021-01-01','YYYY-MM-DD HH24:MI:SS.FF') 
        group by registerdate 
        order by registerdate"; */

    ?>
    <h2>Enter date and see how many users opted registration to site during that time</h2>
    <form action="" method="post">
        <table>
            <tr>
                <th>From Date</th>
                <th>To Date</th>
            </tr>
            <tr>
               <td> <input type="date" name="fromdate" id=""></td>
               <td> <input type="date" name="todate" id=""></td>
            </tr>
            <tr>
                <td><input type="submit" value="submit" name="submit"></td>
            </tr>
        </table>
    </form>
    <?php
        if(isset($_POST['submit']))
        {
            if(isset($_POST['fromdate']) && isset($_POST['todate']))
            {
                $sql = "CREATE OR REPLACE FUNCTION totalUser
                        RETURN number IS 
                        c number(38) := 0; 
                        BEGIN 
                        select sum(count(*)) as count into c from users 
                        where registerdate >= TO_TIMESTAMP('".$_POST['fromdate']."','YYYY-MM-DD HH24:MI:SS.FF') and registerdate <= TO_TIMESTAMP('".$_POST['todate']."','YYYY-MM-DD HH24:MI:SS.FF') 
                        group by registerdate 
                        order by registerdate;
                        RETURN c; 
                        END; ";

                execute($sql);

                $sql = "DECLARE
                        c number(38); 
                        BEGIN 
                            c := totalUser(); 
                            dbms_output.put_line(c);
                        END;";
                    
                $data= getPlSqlData($sql);
                
                echo "<script>alert(".$data[0].");</script>";
                        
            }
        }
    
    ?>


</body>
</html>