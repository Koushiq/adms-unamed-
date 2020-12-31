<?php
    include("conn.php");
    $sql = "CREATE OR REPLACE FUNCTION validUser
            RETURN varchar2 IS 
            userStatus varchar2(20) := ''; 
            BEGIN 
            SELECT status into userStatus from users where username='".$_SESSION['username']."';
            RETURN userStatus; 
            END; ";

    execute($sql);

    $sql = "DECLARE
            c varchar2(20); 
            BEGIN 
                c := validUser(); 
                dbms_output.put_line(c);
            END; ";

    $data= getPlSqlData($sql);
    
    if($data[0]=='pending')
    {
       session_destroy();
       echo  
       "<script>
                alert('registration not approved');
                window.location.href='index.php';
       </script>";
    }
   
?>