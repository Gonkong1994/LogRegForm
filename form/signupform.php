<?php
    session_start();
    $title = "Регистрация";
    require '../blocks/header.php';
    require "../classes/handler.php";
    require "../classes/signupValidator.php";
    

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
        $jsonData = [];
        $errors = array();
        //Read file
        if(file_exists('../dbJsonFile.json')){
            $json = file_get_contents('../dbJsonFile.json');
            $jsonData = json_decode($json, true);   
            
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
            // Write file
            if($data){
                    $hash_password = password_hash($data['password'], PASSWORD_DEFAULT);
                    $hash_password_2 = password_hash($data['password_2'], PASSWORD_DEFAULT);
                    $data['password'] = $hash_password;
                    $data['password_2'] = $hash_password_2;
                    $jsonData[] = $data;                            
                    file_put_contents("../dbJsonFile.json", json_encode($jsonData, JSON_PRETTY_PRINT));                     
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