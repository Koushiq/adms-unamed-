<?php
    session_start();
    include("../auth/validateauth.php");
    include("../models/conn.php");
    include("../layout/headerhome.php");
    if($_SESSION['usertype']!="Admin")
    {
        header("location:logout.php");
    }
    $sql = "select actionby, COUNT(actionby) AS MOST_FREQUENT
            from users
            GROUP BY actionby
            ORDER BY COUNT(actionby) DESC";
    
    $res = execute($sql);

    echo "<h1>Most users approved by admins are : </h1>"; 

    echo "<table border=1>
            <tr>
                <th>Admin</th>
                <th>Action Count</th>
            </tr>";
    while($row=oci_fetch_array($res, OCI_ASSOC+OCI_RETURN_NULLS))
    {
        if($row['ACTIONBY']!='')
        {
            echo '<tr>
                    <td>
                    '.$row['ACTIONBY'].'
                    </td>
                    <td>
                        '.$row['MOST_FREQUENT'].'
                    </td>
                </tr>';
        }
       
    }
    echo "</table>";

    

    echo "<h1>Most popular books by checkouts are : </h1>"; 

    echo "<table border=1>
            <tr>
                <th>Admin</th>
                <th>Units sold</th>
            </tr>";
    $sql= "select books.title,count(books.title)as MOST_FREQUENT 
    from checkout,books where checkout.bookid=books.bookid
    group by books.title
    order by count(books.title) desc";
    $res = execute($sql);

    while($row=oci_fetch_array($res, OCI_ASSOC+OCI_RETURN_NULLS))
    {
        if($row['TITLE']!='')
        {
            echo '<tr>
                    <td>
                    '.$row['TITLE'].'
                    </td>
                    <td>
                        '.$row['MOST_FREQUENT'].'
                    </td>
                </tr>';
        }
       
    }
    echo "</table>";


    echo "<h1>Total Revenue via checkout </h1>"; 
    echo "<table border=1>
    <tr>
        <th>Revenue</th>
    </tr>";
    $sql = "select max(sum(price)) as profit
    from checkout,books where checkout.bookid=books.bookid
    group by books.title
    order by count(books.title) desc
    ";
    $res = execute($sql);
    while($row=oci_fetch_array($res, OCI_ASSOC+OCI_RETURN_NULLS))
    {
       
        echo '<tr>
                <td>
                '.$row['PROFIT'].'
                </td>
            </tr>';
    }
    echo "</table>";
    




?>
