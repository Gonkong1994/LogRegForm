<?php
require  'crud.php';

$title = "База данных";
require_once "../blocks/header.php"; 

$userId = $_GET['id'];
$user = getUserById($userId);
?>

<div class="card">
    <div class="card-header">
        <h3>View User: <b><?php echo $user['name'] ?></b></h3>
    </div>    
    <table class="table">
        <tbody>
            <tr>
                <th>Name</th>
                <td><?php echo $user['name'] ?></td>
            </tr>
            <tr>
                <th>Login</th>
                <td><?php echo $user['login'] ?></td>
            </tr>
            <tr>
                <th>Email</th>
                <td><?php echo $user['email'] ?></td>
            </tr>
            <tr>
                <th>Password</th>
                <td><?php echo $user['password'] ?></td>
            </tr>
        </tbody>
    </table>
</div>