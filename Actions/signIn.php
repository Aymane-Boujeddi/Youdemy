<?php 
require_once "../Classes/User";

if($_SERVER["REQUEST_METHOD"] == "POST"){

$email = $_POST['email'];
$password = $_POST["password"];

$loginUser = new User("","","","","");
$userInfo = $loginUser->login($email,$password);

session_start();
if($userInfo['role'] == "teacher"){
    $_SESSION['id'] = $userInfo['userID'];
    $_SESSION['role'] = $userInfo['role'];
    $_SESSION['username'] = $userInfo['username'];
    header("location: ../Views/teacher.php");
    exit();
}elseif($userInfo['role'] == "admin"){
    $_SESSION['id'] = $userInfo['userID'];
    $_SESSION['role'] = $userInfo['role'];
    $_SESSION['username'] = $userInfo['username'];
    header("location: ../Views/admin.php");
    exit();
}elseif($userInfo['role'] == "student"){
    $_SESSION['id'] = $userInfo['userID'];
    $_SESSION['role'] = $userInfo['role'];
    $_SESSION['username'] = $userInfo['username'];
    header("location: ../index.php");
    exit();
}elseif(empty($userInfo)){
    $_SESSION['errors'] = $loginUser->getErrors();
    header("location: ../Views/login.php");
}

}