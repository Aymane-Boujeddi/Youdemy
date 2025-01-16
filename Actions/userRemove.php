<?php

require_once "../Classes/Admin";

if($_SERVER["REQUEST_METHOD"] == "GET"){

    $id = $_GET['userID'];
    $admin = new Admin("","","","","");
    $changeStatus = $admin->removeUser($id);
    header("location: ../Views/admin.php");
}