<?php
session_start();      
require_once '../blocks/header.php';    
require '../crud/crud.php'; 


$title = "Авторизация";

$data = $_POST;

if($data['login'] == "" || $data['password'] == "")
    echo '<div style="color: green;">Введите свои даные!</div>';
elseif(isset($data['do_login'])){        
    $errors = array();
    $jsonData = getUsers();     //Read JSON file   
    if(file_exists('../dbJsonFile.json')){                   
        foreach($jsonData as $key => $value){
            if($data['login'] == $value['login']){                                       
                    if(password_verify($data['password'], $value['password'])) {
                    $_SESSION['logged_user'] = $value['login'];                   
                    echo '<div style="color: green;">Вы успешно авторизованы!<br/>Можете перейти на <a href="/index.php">главную</a> страницу</div><hr>';
                    header('location: logform.php');
                    exit;
                }else 
                     $errors[] = 'Пароль неверно введен!';                         
            } 
            else{
                $errors[] = 'Пользователь с таким логин не найден!';                   
            }                             
        } 
        if( ! empty($errors))
        {
            echo '<div style="color: red;">'.array_shift($errors).'</div><hr>';                    
        }                         
    }
}                            
?>

<?php if( isset($_SESSION['logged_user'])) : ?>
    Авторизован!<br>
    Привет, <?php echo $_SESSION['logged_user']; ?><br>
    <a href="/form/logout.php">Выйти</a>    
    <hr>     
<?php endif; ?>

<div class="container mt-5">
    <h1>Авторизация</h1>
    <form action="/form/logform.php" method="POST">        
        <input type="text" name="login" placeholder="Введите Логин" class="form-control" value= "<?php echo @$data['login']; ?>"><br>
        <input type="password" name="password" placeholder="Введите пароль" class="form-control"><br>
        
        <button type="submit" name= "do_login" class="btn btn-success">Войти</button>
    </form>
</div>

<?php
    require_once "../blocks/foot.php";
?>