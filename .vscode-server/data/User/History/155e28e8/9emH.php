<?php
//oracle data base address
$db = '(DESCRIPTION =
(ADDRESS_LIST=
(ADDRESS = (PROTOCOL = TCP)(HOST = 203.249.87.57)(PORT = 1521))
)
(CONNECT_DATA = (SID = orcl)
)
)';
//enter user name & password
$username = "DB502_PROJ_G2";
$password = "6969";
//connect with oracle_db
$connect = oci_connect($username, $password, $db);
//oracle db connection error message
if (!$connect) {
    $e = oci_error();
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}
