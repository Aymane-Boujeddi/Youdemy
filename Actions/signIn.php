<?php 
require_once "../Classes/User";

if($_SERVER["REQUEST_METHOD"] == "POST"){

$email = $_POST['email'];
$password = $_POST["password"];

$loginUser = new User("","","","","");
$userInfo = $loginUser->login($email,$password);
session_start();
$_SESSION['id'] = $userInfo['userID'];
$_SESSION['role'] = $userInfo['role'];
$_SESSION['username'] = $userInfo['username'];
$_SESSION['status'] = $userInfo['user_status'];

if($userInfo['role'] == "teacher" && $userInfo['user_status'] != "pending"){
   
    header("location: ../Views/teacher.php");
    exit();
}elseif($userInfo['role'] == "admin"){
   
    header("location: ../Views/admin.php");
    exit();
}elseif($userInfo['role'] == "student"){

    header("location: ../index.php");
    exit();
}elseif(empty($userInfo)){
    $_SESSION['errors'] = $loginUser->getErrors();
    header("location: ../Views/login.php");
    exit();
}elseif($userInfo['role'] == "teacher" && $userInfo['user_status'] == "pending")
    $_SESSION['errors'] = ["Your account is not verified yet please wait for verification"];
    header("location: ../Views/login.php");
    exit();
}