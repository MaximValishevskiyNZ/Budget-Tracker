<?php 

$connection = require_once("../classes/connection.php");
$startDate = $_POST['startDate'] . " 00:00:00";
$endDate = $_POST['endDate'] . " 00:00:00";
$budget = $connection->getBudgetInPeriod($startDate, $endDate);
session_start();
$_SESSION['period'] = $budget;
header("location:../index.php");