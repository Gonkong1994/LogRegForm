<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title ?></title>
    <link rel="stylesheet" href = "https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"></link>
</head>
<body>
    <header>
    <a href = "../index.php">Главная</a> |
    <a href = "../form/logform.php">Авторизация</a> |
    <a href = "../form/signupform.php">Регистрация</a> 
    |<?php if($_SESSION['logged_user'] == "administrator") : ?>
    
    <a href = "../crud/dbjson.php">База Данных</a>
           
    <?php endif; ?>
   
    </header>
    
   