<?php
require_once "../Classes/Category";
if($_SERVER["REQUEST_METHOD"] == "GET"){
    $id = $_GET["ID"];
    $category = new Category("");
    $category->deleteCategory($id);
    header("location: ../Views/admin.php");
}