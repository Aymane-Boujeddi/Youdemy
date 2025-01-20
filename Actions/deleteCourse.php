<?php 
require_once "../Classes/Course";
session_start();
if($_SERVER["REQUEST_METHOD"] == "GET"){
    $courseID = $_GET['courseID'];

    $courseInstance = new Course("","","","","","");
    $deleteCourse = $courseInstance->deleteCourse($courseID);
    $redirectPage = $_SESSION['role'] . ".php";
    header("location: ../Views/$redirectPage");
    exit();

}