<?php
require_once "../Classes/User";
if($_SERVER["REQUEST_METHOD"] == "POST"){
$username = $_POST["username"];
$email = $_POST["email"];
$password = $_POST["password"];
$role = $_POST["role"];

$newUser = new User($username,$email,$password,$role);
$_SESSION['errors'] = $newUser->register();
header("location: ../index.php")


}