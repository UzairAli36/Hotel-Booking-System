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

    // Deleting admin
    $getImages = $conn->query("DELETE FROM rooms WHERE id='$id'");
    $getImages->execute();

    $fetch = $getImages->fetch(PDO::FETCH_OBJ);

    unlink("rooms_images/" . $fetch->image);

    $delete = $conn->query("DELETE FROM rooms WHERE id = '$id'");
    $delete->execute();

    header("location: show-rooms.php");
}

ob_flush();
