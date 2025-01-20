<?php
require_once "../Classes/Teacher";
require_once "../Classes/Category";
require_once "../Classes/Tags";
session_start();
if (isset($_SESSION['id'])) {
    $teacherID = $_SESSION['id'];
}
$errors = [];
if (isset($_SESSION['errors']) && !empty($_SESSION['errors'])) {
    $errors = $_SESSION['errors'];
    unset($_SESSION['errors']);
}
if(isset($_SESSION['id']) && $_SESSION['role'] == 'student'){
    header("location: ./student.php");
    exit();
}elseif(isset($_SESSION['id']) && $_SESSION['role'] == 'admin'){
    header("location: ./admin.php");
    exit();
}elseif(!isset($_SESSION['id'])){
    header("location: ../index.php");
    exit();
}
$category = new Category("");
$tag = new Tags("");
$categories = $category->displayGategories();
$tags = $tag->displayTags();
$teacher = new teacher("", "", "", "", "");
$courses = $teacher->displayCourses($teacherID);
$courseCount = $teacher->courseCount($teacherID);



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Dashboard - Youdemy</title>
    <link rel="stylesheet" href="../Assets/css/teacher.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

</head>

<body>
    <header>
        <nav class="navbar">
            <div class="logo">
                <h1>Youdemy</h1>
            </div>
            <div class="nav-links">
                <a class="nav-link active" onclick="setActive('#add-course')">
                    <i class="fas fa-plus-circle"></i> Add Course
                </a>
                <a class="nav-link" onclick="setActive('#manage-courses')">
                    <i class="fas fa-tasks"></i> Manage Courses
                </a>
                <a class="nav-link" onclick="setActive('#statistics')">
                    <i class="fas fa-chart-bar"></i> Statistics
                </a>
                <a class="nav-link" onclick="setActive('#enrollments')">
                    <i class="fas fa-user-graduate"></i> Enrollments
                </a>
                <a href="../Actions/logout.php" class="logout-btn">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
            </div>
        </nav>
    </header>

    <main class="dashboard-main">
        <section id="add-course" class="dashboard-section">
            <?php if ($_SESSION['status'] == 'active'): ?>
                <h2><i class='fas fa-plus-circle'></i> Add New Course</h2>
                <form id='newCourseForm' class='course-form' action='../Actions/addCourse.php' method='POST'>
                    <?php foreach ($errors as $error): ?>
                        <div class='error-alert'>
                            <i class='fas fa-exclamation-circle'></i>
                            <span><?php echo htmlspecialchars($error); ?></span>
                        </div>
                    <?php endforeach; ?>

                    <div class='form-group'>
                        <label for='courseTitle'>Course Title</label>
                        <input type='text' id='courseTitle' name='title'>
                        <input type='hidden' name='id' value='<?= $teacherID ?>'>
                    </div>

                    <div class='form-group'>
                        <label for='courseDescription'>Course Description</label>
                        <textarea id='courseDescription' name='description' rows='4'></textarea>
                    </div>

                    <div class='form-row'>
                        <div class='form-group'>
                            <label for='courseCategory'>Category</label>
                            <select id='courseCategory' name='category'>
                                <option value=''>Select a category</option>
                                <?php foreach ($categories as $category): ?>
                                    <option value='<?= $category['categoryID'] ?>'><?= $category['category_name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class='form-group'>
                            <label for='courseType'>Course Type</label>
                            <select id='courseType' name='type'>
                                <option value=''>Select Type</option>
                                <option value='video'>Video Course</option>
                                <option value='document'>Document Based</option>
                            </select>
                        </div>
                    </div>

                    <div class='form-group'>
                        <label>Course Tags</label>
                        <div class='tags-wrapper'>
                            <div class='tags-container'>
                                <div class='tags-group'>
                                    <div class='tags-list'>
                                        <?php foreach ($tags as $tag): ?>
                                            <label class='tag'>
                                                <input type='checkbox' name='tag[<?= $tag['tag_name'] ?>]' value='<?= $tag['tagID'] ?>'>
                                                <span><?= $tag['tag_name'] ?></span>
                                            </label>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class='form-group'>
                        <label for='courseContent'>Course Content</label>
                        <div id='contentInput'>
                            <input id='contentvid' type='url' name='contentVideo' placeholder='Enter video URL' style='display: none;'>
                            <textarea id='contentdoc' name='contentText' rows='6' placeholder='Enter your course content here...' style='display: none;'></textarea>
                        </div>
                    </div>

                    <button type='submit' class='submit-btn'>Create Course</button>
                    <button type='submit' class='cancel-btn' onclick='this.form.reset()'>Cancel</button>
                </form>
            <?php else: ?>
                <div class="inactive-alert">
                    <i class="fas fa-exclamation-triangle"></i>
                    <h3>Account Inactive</h3>
                    <p>Your account is currently inactive. Please contact the administrator for assistance.</p>
                </div>
            <?php endif; ?>

        </section>

        <section id="manage-courses" class="dashboard-section" style="display: none;">
            <h2><i class="fas fa-tasks"></i> Manage Courses</h2>
            <div class="table-container">
                <div class="table-header">
                    <input type="text" id="courseSearch" placeholder="Search courses...">
                </div>
                <table class="courses-table">
                    <thead>
                        <tr>
                            <th>Course Title</th>
                            <th>Category</th>
                            <th>Type</th>
                            <th>Students</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($courses as $course): ?>

                            
                            <tr>
                                <td><?= $course['title'] ?></td>
                                <td><?= $course['category_name'] ?></td>
                                <td><?= $course['content_type'] ?></td>
                                <td></td>
                                <td class="action-buttons">
                                    <button class="view-btn" title="View Details">
                                        <i class="fas fa-eye"></i>
                                    </button>   
                                    <a href="./modification.php?courseID=<?=$course['courseID']?>"><button class="edit-btn" title="Edit Course">
                                        <i class="fas fa-edit"></i>
                                    </button></a>
                                    <button class="delete-btn" title="Delete Course">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </section>

        <section id="statistics" class="dashboard-section" style="display: none;">
            <h2><i class="fas fa-chart-bar"></i> Course Statistics</h2>
            <div class="stats-grid">
                <div class="stat-card">
                    <i class="fas fa-book-open"></i>
                    <div class="stat-info">
                        <h3>Total Courses</h3>
                        <p id="totalCourses"><?= $courseCount['course_count'] ?></p>
                    </div>
                </div>

                <div class="stat-card">
                    <i class="fas fa-users"></i>
                    <div class="stat-info">
                        <h3>Total Students</h3>
                        <p id="totalStudents">0</p>
                    </div>
                </div>


                <div class="stat-card">
                    <i class="fas fa-certificate"></i>
                    <div class="stat-info">
                        <h3>Course Completions</h3>
                        <p id="courseCompletions">0</p>
                    </div>
                </div>
            </div>


        </section>

        <section id="enrollments" class="dashboard-section" style="display: none;">
            <h2><i class="fas fa-user-graduate"></i> Course Enrollments</h2>
            <div class="table-container">

                <table class="enrollments-table">
                    <thead>
                        <tr>
                            <th>Student Name</th>
                            <th>Course</th>
                            <th>Enrollment Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <div class="student-info">
                                    <span>John Doe</span>
                                </div>
                            </td>
                            <td>Web Development Basics</td>
                            <td>Jan 15, 2024</td>
                        </tr>


                    </tbody>
                </table>
            </div>
        </section>
    </main>
    <script>
        const courseType = document.getElementById('courseType')
        const contentInput = document.getElementById('contentInput')
        const vidContent = document.getElementById('contentvid')
        const docContent = document.getElementById('contentdoc')

        courseType.addEventListener('change', function() {
            if (this.value === 'video') {
                docContent.style.display = 'none'
                vidContent.style.display = 'block'
            } else if (this.value === 'document') {
                docContent.style.display = 'block'
                vidContent.style.display = 'none'
            } else {
                docContent.style.display = 'none'
                vidContent.style.display = 'none'
            }
        });

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
            const activeTab = localStorage.getItem('activeTab') || 'add-course';
            setActive(activeTab);
        });
    </script>
</body>

</html>