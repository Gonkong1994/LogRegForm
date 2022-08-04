<?php
require __DIR__. '/crud.php';

    $title = "База данных";
    require_once "blocks/header.php";

   


$userId = $_GET['id'];

$user = getUserById($userId);

//if($_SERVER['REQUEST_METHOD'] === 'POST')
  //  updateUser($_POST, $userId);

?>
<div class="container">
    <div class="card-header">
        <h3>Update User: <b><?php echo $user['name'] ?></b></h3>
    </div>
<form method="POST" enctype="multipart/form-data" action="">
    <div class="form-group">
        <lable>Name</lable>
        <input name="name" value="<?php echo $user['name'] ?>" class="form-control">
    </div>
    <div class="form-group">
        <lable>Login</lable>
        <input login="login" value="<?php echo $user['login'] ?>" class="form-control">
    </div>
    <div class="form-group">
        <lable>Email</lable>
        <input email="email" value="<?php echo $user['email'] ?>" class="form-control">
    </div>
    <button class="btn btn-success mt-2">Submit</button>
   
    
</form>
</div>
