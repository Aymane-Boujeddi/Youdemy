<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Youdemy - Online Learning Platform</title>
    <link rel="stylesheet" href="Assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body>
    <?php
    require_once "Classes/Course";
    session_start();
    $button = "";
    $courseID = "";
    $teacherID = "";
    $enrollError = "";
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

    $newCourse = new Course("", "", "", "", "");
    if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['start'])) {
        $start = $_GET['start'];
        $courses = $newCourse->pagination($start, 4);
    } else {
        $courses = $newCourse->pagination(1, 4);
    }
    $total_rows = $newCourse->countCourses();
    $rows_per_page = 4;
    $total_pages = ceil($total_rows / $rows_per_page);

    $current_page = isset($_GET['start']) && is_numeric($_GET['start']) && $_GET['start'] > 0 ? (int)$_GET['start'] : 1;

    $start = ($current_page - 1) * $rows_per_page;

    ?>



    <main>
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
                            echo "<a href='Actions/enrollCourse.php?courseID=" . $courseID . "&userID=" . $_SESSION['id'] .  "'><button class='enroll-button'>Enroll Now</button></a>";
                        } elseif (isset($_SESSION['id']) && $_SESSION['status'] == 'inactive') {
                            echo "<a href='Actions/enrollCourse.php?courseID=" . $courseID . "&userID=" . $_SESSION['id'] .  "'><button class='banned-button'>You are banned</button></a>";
                        } else {
                            echo "<a href='Views/register.php'><button class='sign-up-now'>Sign Up Now</button></a>";
                        }
                        ?>
                    </div>
                </div>
            <?php endforeach ?>

            
        </div>
        <div class="pagination-wrapper">


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
        </div>



    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const urlParams = new URLSearchParams(window.location.search);
            const currentPage = parseInt(urlParams.get('start')) || 1;

            const paginationLinks = document.querySelectorAll('.pagination a');

            paginationLinks.forEach(link => {
                if (!link.classList.contains('prev-btn') && !link.classList.contains('next-btn')) {
                    const pageNum = parseInt(link.getAttribute('href').split('=')[1]);
                    if (pageNum === currentPage) {
                        link.classList.add('active');
                    }
                }

                if (link.classList.contains('prev-btn') && currentPage <= 1) {
                    link.classList.add('disabled');
                }
                if (link.classList.contains('next-btn') && currentPage >= <?= $total_pages ?>) {
                    link.classList.add('disabled');
                }
            });
        });
    </script>



</body>

</html>