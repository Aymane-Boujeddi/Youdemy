<?php
session_start();
require_once "../Classes/CourseVideo";
require_once "../Classes/CourseText";
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $title = $_POST['title'];
    $desciption =  $_POST['description'];
    $category = $_POST['category'];
    $type = $_POST['type'];
    $tags = isset($_POST['tag']) ? $_POST['tag'] : [];;
    $teacherID = $_POST['id'];
    echo $teacherID;

    if($type == "video"){

        $content = $_POST['contentVideo'];
        $newCourse = new CourseVideo($title,$category,$desciption,$teacherID,$type,$content);
        $newCourse->addCourse($tags);
        $_SESSION['errors'] = $newCourse->getErrors();
        header("location: ../Views/teacher.php");
        exit();
           
    } elseif($type == "document"){
        $content = $_POST['contentText'];
        $newCourse = new CourseText($title,$category,$desciption,$teacherID,$type,$content);
        $newCourse->addCourse($tags);
        $_SESSION['errors'] = $newCourse->getErrors();
        header("location: ../Views/teacher.php");
        exit();
    }else{
        $_SESSION['errors'] = ["The Type is required"];
        header("location: ../Views/teacher.php");
        exit();
    }
   
    
}