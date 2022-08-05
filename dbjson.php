<?php
    session_start();
    $title = "База данных";
    require_once "blocks/header.php";

    require 'crud.php';
    $users = getUsers();
   // echo '<pre>';
    //var_dump($users);
   // echo '</pre>';
?>

<?php if( isset($_SESSION['logged_user'])) : ?>
    Авторизован!<br>
    Привет, <?php echo $_SESSION['logged_user']; ?><br>
    <a href="/logout.php">Выйти</a>
    <hr>
    
    
    <?php endif; ?>

    <h1>База данных</h1>
    <section>
        <div class="container mt-3">
            <div class="row justify-content-center">
            <div class="col-12">
                <button class="btn btn-success" value="Зарегистрироваться" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-plus-circle"></i></button>
                <table border="2"  cellpadding="5" class="table table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th scope= "col" style="width: 15%;">Name</th>
                            <th scope= "col" class="text-center;" style="width: 15%;">Login</th>    
                            <th scope= "col" class="text-center" style="width: 18%;">Email</th>
                            <th scope= "col" style="width: 40%;">Password</th>
                            <th scope= "col" style="width: 15%;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach($users as $user): ?>
                        <tr>
                            <td><?php echo $user['name'] ?></td>
                            <td><?php echo $user['login'] ?></td>
                            <td><?php echo $user['email'] ?></td>
                            <td><?php echo $user['password'] ?></td>
                            <td>
                                <a href="view.php?id=<?php echo $user['login'] ?>" class="btn btn-sm btn-outline-info">View</a>                                
                                <a href="delete.php?id=<?php echo $user['login'] ?>" class="btn btn-sm btn-outline-danger">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>    
                </table>
            </div>
        </div>
    </section>

<?php
    require_once "blocks/foot.php";
?>