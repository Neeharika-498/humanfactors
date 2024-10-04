<?php
include 'db_connect.php';
session_start();

if ($_SESSION['user_role'] != 2) {
    header("Location: unauthorized.php");
    exit();
}

// Display existing groups and allow adding/removing patients
