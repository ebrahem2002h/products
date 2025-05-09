<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'simple_store';

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("فشل الاتصال: " . mysqli_connect_error());
}
?>