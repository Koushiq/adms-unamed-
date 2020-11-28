<?php
	$conn = oci_connect('koushiq1234', 'koushiq1234', 'localhost/XE');
    function execute($query)
    {
        //echo $query;
        global $conn;
        if (!$conn) {
            $e = oci_error();
            trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
        }
        
        $res = oci_parse($conn,$query);
        oci_execute($res);
        return $res;

    }

    function get($res)
    {
       return oci_fetch_array($res, OCI_ASSOC+OCI_RETURN_NULLS);
    }

?>