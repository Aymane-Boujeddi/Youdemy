<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
    <link rel="stylesheet" href="../Assets/css/student.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<?php
session_start();
require_once "../Classes/Student";
$userMessage = "";
if (isset($_SESSION['id']) && $_SESSION['status'] == 'active') {
    $userMessage = "<span>Welcome, " . $_SESSION['username'] . "</span>";
} elseif (isset($_SESSION['id']) && $_SESSION['status'] == 'inactive') {
    $userMessage = "<span style='color: red;'>You are banned , " . $_SESSION['username'] . "</span>";
} else {
    header("location: ../index.php");
    exit();
}
$student = new Student("","","","","");
$enrolledCourses = $student->enrolledCourses($_SESSION['id']);
?>

<body>
    <div class="dashboard">
        <header>
            <nav class="navbar">
                <div class="nav-content">
                    <h1>Student Dashboard</h1>
                    <ul class="nav-links">
                        <li><a class="nav-link" onclick="setActive('#my-courses')"><i class="fas fa-graduation-cap"></i> My Courses</a></li>
                        <li><a class="nav-link active" onclick="setActive('#course-catalog')"><i class="fas fa-book"></i> Course Catalog</a></li>
                        <li><a class="nav-link" onclick="setActive('#course-search')"><i class="fas fa-search"></i> Search Courses</a></li>
                        <li><a href="../Actions/logout.php" class="logout-btn"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
                    </ul>
                    <div class="user-info">
                        <?= $userMessage?>
                    </div>
                </div>
            </nav>
        </header>

        <section id="course-catalog" class="dashboard-section" style="display: none;">
            <h2><i class="fas fa-book"></i> Available Courses</h2>
            <div class="courses-grid">
                <div class="course-card">
                    <div class="course-header">
                        <h3>Web Development Basics</h3>
                        <span class="course-category">Programming</span>
                    </div>
                    <div class="course-info">
                        <p class="instructor"><i class="fas fa-user"></i> John Doe</p>
                        <p class="description">Learn web development from scratch...</p>
                    </div>
                    <button class="enroll-btn">Enroll Now</button>
                </div>
            </div>
        </section>

        <section id="course-search" class="dashboard-section" style="display: none;">
            <h2><i class="fas fa-search"></i> Search Courses</h2>
            <div class="search-container">
                <div class="search-box">
                    <input type="text" placeholder="Search courses...">
                    <select>
                        <option value="">All Categories</option>
                        <option value="programming">Programming</option>
                        <option value="design">Design</option>
                        <option value="business">Business</option>
                    </select>
                    <button class="search-btn"><i class="fas fa-search"></i> Search</button>
                </div>
                <div class="search-results">
                </div>
            </div>
        </section>

        <section id="my-courses" class="dashboard-section">
            <h2><i class="fas fa-graduation-cap"></i> My Courses</h2>
            <div class="enrolled-courses">
                <?php foreach($enrolledCourses as $course):?>
                <div class="course-card enrolled">
                    <div class="course-header">
                        <h3><?= $course['title']?></h3>
                        <span class="course-category"><?= $course['category_name']?></span>
                    </div>
                    <div class="course-info">
                        <p class="instructor"><i class="fas fa-user"></i><?= $course['teacher']?></p>
                        <p class="progress">Progress: 60%</p>
                        <div class="progress-bar">
                            <div class="progress-fill" style="width: 60%"></div>
                        </div>
                    </div>
                    <button class="continue-btn">Continue Learning</button>
                </div>
                <?php endforeach?>
            </div>
        </section>
    </div>

    <script>
        const navLinks = document.querySelectorAll('.nav-link');
        const sections = document.querySelectorAll('.dashboard-section');

        function setActive(sectionId) {
            const targetId = sectionId.replace('#', '');

            navLinks.forEach(l => l.classList.remove('active'));
            sections.forEach(s => s.style.display = 'none');

            document.getElementById(targetId).style.display = 'block';
            document.querySelector(`[onclick*="#${targetId}"]`).classList.add('active');

            localStorage.setItem('activeTab', targetId);
        }

        document.addEventListener('DOMContentLoaded', () => {
            const activeTab = localStorage.getItem('activeTab') || 'course-catalog';
            setActive(activeTab);
        });
    </script>
</body>

</html>