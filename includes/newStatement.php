<?php

print_r($_POST);
$newNote = $_POST;
$connection = require_once("../classes/connection.php");
$budget = $connection->addNote($newNote);
header("location: ../index.php");