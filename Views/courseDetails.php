<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Details</title>
    <link rel="stylesheet" href="../Assets/css/courseDetails.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body>
    <?php
    session_start();
    require_once "../Classes/Course";
    require_once "../Classes/CourseVideo";
    require_once "../Classes/CourseText";
    require_once "../Classes/User";
    require_once "../Classes/Render";
    if($_SERVER['REQUEST_METHOD'] == "GET"){
        $courseID = $_GET['ID'];
        $courseInstance = new Course("","","","","","");
        $courseVideoInstance = new CourseVideo("","","","","","");
        $courseTextInstance = new CourseText("","","","","","");
        $courseType = $courseInstance->getCourseType($courseID);
        $courseTags = $courseInstance->getCourseTag($courseID);
        $course = "";
       
        if($courseType['content_type'] == "video"){
            $courseInfo = $courseVideoInstance->displayCourse($courseID);
            $course = Render::displayCourseVideo($courseInfo['username'],$courseInfo['title'],$courseInfo['description'],$courseInfo['category_name'],$courseTags,$courseInfo['course_content']);
        }elseif($courseType['content_type'] == "document"){
            $courseInfo = $courseTextInstance->displayCourse($courseID);
            $course = Render::displayCourseText($courseInfo['username'],$courseInfo['title'],$courseInfo['description'],$courseInfo['category_name'],$courseTags,$courseInfo['course_content']);
        }


        

    }
    ?>
   <?=$course?>
</body>

</html>