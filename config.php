<?php
require_once "classes/Database.php";
require_once "classes/Student.php";
require_once "classes/User.php";
require_once "classes/Validator.php";

$db = new Database();
$conn = $db->getConnection();
$student = new Student($conn);
$user = new User($conn);
