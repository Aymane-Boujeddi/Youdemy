<?php
require_once "../Classes/User";
session_start();
if($_SERVER["REQUEST_METHOD"] == "POST"){
$username = $_POST["username"];
$email = $_POST["email"];
$password = $_POST["password"];
$role = $_POST["role"];
$status;

if($role == 'teacher'){
    $status = "pending";
    $newUser = new User($username,$email,$password,$role,$status);
}else{
    $status = "active";
    $newUser = new User($username,$email,$password,$role,$status);
}
$newUser->register();
$_SESSION['errors'] = $newUser->getErrors();
if(!empty($_SESSION['errors'])){
    header("location: ../Views/register.php");
    exit();
}else{
    header("location: ../Views/login.php");
    exit();
}


}