<?php
require_once "../Classes/Admin";
if($_SERVER["REQUEST_METHOD"] == "POST"){

    $category = $_POST["category"];
    $admin = new Admin("","","","","");
    echo $category;

    $admin->addCategory($category);
    header("location: ../Views/admin.php");
}