<?php
include "../auth/db.php";

function signUp($user, $email, $password, $date_created){
    global $con;
    $USER_NAME = mysqli_real_escape_string($con, $user);
    $USER_EMAIL = mysqli_real_escape_string($con, $email);
    $USER_PASSWORD = mysqli_real_escape_string($con, $password);
    $PASSWORD = password_hash($USER_PASSWORD, PASSWORD_ARGON2ID);
    $query = "INSERT INTO 'users'('name', 'email', 'password', 'created_date')";
    $query .= " VALUES('$USER_NAME', '$USER_EMAIL', '$PASSWORD', '$date_created')";

    $result = mysqli_query($con, $query);
    if(!$result){
        //die("Query Failed " . mysqli_error($con));
        return "Query Failed";
    }
    else {
        return $result;
    }
}

function login($email, $password){
    global $con;
    $USER_EMAIL = mysqli_real_escape_string($con, $email);
    $USER_PASSWORD = mysqli_real_escape_string($con, $password);

    $query = "SELECT * FROM users WHERE email = '$USER_EMAIL'";
    $result = mysqli_query($con, $query);
    if($result){
        $rowcount = mysqli_num_rows($result);
        if($rowcount == 1){
            $user = mysqli_fetch_array($result);
            $PASSWORD = $user['password'];

            if(password_verify($USER_PASSWORD, $PASSWORD)){
                return true;
            } else {
                return "Password does not exist.";
            }
        }
    } else {
        //die("Query Failed " . mysqli_error($con));
        return "Query failed";
    }
}

function isEmailExist($email){
    global $con;

    $query = "SELECT email FROM users WHERE email = '$email'";
    $result = mysqli_query($con, $query);
    if($result){
        $rows = mysqli_num_rows($result);
        if($rows >= 1){
            return true;
        } else {
            return false;
        }
    } else {
        //die("Query Failed " . mysqli_error($con));
        return "Query Failed";
    }
}