<?php
session_start();

if (!isset($_SESSION['user_login'])) {
    header("Location: ../login/login.php");
    exit();
}

$empcode = $_SESSION['user_login'];
$firstname = $_SESSION['firstname'];
$lastname = $_SESSION['lastname'];
$role = $_SESSION['role'];
?>