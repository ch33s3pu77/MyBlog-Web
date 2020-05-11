<?php
include "functions.php";

if(empty($_REQUEST['email']) || empty($_REQUEST['password'])){
    header('Location: ../index.php');
}
else{
    $email = $_REQUEST['email'];
    $password = $_REQUEST['password'];

    $emailExist = isEmailExist($email);
    if($emailExist){
        $result = login($email, $password);
        echo json_encode($result);
        /*if($result){
            echo json_encode($result);
        } else {
            echo json_encode($result);
        }*/
    } else {
        echo json_encode("Email does not exist.");
    }

}
