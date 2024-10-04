<?php
include 'db_connect.php';
session_start();

if ($_SESSION['user_role'] != 4) {
    header("Location: unauthorized.php");
    exit();
}

// Display aggregated data for auditors
