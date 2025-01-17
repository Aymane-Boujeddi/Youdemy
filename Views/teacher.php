<?php
require_once "../Classes/Teacher";
require_once "../Classes/Category";
require_once "../Classes/Tags";
session_start();
if (isset($_SESSION['id'])) {
    $teacherID = $_SESSION['id'];
}
$errors = [];
if(isset($_SESSION['errors']) && !empty($_SESSION['errors'])){
    $errors = $_SESSION['errors'];
    unset($_SESSION['errors']);
}
// if(!isset($_SESSION['id']) && $_SESSION['role'] != 'teacher'){
// header("location: ../index.php");
// }
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
                <a href="#add-course" class="active"><i class="fas fa-plus-circle"></i> Add Course</a>
                <a href="#manage-courses"><i class="fas fa-tasks"></i> Manage Courses</a>
                <a href="#statistics"><i class="fas fa-chart-bar"></i> Statistics</a>
                <a href="#enrollments"><i class="fas fa-user-graduate"></i> Enrollments</a>
                <a href="../Actions/logout.php" class="logout-btn"><i class="fas fa-sign-out-alt"></i> Logout</a>
            </div>
        </nav>
    </header>

    <main class="dashboard-main">
        <section id="add-course" class="dashboard-section">
            <h2><i class="fas fa-plus-circle"></i> Add New Course</h2>
            <form id="newCourseForm" class="course-form" action="../Actions/addCourse.php" method="POST">
                <?php foreach($errors as $error){
                    
                } ?>

                <div class="form-group">
                    <label for="courseTitle">Course Title</label>
                    <input type="text" id="courseTitle" name="title" >
                    <input type="hidden" name="id" value=<?= '"' . $teacherID . '"' ?>>
                </div>

                <div class="form-group">
                    <label for="courseDescription">Course Description</label>
                    <textarea id="courseDescription" name="description" rows="4" ></textarea>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="courseCategory">Category</label>
                        <select id="courseCategory" name="category" >
                            <option value="" >Select a category</option>
                            <?php foreach ($categories as $category): ?>
                                <option value=<?= '"' . $category['categoryID'] . '"' ?>><?= $category['category_name'] ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="courseType">Course Type</label>
                        <select id="courseType" name="type">
                            <option value="">Select Type</option>
                            <option value="video">Video Course</option>
                            <option value="document">Document Based</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label>Course Tags</label>
                    <div class="tags-wrapper">

                        <div class="tags-container">
                            <div class="tags-group">

                                <div class="tags-list">
                                    <?php foreach ($tags as $tag): ?>
                                        <label class="tag">
                                            <input type="checkbox" <?= 'name="tag[' . $tag["tagID"] . ']"' ?> value="<?= $tag['tagID'] ?>">
                                            <span><?= $tag['tag_name'] ?></span>
                                        </label>
                                    <?php endforeach ?>

                                </div>
                            </div>



                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="courseContent">Course Content</label>
                    <div id="contentInput">
                        <input id="contentvid" type="url" name="contentVideo" placeholder="Enter video URL" style="display: none;">
                        <textarea id="contentdoc" name="contentText" rows="6" placeholder="Enter your course content here..." style="display: none;"></textarea>
                    </div>
                </div>

                <button type="submit" class="submit-btn">Create Course</button>
                <button type="submit" class="cancel-btn" onclick="this.form.reset()">Cancel</button>
            </form>
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
                                    <button class="edit-btn" title="Edit Course">
                                        <i class="fas fa-edit"></i>
                                    </button>
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

        const navLinks = document.querySelectorAll('.nav-links a');
        const sections = document.querySelectorAll('.dashboard-section');

        navLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                if (!this.classList.contains('logout-btn')) {
                    e.preventDefault();

                    // Remove active class from all links
                    navLinks.forEach(link => link.classList.remove('active'));

                    // Add active class to clicked link
                    this.classList.add('active');

                    // Hide all sections
                    sections.forEach(section => {
                        section.style.display = 'none';
                    });

                    // Show the corresponding section
                    const targetId = this.getAttribute('href').substring(1);
                    document.getElementById(targetId).style.display = 'block';
                }
            });
        });

        // Show first section by default
        document.getElementById('add-course').style.display = 'block';
    </script>
</body>

</html>