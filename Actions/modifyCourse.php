<?php
session_start();
require_once "../Classes/Course";
require_once "../Classes/CourseText";
require_once "../Classes/CourseVideo";
if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION['course_type'])){
    $title = $_POST['title'];
    $courseID = $_POST['id'];
    $userID = $_SESSION['id'];
    $description = $_POST['description'];
    $category = $_POST['category'];
    $content_text = $_POST['contentText'];
    $content_video = $_POST['contentVideo'];
    $tags = (empty($_POST['tag'])) ? [] : $_POST['tag'];
    $type = $_POST['type'];
    $courseVideoInstance = new CourseVideo("","","","","","","");
    $courseTextInstance = new CourseText("","","","","","","");
    $courseInstance = new Course("","","","","","");
    $redirectPage = $_SESSION['role'] . ".php";

    // echo $title . "title". "<br>";
    // echo $description . "description". "<br>";
    // echo $category . "category". "<br>";
    // echo $content_text . "content_text". "<br>";
    // echo $content_video .  "content_video" ."<br>";
    // echo $type . "type". "<br>";
    // echo $userID . "userID". "<br>";
    // echo $courseID . "courseID". "<br>";
    // var_dump($tags);
//    if($type == "video"){
//     if($_SESSION['course_type'] != $type ){
//         $deleteContent = $courseVideoInstance->deleteContent($courseID);
//         $updateCourseInfo = $courseInstance->updateCourseInfo($courseID,$type,$title,$description,$category,$tags);
//         $updateCourseContent = $courseTextInstance->addCourseContent($courseID,$content_text);
//         header("location: ../Views/$redirectPage");
//         exit();
        
//     }elseif($_SESSION['course_type'] == $type ){
       
//         $updateCourseInfo = $courseInstance->updateCourseInfo($courseID,$type,$title,$description,$category,$tags);
//         $updateCourseContent = $courseVideoInstance->updateContent($courseID,$content_video);
//         header("location: ../Views/$redirectPage");
//         exit();
        
//     }

//    }elseif($type == "document"){

//     if($_SESSION['course_type'] != $type ){
//         $deleteContent = $courseTextInstance->deleteContent($courseID);
//         $updateCourseInfo = $courseInstance->updateCourseInfo($courseID,$type,$title,$description,$category,$tags);
//         $updateCourseContent = $courseVideoInstance->addCourseContent($courseID,$content_video);
//         header("location: ../Views/$redirectPage");
//         exit();

        
//     }elseif($_SESSION['course_type'] == $type ){

//         $updateCourseInfo = $courseInstance->updateCourseInfo($courseID,$type,$title,$description,$category,$tags);
//         $updateCourseContent = $courseTextInstance->updateContent($courseID,$content_text);
//         header("location: ../Views/$redirectPage");
//         exit();
        
//     }
//    }



if ($type == "video") {
    $contentInstance = $courseVideoInstance;
    $content = $content_video;
} elseif ($type == "document") {
    $contentInstance = $courseTextInstance;
    $content = $content_text;
} else {
    die("Invalid course type.");
}

if ($_SESSION['course_type'] != $type) {
    $deleteContent = $contentInstance->deleteContent($courseID);

    $updateCourseInfo = $courseInstance->updateCourseInfo($courseID, $type, $title, $description, $category, $tags);

    $updateCourseContent = $contentInstance->addCourseContent($courseID, $content);
} else {
    $updateCourseInfo = $courseInstance->updateCourseInfo($courseID, $type, $title, $description, $category, $tags);

    $updateCourseContent = $contentInstance->updateContent($courseID, $content);
}

header("location: ../Views/$redirectPage");


    
}