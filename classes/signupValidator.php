<?php

class SignupValidator{

    private $name;
    private $login;
    private $email;
    private $password;

  /*  public function __construct($iName,$iLogin,$iEmail,$iPassword){

        $this->name = $iName;
        $this->login = $iLogin;
        $this->email = $iEmail;
        $this->password = $iPassword;
    }*/

    private function isEmpty($field){

        if(empty(trim($field)))
            return 'Введите';
    }

    public function validateName(){

        $error = $this->isEmpty($this->name);
        if(!empty($error))
            return $error . ' Имя';
        else{
            $error = $this->validateNameLen();
            if(!empty(error))
                return $error;
            $error = $this->validateNameChars();
            if(!empty(error))
                return $error;
        }
    }

    public function validateNameLen(){

        if(strlen($this->name) < 2)
            return 'Имя должно быть не менее 2 символов';
    }

    public function validateNameChars(){

        if(preg_match("/^(([a-zA-Z' -]{2,30})|([а-яА-ЯЁёІіЇїҐґЄє' -]{2,30}))$/u",$this->name))
            return 'Имя должно состоять только из букв';
    }

    public function validateLogin(){

        $error= $this->isEmpty($this->login);
        if(!empty($error))
            $error . ' Логин';
        else{
            $loginLen = strlen($this->login);
            if($loginLen < 6)
                $error = 'Логин должен быть не менее 6-ти симвлов';
        }
    }

    public function validateEmail(){

        $error= $this->isEmpty($this->email);
        if(!empty($error))
            return $error. ' email';
        else{
            if(!preg_match())  // валидация EMAIL
                $error = 'Неверный email';
        }
    }

    public function validatePassword(){

        $error = $this->isEmpty($this->password);
        if(!empty($error))
            $error . ' Пароль';
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
            return 'Логин должен быть не менее 6-ти симвлов';
    }

    private function validatePasswordChars(){

        if(!preg_match('/^(?=.*[a-z])(?=.*\d)[a-zA-Z\d]{6,25}$/', $this->password) < 6)
            return 'Пароль должен состоять из букв и цифр';
    }



    
}