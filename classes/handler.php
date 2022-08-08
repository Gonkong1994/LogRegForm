<?php

class Handler{
    public static function printError($error){
        $arrErrors = array($error);                  
        echo '<div style="color: red;">' . array_shift($arrErrors) . '</div><hr>';
    }   
}