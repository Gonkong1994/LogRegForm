<?php
require 'crud.php';

$userId = $_GET['id'];
$user = getUserById($userId);
deleteUser($userId);
header("Location: dbjson.php");
exit;