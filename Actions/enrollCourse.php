<?php
 require_once "../Classes/Student";

if($_SERVER["REQUEST_METHOD"] == "GET"){
    $courseID = $_GET['courseID'];
    $studentID = $_GET['userID'];
    echo $studentID;
    echo $courseID;
    
   

    $student = new Student("","","","","");
    echo $student->alreadyEnrolled($studentID,$courseID);
    session_start();
   if($student->alreadyEnrolled($studentID,$courseID)){
    $_SESSION['enroll_errors'] = "You are already enrolled in this course";
    header("location: ../index.php");
    exit();
   }else{
       $student->enrollToCourse($courseID,$studentID);
       header("location: ../Views/student.php");
       exit();
    }

}