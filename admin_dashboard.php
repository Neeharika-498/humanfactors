<?php
include 'db_connect.php';
session_start();

if ($_SESSION['user_role'] != 3) {
    header("Location: unauthorized.php");
    exit();
}

// Display non-sensitive data for admin/staff
