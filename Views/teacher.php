<?php
require_once "../Classes/Teacher";
// session_start();
// if(!isset($_SESSION['id']) && $_SESSION['role'] != 'teacher'){
// header("location: ../index.php");
// }

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Dashboard - Youdemy</title>
    <link rel="stylesheet" href="../Assets/css/teacher.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="../Assets/js/teacher.js" defer></script>
    <script src="../Assets/js/jquery-3.7.1.min.js" defer></script>
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
                <a href="../Actions/logout.php" class="logout-btn"><i class="fas fa-sign-out-alt"></i> Logout</a>
            </div>
        </nav>
    </header>

    <main class="dashboard-main">
        <section id="add-course" class="dashboard-section">
            <h2><i class="fas fa-plus-circle"></i> Add New Course</h2>
            <form id="newCourseForm" class="course-form">
                <div class="form-group">
                    <label for="courseTitle">Course Title</label>
                    <input type="text" id="courseTitle" name="title" required>
                </div>

                <div class="form-group">
                    <label for="courseDescription">Course Description</label>
                    <textarea id="courseDescription" name="description" rows="4" required></textarea>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="courseCategory">Category</label>
                        <select id="courseCategory" name="category" required>
                            <option value="">Select Category</option>
                            <option value="development">Development</option>
                            <option value="design">Design</option>
                            <option value="business">Business</option>
                            <option value="marketing">Marketing</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="courseType">Course Type</label>
                        <select id="courseType" name="type" required>
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
                                    <label class="tag">
                                        <input type="checkbox" name="tags['javascript']" value="javascript">
                                        <span>JavaScript</span>
                                    </label>
                                    <label class="tag">
                                        <input type="checkbox" name="tags['python']" value="python">
                                        <span>Python</span>
                                    </label>
                                    <label class="tag">
                                        <input type="checkbox" name="tags['java']" value="java">
                                        <span>Java</span>
                                    </label>
                                    <label class="tag">
                                        <input type="checkbox" name="tags[]" value="php">
                                        <span>PHP</span>
                                    </label>
                                </div>
                            </div>

                            <div class="tags-group">
                                <div class="tags-list">
                                    <label class="tag">
                                        <input type="checkbox" name="tags[]" value="html">
                                        <span>HTML</span>
                                    </label>
                                    <label class="tag">
                                        <input type="checkbox" name="tags[]" value="css">
                                        <span>CSS</span>
                                    </label>
                                    <label class="tag">
                                        <input type="checkbox" name="tags[]" value="react">
                                        <span>React</span>
                                    </label>
                                    <label class="tag">
                                        <input type="checkbox" name="tags[]" value="angular">
                                        <span>Angular</span>
                                    </label>
                                </div>
                            </div>

                            <div class="tags-group">
                                <div class="tags-list">
                                    <label class="tag">
                                        <input type="checkbox" name="tags[]" value="git">
                                        <span>Git</span>
                                    </label>
                                    <label class="tag">
                                        <input type="checkbox" name="tags[]" value="docker">
                                        <span>Docker</span>
                                    </label>
                                    <label class="tag">
                                        <input type="checkbox" name="tags[]" value="vscode">
                                        <span>VS Code</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="courseContent">Course Content</label>
                    <div id="contentInput">
                    </div>
                </div>

                <button type="submit" class="submit-btn">Create Course</button>
            </form>
        </section>

        <section id="manage-courses" class="dashboard-section" style="display: none;">
            <h2><i class="fas fa-tasks"></i> Manage Courses</h2>
            <div class="search-bar">
                <input type="text" id="courseSearch" placeholder="Search courses...">
            </div>

            <div class="courses-grid">
            </div>
        </section>

        <section id="statistics" class="dashboard-section" style="display: none;">
            <h2><i class="fas fa-chart-bar"></i> Course Statistics</h2>
            <div class="stats-grid">
                <div class="stat-card">
                    <i class="fas fa-book-open"></i>
                    <div class="stat-info">
                        <h3>Total Courses</h3>
                        <p id="totalCourses">0</p>
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
                    <i class="fas fa-star"></i>
                    <div class="stat-info">
                        <h3>Average Rating</h3>
                        <p id="averageRating">0.0</p>
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
    </main>
    <script>
        const courseType = document.getElementById('courseType');
        const contentInput = document.getElementById('contentInput');

        courseType.addEventListener('change', function() {
            if (this.value === 'video') {
                contentInput.innerHTML = `
                <input type="url" name="content" placeholder="Enter video URL" required>
            `;
            } else if (this.value === 'document') {
                contentInput.innerHTML = `
                <textarea name="content" rows="6" placeholder="Enter your course content here..." required></textarea>
            `;
            } else {
                contentInput.innerHTML = '';
            }
        });
    </script>
</body>

</html>