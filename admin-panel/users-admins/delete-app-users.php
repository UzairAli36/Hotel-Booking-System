<?php
ob_start();
require "../layouts/header.php";
require "../../config/config.php";

//  Redirect user to login page if not signed in
if (!isset($_SESSION['admin_name'])) {
    header("location: " . ADMINURL . "/admins/login-admins.php");
}

// Check if the 'id' parameter is provided in the URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Deleting whole product
    $delete = $conn->query("DELETE FROM users WHERE id='$id'");
    $delete->execute();

    header("location: show-app-users.php");
}
ob_end_flush();
