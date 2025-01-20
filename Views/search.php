<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Course</title>
</head>
<body>
<?php
session_start();
if (isset($_SESSION['id'])) {
    require_once "Views/userHeader.php";
    $button = "<a href='Action/enrollCourse.php?courseID=" . $courseID . "&userID=" . $teacherID .  "'><button class='enroll-button'>Enroll Now</button></a>";
} else {
    $button = "<a href='Views/register.php'><button class='sign-up-now'>Sign Up Now</button></a>";
    require_once "Views/header.php";
}
if (isset($_SESSION['enroll_errors'])) {
    $enrollError = "<p>" . $_SESSION['enroll_errors'] . "</p>";
    unset($_SESSION['enroll_errors']);
}
?>    

</body>
</html>