<?php

require_once "../Classes/Admin";

if($_SERVER["REQUEST_METHOD"] == "GET"){

    $id = $_GET['teacherID'];
    $admin = new Admin("","","","","");
    $changeStatus = $admin->removeTeacher($id);
    header("location: ../Views/admin.php");
}