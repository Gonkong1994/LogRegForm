<?php  
session_start();  
require '../blocks/header.php';
require "../classes/handler.php";
require "../classes/signupValidator.php";
require '../crud/crud.php';


$title = "Регистрация";


$data = $_POST;        
    
$Validator = new SignupValidator($data['name'],$data['login'],$data['email'],$data['password'],$data['password_2']);   

$error = $Validator->validateName();
if(!empty($error))
    Handler:: printError($error);
else{
    $error = $Validator->validateLogin();
    if(!empty($error))
        Handler:: printError($error);
    else{
        $error = $Validator->validateEmail();
        if(!empty($error))
            Handler:: printError($error);
        else{
            $error = $Validator->validatePassword();
            if(!empty($error))
                Handler:: printError($error);
            else{
                $error = $Validator->validatePassword2();
                if(!empty($error))
                    Handler:: printError($error);
            }            
        }           
    }    
}                                           
   

if(empty($error)){
    $jsonData = getUsers();     //Read JSON file (crud.php)
    $errors = array();
    
    if(file_exists('../dbJsonFile.json')){               
        foreach($jsonData as $key => $value){
            if($data['login'] == $value['login']){                    
                $errors[] =  'Пользователь с таким логином уже зарегестрирован!';                    
            } 
            if($data['email'] == $value['email']){
                $errors[] =  'Пользователь с таким email уже зарегестрирован!';
            }
        }            
    }

    if(empty($errors)){                  
        if($data){
                $hashPassword = password_hash($data['password'], PASSWORD_DEFAULT);
                $hashPassword2 = password_hash($data['password_2'], PASSWORD_DEFAULT);
                $data['password'] = $hashPassword;
                $data['password_2'] = $hashPassword2;
                $jsonData[] = $data; 
                putJson($jsonData);         // Write in JSON file                           
                unset($data['password']);                                                                
                echo '<div style="color: green;">Вы успешно зарегестрированы</div><hr>';
        }                  
    } else {
        echo '<div style="color: red;">'.array_shift($errors).'</div><hr>';        
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
<h1>Регистрация</h1>
<form action="/form/signupform.php" method="POST">
    <input type="text" name="name" placeholder="Введите Имя" class="form-control" value= "<?php echo @$data['name']; ?>"> <br>
    <input type="text" name="login" placeholder="Введите Логин" class="form-control" value= "<?php echo @$data['login']; ?>"><br>
    <input type="email" name="email" placeholder="Введите email" class="form-control" value= "<?php echo @$data['email']; ?>"><br>
    <input type="password" name="password" placeholder="Введите Пароль" class="form-control" value= "<?php echo @$data['password']; ?>"><br>
    <input type="password" name="password_2" placeholder="Введите пароль еще раз" class="form-control"><br>
    <input type="submit" value="Зарегистрироваться" class="btn btn-success">   
</form>
</div>

<?php
require_once "../blocks/foot.php";
?>