<?php
// $servername = "52.139.193.40,3511";
// $username = "follow";
// $password = "F0!!ow@2024";
// $database = "DSLI_system"; // ชื่อฐานข้อมูล

$servername = "sqlserver";
$username = "sa";
$password = "YourStrong!Passw0rd";
$database = "E-Career";

try {
    $dsn = "sqlsrv:server=$servername;Database=$database";
    $db = new PDO($dsn, $username, $password);
    // set the PDO error mode to exception
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Connected successfully";
} catch (PDOException $e) {
    // echo "Connection failed: " . $e->getMessage();
}
?>