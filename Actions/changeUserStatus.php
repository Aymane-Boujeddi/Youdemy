<?php
require_once "../Classes/Admin";
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $status = $_POST["status"];
    $id = $_POST['ID'];
    
    $admin = new Admin("","","","","");
    $admin->changeStatus($status,$id);
    header("location: ../Views/admin.php");

}