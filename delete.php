<?php
require __DIR__. '/crud.php';

$title = "База данных";
require_once "blocks/header.php";




$userId = $_GET['id'];

$user = getUserById($userId);

deleteUser($userId);
//$user = getUserById();

header("Location: dbjson.php");