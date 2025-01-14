<?php 
require_once "../Classes/User";

if($_SERVER["REQUEST_METHOD"] == "POST"){

$email = $_POST['email'];
$password = $_POST["password"];

$loginUser = new User("","","","");
$userInfo = $loginUser->login($email,$password);
var_dump($userInfo);


}