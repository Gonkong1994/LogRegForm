<?php
    session_start();
    $title = "Регистрация";
    require_once "blocks/header.php";
    require "classes/handler.php";
    require "classes/signupValidator.php";
    

    $data = $_POST;   

       //здесь регистрируем
      //  $errors = array();
       // if(trim($data['name']) == '')
       $Validator = new SignupValidator($data);
       

        $error = $Validator->validateName();
        if(!empty($error))
            Handler:: printError($error);
        
        $error = $Validator->validateLogin();
        if(!empty($error))
            Handler:: printError($error);
                 
        $error = $Validator->validateEmail();
        if(!empty($error))
            Handler:: printError($error);

        $error = $Validator->validatePassword();
        if(!empty($error))
            Handler:: printError($error);
           // $errors[] = 'Введите имя';    
      /*  if(!preg_match("/^(([a-zA-Z' -]{2,30})|([а-яА-ЯЁёІіЇїҐґЄє' -]{2,30}))$/u", $data['name']))
            $errors[] = 'Введите корректное имя';
        if(strlen ($data['login']) < 6)
            $errors[] = 'Логин должен содержать не менее 6 символов';
        if(trim($data['login']) == '' || trim($data['email']) == '' ||  $data['password'] == '' )
            $errors[] = 'Введите Данные Во Все Поля';
        
        if(strlen ($data['password']) < 6)
            $errors[] = 'Пароль должен быть не менее 6 символов';   
        if(!preg_match('/^(?=.*[a-z])(?=.*\d)[a-zA-Z\d]{6,25}$/', $data['password']))
            $errors[] = 'Пароль должен состоять из букв и цифр';      
        if($data['password_2'] != $data['password'])  
            $errors[] = 'Повторный пароль введен неверно';
       */
       
       
           // if(empty($errors)){
             $jsonData = [];
                //Read file
                if(file_exists('dbJsonFile.json')){
                    $json = file_get_contents('dbJsonFile.json');
                    $jsonData = json_decode($json, true);   
                    
                    foreach($jsonData as $key => $value){
                        if($data['login'] == $value['login']){
                            
                            $errors[] =  'Пользователь с таким логином уже зарегестрирован!';
                         //  header('location: signupform.php');
                         //  exit();
                        } 

                        if($data['email'] == $jsonData['email']){
                            $errors[] =  'Пользователь с таким email уже зарегестрирован!';
                        }
                        
                    }
                        
                }
            if(empty($errors)){
                
                // Write file
                if($data){
                    $hash_password = password_hash($data['password'], PASSWORD_DEFAULT);
                    $data['password'] = $hash_password;
                    $jsonData[] = $data;                            
                    file_put_contents("dbJsonFile.json", json_encode($jsonData, JSON_PRETTY_PRINT)); 
                    //var_dump($jsonData);
                    unset($data['password']);
                    
                              
                    
                 //  header("Location:".$_SERVER['HTTP_REFERER']);
                 // unset($jsonData);
                 echo '<div style="color: green;">Вы успешно зарегестрированы</div><hr>';
                }
                
              //Register
                
          
            }//else {
               //  echo '<div style="color: red;">'.array_shift($errors).'</div><hr>';
          //   }
            
   
?>

<?php if( isset($_SESSION['logged_user'])) : ?>
    Авторизован!<br>
    Привет, <?php echo $_SESSION['logged_user']; ?><br>
    <a href="/logout.php">Выйти</a>
    <hr>
    
    
    <?php endif; ?>

<div class="container mt-5">
    <h1>Регистрация</h1>
    <form action="/signupform.php" method="POST">
        <input type="text" name="name" placeholder="Введите Имя" class="form-control" value= "<?php echo @$data['name']; ?>"> <br>
        <input type="text" name="login" placeholder="Введите Логин" class="form-control" value= "<?php echo @$data['login']; ?>"><br>
        <input type="email" name="email" placeholder="Введите email" class="form-control" value= "<?php echo @$data['email']; ?>"><br>
        <input type="password" name="password" placeholder="Введите Пароль" class="form-control" value= "<?php echo @$data['password']; ?>"><br>
        <input type="password" name="password_2" placeholder="Введите пароль еще раз" class="form-control"><br>
        <input type="submit" value="Зарегистрироваться" class="btn btn-success">    

    </form>
</div>
<?php
    require_once "blocks/foot.php";
?>