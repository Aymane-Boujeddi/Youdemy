<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Assets/css/style.css">
    <title>Search Course</title>
</head>
<body>
<?php
    require_once "../Classes/Course";
    session_start();
    $button = "";
    $courseID = "";
    $teacherID = "";
    $enrollError = "";
    if (isset($_SESSION['id'])) {
        require_once "userHeader.php";
    } else {
        require_once "header.php";
    }
    if (isset($_SESSION['enroll_errors'])) {
        $enrollError = "<p>" . $_SESSION['enroll_errors'] . "</p>";
        unset($_SESSION['enroll_errors']);
    }
    $searchInput = "";
    if($_SERVER['REQUEST_METHOD'] == "GET" && isset($_GET['search'])){
        $searchInput = $_GET['search'];
    }
    $newCourse = new Course("", "", "", "", "");
    $courses = $newCourse->searchCourses($searchInput);
    

    ?>


<div class="search-container">
        <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="GET">
    <input type="text" placeholder="Search courses..." name="search" class="search-input">
    <button class="search-button"><i class="fas fa-search"></i></button>
    </form>
</div>
<?= $enrollError ?>
        <div class="courses-container" id="courses">
            <?php foreach ($courses as $course): ?>
                <div class="course-card">
                    <img src="https://images.unsplash.com/photo-1461749280684-dccba630e2f6" alt="Web Development Course">
                    <div class="course-info">
                        <h2><?= $course['title'] ?></h2>
                        <div class="category"><?= $course['title'] ?></div>
                        <div class="tags">
                            <?php $getTags = new Course("", "", "", "", "");
                            $tags = $getTags->getCourseTag($course['courseID']);
                            foreach ($tags as $tag) {
                                echo "<span>" . $tag['tag_name'] . "</span>";
                            }
                            ?>



                        </div>
                        <p class="instructor"><?= $course['username'] ?></p>
                        <p class="description"><?= $course['description'] ?></p>
                        <?php
                        $teacherID = $course['userID'];
                        $courseID = $course['courseID'];
                        if (isset($_SESSION['id']) && $_SESSION['status'] == 'active') {
                            echo "<a href='..Actions/enrollCourse.php?courseID=" . $courseID . "&userID=" . $_SESSION['id'] .  "'><button class='enroll-button'>Enroll Now</button></a>";
                        } elseif (isset($_SESSION['id']) && $_SESSION['status'] == 'inactive') {
                            echo "<a href='../Actions/enrollCourse.php?courseID=" . $courseID . "&userID=" . $_SESSION['id'] .  "'><button class='banned-button'>You are banned</button></a>";
                        } else {
                            echo "<a href='register.php'><button class='sign-up-now'>Sign Up Now</button></a>";
                        }
                        ?>
                    </div>
                </div>
            <?php endforeach ?>

            
        </div>
        <!-- <div class="pagination-wrapper">


            <div class="pagination">
                <a href="?start=<?= $current_page - 1 ?>#courses" class="prev-btn" <?= $current_page <= 1 ? 'disabled' : '' ?>>
                    <i class="fas fa-chevron-left"></i> Previous
                </a>
    
                <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                    <a href="?start=<?= $i ?>#courses" class="<?= $i == $current_page ? 'active' : '' ?>">
                        <?= $i ?>
                    </a>
                <?php endfor; ?>
    
                <a href="?start=<?= $current_page + 1 ?>#courses" class="next-btn" <?= $current_page >= $total_pages ? 'disabled' : '' ?>>
                    Next <i class="fas fa-chevron-right"></i>
                </a>
            </div>
        </div> -->


</body>
</html>