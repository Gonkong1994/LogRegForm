<?php
    $title = "Авторизация";
    require_once "blocks/header.php";

    $data = $_POST;
    $errors = array();

    $jsonData = [];
        //Read file
        if(file_exists('dbJsonFile.json')){
            $json = file_get_contents('dbJsonFile.json');
            $jsonData = json_decode($json, true);   
            
            foreach($jsonData as $key => $value){
                if($data['login'] == $value['login']){
                    if($data['password'] == $value['password'])                    
                        echo '<div style="color: green;">Вы успешно авторизованы</div><hr>';
                    else 
                         $errors[] = 'Пароль неверно введен!';
                    //  header('location: signupform.php');
                    //  exit();
                    
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
        
?>

<div class="container mt-5">
    <h1>Авторизация</h1>
    <form action="logform.php" method="POST">        
        <input type="text" name="login" placeholder="Введите Логин" class="form-control" value= "<?php echo @$data['login']; ?>"><br>
        <input type="password" name="password" placeholder="Введите пароль" class="form-control"><br>
        <input type="submit" value="Войти" class="btn btn-success">
    </form>
</div>

<?php
    require_once "blocks/foot.php";
?>