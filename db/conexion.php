<?php
$con = new mysqli('localhost', 'u624517937_fmj_admin_tmp', 'Bw$l9+h@bQf6', 'u624517937_fmj_rank_tmp');

if ($con->connect_error) {
    echo $con->connect_error;
}

$con->set_charset('utf8');
