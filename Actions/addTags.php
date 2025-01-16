<?php
require_once "../Classes/Admin";
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $tags = $_POST["tags"];
    $allTags = explode(",",$tags);
    $tagsArray = [];
    foreach($allTags as $tags){
        $trimmedTag = trim($tags);
        array_push($tagsArray,$trimmedTag);
    }

    $admin = new Admin("","","","","");
    $admin->addTags($tagsArray);
    header("location: ../Views/admin.php");
}