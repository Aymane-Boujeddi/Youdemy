<?php
session_start();
require_once "../Classes/CourseVideo";
require_once "../Classes/CourseText";
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $title = $_POST['title'];
    $desciption =  $_POST['description'];
    $category = $_POST['category'];
    $type = $_POST['type'];
    $tags = $_POST['tag'];
    $teacherID = $_POST['id'];

    if($type == "video"){

        $content = $_POST['contentVideo'];
        $newCourse = new CourseVideo($title,$category,$desciption,$teacherID,$type,$content);
        $newCourse->addCourse($tags);
        header("location: ../Views/teacher.php");
        exit();
           
    }
   
    
}