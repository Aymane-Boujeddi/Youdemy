<?php
require_once "../Classes/Admin";
if($_SERVER["REQUEST_METHOD"] == "GET"){
    $id = $_GET["ID"];
    $admin = new Admin("","","","","");
    $admin->deleteCategory($id);
    header("location: ../Views/admin.php");
}