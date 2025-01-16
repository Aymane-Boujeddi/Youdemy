<?php
require_once "../Classes/Admin";
if($_SERVER["REQUEST_METHOD"] == "GET"){
    $id = $_GET['tagID'];

    $admin = new Admin("","","","","");
    $admin->deleteTag($id);
    header("location: ../Views/admin.php");
}