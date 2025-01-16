<?php
require_once "../Classes/Tags";
if($_SERVER["REQUEST_METHOD"] == "GET"){
    $id = $_GET['tagID'];

    $tag = new Tags("");
    $tag->deleteTag($id);
    header("location: ../Views/admin.php");
}