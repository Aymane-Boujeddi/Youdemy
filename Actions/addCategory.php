<?php
require_once "../Classes/Category";
if($_SERVER["REQUEST_METHOD"] == "POST"){

    $category = $_POST["category"];
    $newCategory = new Category($category);

    $newCategory->addCategory();
    header("location: ../Views/admin.php");
}