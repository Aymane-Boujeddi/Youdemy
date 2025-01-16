<?php
require_once "../Classes/Tags";
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $tags = $_POST["tags"];
    $allTags = explode(",",$tags);
    $tagsArray = [];
    foreach($allTags as $tags){
        $trimmedTag = trim($tags);
        array_push($tagsArray,$trimmedTag);
    }

    $tag = new Tags("");
    $tag->addTags($tagsArray);
    header("location: ../Views/admin.php");
}