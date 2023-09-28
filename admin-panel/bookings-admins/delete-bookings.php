<?php
ob_start();
require "../layouts/header.php";
require "../../config/config.php";

//  Redirect user to login page if not signed in
if (!isset($_SESSION['admin_name'])) {
    header("location: login-admins.php");
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $delete = $conn->query("DELETE FROM bookings WHERE id = '$id'");
    $delete->execute();

    header("location: show-bookings.php");
}

ob_flush();
