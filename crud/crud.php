<?php

function getUsers(){
    return json_decode(file_get_contents('../dbJsonFile.json'), true); 
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

function deleteUser($id){
    $users = getUsers();
    foreach($users as $i => $user)
        if($user['login'] == $id){
            array_splice($users, $i, 1);
        }
    putJson($users);
}

function putJson($users){
    file_put_contents('../dbJsonfile.json' , json_encode($users, JSON_PRETTY_PRINT));
}

