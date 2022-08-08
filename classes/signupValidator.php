<?php

class SignupValidator{
    private $name;
    private $login;
    private $email;
    private $password;
    private $password_2;

    public function __construct($iName, $iLogin, $iEmail, $iPassword, $iPassword2){
        $this->name = $iName;
        $this->login = $iLogin;
        $this->email = $iEmail;
        $this->password = $iPassword;
        $this->password_2 = $iPassword2;
    }

   

    public function validateName(){
        $error = $this->isEmpty($this->name);
        if(!empty($error))
            return $error . 'Имя';
        else{
            $error = $this->validateNameLen();
            if(!empty($error))
                return $error;
            $error = $this->validateNameChars();
            if(!empty($error))
                return $error;
        }
    }

    private function isEmpty($field){
        if(empty(trim($field)))
            return 'Введите ';
    }

    private function validateNameLen(){
        if(strlen($this->name) < 2)
            return 'Имя должно быть не менее 2 символов';
    }

    private function validateNameChars(){
        if((!preg_match("/^(([a-zA-Z' -]{2,30})|([а-яА-ЯЁёІіЇїҐґЄє' -]{2,30}))$/u",$this->name)) || (!ctype_graph($this->name)))
            return 'Имя должно состоять только из букв и без пробелов';
    }

    public function validateLogin(){
        $error= $this->isEmpty($this->login);
        if(!empty($error))
           return $error . 'Логин';
        else{
            $error = $this->validateLoginLen();
            if(!empty($error))
                return $error; 
            $error = $this->validateLoginChars();
            if(!empty($error))
                return $error;          
         }
    }

    private function validateLoginLen(){
        if(strlen($this->login) < 6)
            return 'Логин должен быть не менее 6-ти симвлов';
    }

    private function validateLoginChars(){
        if(!ctype_graph($this->login))
            return 'Логин не может содержать пробелы';
    }

    public function validateEmail(){
        $error= $this->isEmpty($this->email);
        if(!empty($error))
            return $error. 'email';
        else{                    
            if(!filter_var($this->email, FILTER_VALIDATE_EMAIL))  // валидация EMAIL
                $error = 'Неверный email';
        }
    }

    public function validatePassword(){
        $error = $this->isEmpty($this->password);
        if(!empty($error))
           return $error . 'Пароль';
        else{
            $error = $this->validatePasswordLen();
            if(!empty($error))
                return $error;
            $error = $this->validatePasswordChars();
            if(!empty($error))
                return $error;
        }
    }

    private function validatePasswordLen(){
        if(strlen($this->password) < 6)
            return 'Пароль должен быть не менее 6-ти симвлов';
    }

    private function validatePasswordChars(){
        if((!preg_match('/^(?=.*[a-z])(?=.*\d)[a-zA-Z\d]{6,25}$/', $this->password)) || (!ctype_graph($this->password)))
            return 'Пароль должен состоять из букв, цифр и без пробелов';
    }

    public function validatePassword2(){
        $error = $this->isEmpty($this->password_2);
        if(!empty($error))
            return $error . 'пароль повторно';
        else{
            $error = $this->validatePasswordToPassword2();
            if(!empty($error))
                return $error;
        }
    }
    
    private function validatePasswordToPassword2(){
        if($this->password != $this->password_2)
            return 'Повторный пароль введен не верно';
    }    
}