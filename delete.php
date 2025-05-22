<?php
require_once "config.php";
if (!$user->isLoggedIn()) header("Location: login.php");

$id = $_GET['id'] ?? null;
if ($id) {
    $student->delete($id);
}
header("Location: index.php");
exit;