<?php

define('HOST', 'localhost');
define('USER', 'root');
define('PASS', '');
define('NAME', 'mancity');

$conn = new mysqli(HOST, USER, PASS, NAME);
mysqli_set_charset($conn, 'utf8');

if($conn -> connect_error){
    die('Connection failed' . $conn -> connect_error);
}

?>