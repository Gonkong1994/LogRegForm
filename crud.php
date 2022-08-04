<?php

function getUsers(){
    return json_decode(file_get_contents(__DIR__. '/dbJsonFile.json'), true);
    

}


function getUserById($id){
    $users = getUsers();
    foreach($users as $user){        
        if($user['login'] == $id){
            return $user;
        }
    }
    return null;

}

function createUser($data){
    file_put_contents("dbJsonFile.json", json_encode($jsonData, JSON_PRETTY_PRINT));

}

/*function updateUser($data, $id){
    $users = getUsers();
    foreach($users as $i => $user){
        if($user['login'] == $id){
             $user[$i] = array_merge($user, $data);
        }
    }
    file_put_contents(__DIR__. '/dbJsonFile.json', json_encode($users), JSON_PRETTY_PRINT);

}*/

function deleteUser($id){


}

