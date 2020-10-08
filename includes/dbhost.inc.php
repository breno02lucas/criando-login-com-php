<?php

$servername = 'localhost';
$dbusername = 'root';
$dbpassword = ''; // N tem senha para localhost no windows... AAFFF
$dbname = 'login_page';

$conn = mysqli_connect($servername, $dbusername, $dbpassword, $dbname);

if (!$conn)
{
    die("Connection fail: " . mysqli_connect_error());
}

?>