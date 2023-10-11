<?php
session_start();
if(!isset($_SESSION['adminname'])){
    header('location: adminlogin.php');
    exit;
}
include 'admindashboard.php';
include 'admincontent.php';
?>