<?php
$host = 'localhost';
$dbname = 'company_db';
$user = 'root';
$pass = '';

$company_conn = new mysqli($host, $user, $pass, $dbname);
if ($company_conn->connect_error) {
    die("ERROR: Could not connect to company database. " . $company_conn->connect_error);
}
?>