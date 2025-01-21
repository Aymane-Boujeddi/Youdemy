<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Youdemy</title>
    <link rel="stylesheet" href="../Assets/css/admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body>
    <?php
    require_once "../Classes/Admin";
    require_once "../Classes/Render";
    require_once "../Classes/Category";
    require_once "../Classes/Tags";
    session_start();
    if (isset($_SESSION['id']) && $_SESSION['role'] == 'student') {
        header("location: ./student.php");
        exit();
    } elseif (isset($_SESSION['id']) && $_SESSION['role'] == 'teacher') {
        header("location: ./teacher.php");
        exit();
    } elseif (!isset($_SESSION['id'])) {
        header("location: ../index.php");
        exit();
    }
    $adminInstance = new Admin("", "", "", "", "");
    $pendingTeachers = $adminInstance->displayPendingTeacher();
    $Users = $adminInstance->displayUsers();
    $categroyInstance = new Category("");
    $categories = $categroyInstance->displayGategories();
    $tagInstance = new Tags("");
    $tags = $tagInstance->displayTags();
    $courses = $adminInstance->getCoursesForAdmin();
    $numberOfCourses = $adminInstance->numberOfCourses();
    $numberOfStudents = $adminInstance->numberOfStudents();
    $numberOfTeachers = $adminInstance->numberOfTeachers();
    $numberOfEnrollements = $adminInstance->numberOfenrollements();
    $popularCourses = $adminInstance->popularCourses();
    $topTeachers = $adminInstance->popularTeachers();
    $topCategories = $adminInstance->coursesByCategory();
    

    ?>
    <header>
        <nav class="navbar">
            <div class="nav-container">
                <div class="logo">
                    <h2>Youdemy Admin</h2>
                </div>
                <ul class="nav-links">

                    <li data-tab="teachers">
                        <i class="fas fa-chalkboard-teacher"></i>
                        <span>Teachers</span>
                    </li>
                    <li data-tab="users">
                        <i class="fas fa-users"></i>
                        <span>Users</span>
                    </li>
                    <li data-tab="courses">
                        <i class="fas fa-book"></i>
                        <span>Courses</span>
                    </li>
                    <li data-tab="categories">
                        <i class="fas fa-folder"></i>
                        <span>Categories</span>
                    </li>
                    <li data-tab="tags">
                        <i class="fas fa-tags"></i>
                        <span>Tags</span>
                    </li>
                    <li data-tab="statistics" class="active">
                        <i class="fas fa-chart-bar"></i>
                        <span>Statistics</span>
                    </li>
                    <a href="../Actions/logout.php" class="logout">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>Logout</span>
                    </a>
                </ul>
            </div>
        </nav>
    </header>

    <main class="main-content">


        <section class="content-section " id="teachers">
            <h2>Teacher Validate</h2>
            <div class="table-container">

                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($pendingTeachers as $teacher):
                        ?>
                            <tr>
                                <td><?= $teacher['username'] ?></td>
                                <td><?= $teacher['email'] ?></td>
                                <td>
                                    <span class="status pending"><?= $teacher['user_status'] ?></span>
                                </td>
                                <td class="actions">
                                    <a <?php echo "href='../Actions/teacherValidate.php?teacherID=" . $teacher['userID'] . "'"; ?>><button class="validate-btn"><i class="fas fa-check"></i></button></a>
                                    <a <?php echo "href='../Actions/userRemove.php?userID=" . $teacher['userID'] . "'"; ?>><button class="reject-btn"><i class="fas fa-times"></i></button></a>

                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </section>
        <section class="content-section" id="users">
            <h2>User Management</h2>
            <div class="table-container">

                <table class="data-table">
                    <thead>
                        <tr>

                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($Users as $user) {

                            echo Render::renderuserForAdmin($user);
                        }
                        ?>


                    </tbody>
                </table>
            </div>
        </section>

        <section class="content-section" id="courses">
            <h2>Course Management</h2>
            <div class="table-container">

                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Teacher</th>
                            <th>Category</th>
                            <th>Students</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <?php foreach ($courses as $course): ?>
                        <tbody>
                            <tr>
                                <td><?= $course['title'] ?></td>
                                <td><?= $course['username'] ?></td>
                                <td><?= $course['category_name'] ?></td>
                                <td><?= $course['students'] ?></td>
                                <td class="actions">
                                <a href="courseDetails.php?ID=<?= $course['courseID'] ?>"><button class="view-btn" title="View Details">
                                                <i class="fas fa-eye"></i>
                                            </button> </a>
                                        <a href="./modification.php?courseID=<?= $course['courseID'] ?>"><button class="edit-btn" title="Edit Course">
                                                <i class="fas fa-edit"></i>
                                            </button></a>
                                        <a href="../Actions/deleteCourse.php?courseID=<?= $course['courseID'] ?>"><button class="delete-btn" title="Delete Course">
                                                <i class="fas fa-trash"></i>
                                            </button></a>
                                </td>
                            </tr>
                        </tbody>
                    <?php endforeach ?>
                </table>
            </div>
        </section>


        <section class="content-section" id="categories">
            <h2>Category Management</h2>
            <div class="category-container">
                <div class="action-header">
                    <button class="primary-btn">
                        <span class="btn-icon">
                            <i class="fas fa-plus"></i>
                        </span>
                        <span class="btn-text">Add New Category</span>
                    </button>
                </div>
                <div class="categories-grid">
                    <?php foreach ($categories as $category): ?>
                        <div class="category-card">
                            <div class="category-header">
                                <h3><?= $category['category_name'] ?></h3>
                            </div>
                            <div class="category-actions">
                                <a <?= "href='../Actions/deleteCategory.php?ID=" . $category['categoryID'] . "'" ?>>
                                    <button class="delete-btn">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </a>
                            </div>
                        </div>
                    <?php endforeach ?>
                    <!-- <div class="category-card">
                        <div class="category-header">
                            <h3>Design</h3>
                        </div>
                        <div class="category-actions">
                            <button class="delete-btn">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </div>

                    <div class="category-card">
                        <div class="category-header">
                            <h3>Business</h3>
                        </div>
                        <div class="category-actions">
                            <button class="delete-btn">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </div> -->
                </div>
            </div>
        </section>

        <div class="modal" id="categoryModal">
            <div class="modal-content">
                <div class="modal-header">
                    <h3>Add New Category</h3>
                    <button class="close-btn" id="closeModal">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <form id="categoryForm" class="modal-form" action="../Actions/addCategory.php" method="POST">
                    <div class="form-group">
                        <label for="categoryName">Category Name</label>
                        <input type="text" id="categoryName" name="category" required
                            placeholder="Enter category name">
                    </div>
                    <div class="form-actions">
                        <button type="submit" class="submit-btn">
                            <i class="fas fa-check"></i>
                            Save Category
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <section class="content-section" id="tags">
            <h2>Tag Management</h2>
            <div class="tags-container">
                <div class="tags-actions">
                    <button class="primary-btn" id="addTagBtn">
                        <span class="btn-icon">
                            <i class="fas fa-plus"></i>
                        </span>
                        <span class="btn-text">Add New Tags</span>
                    </button>
                </div>
                <div class="tags-grid">
                    <?php foreach ($tags as $tag): ?>
                        <div class="tag-item">
                            <span><?= $tag['tag_name'] ?></span>
                            <div class="tag-actions">

                                <a <?= 'href="../Actions/deleteTags.php?tagID=' . $tag['tagID'] . '"' ?>><button class="delete-btn">
                                        <i class="fas fa-times"></i>
                                    </button></a>
                            </div>
                        </div>
                    <?php endforeach ?>
                    <!-- <div class="tag-item">
                        <span>Python</span>
                        <div class="tag-actions">

                            <button class="delete-btn">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="tag-item">
                        <span>Web Development</span>
                        <div class="tag-actions">

                            <button class="delete-btn">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="tag-item">
                        <span>UI/UX Design</span>
                        <div class="tag-actions">

                            <button class="delete-btn">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="tag-item">
                        <span>Machine Learning</span>
                        <div class="tag-actions">

                            <button class="delete-btn">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div> -->
                </div>
            </div>
        </section>

        <div class="modal" id="tagModal">
            <div class="modal-content">
                <div class="modal-header">
                    <h3>Add New Tags</h3>
                    <button class="close-btn" id="closeTagModal">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <form id="tagForm" class="modal-form" action="../Actions/addTags.php" method="POST">
                    <div class="form-group">
                        <label for="tagNames">Tags (Separate with commas)</label>
                        <textarea
                            id="tagNames"
                            name="tags"
                            required
                            placeholder="Enter tags (e.g., JavaScript, Python, Web Development)"
                            rows="5"></textarea>
                        <small class="form-hint">Enter multiple tags separated by commas</small>
                    </div>
                    <div class="form-actions">
                        <button type="submit" class="submit-btn">
                            <i class="fas fa-check"></i>
                            Save Tags
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <section class="content-section active" id="statistics">
            <h2>Platform Statistics</h2>

            <div class="stats-cards">
                <div class="stat-card">
                    <i class="fas fa-book"></i>
                    <div class="stat-info">
                        <h3>Total Courses</h3>
                        <p><?=$numberOfCourses['total_courses']?></p>
                    </div>
                </div>
                <div class="stat-card">
                    <i class="fas fa-users"></i>
                    <div class="stat-info">
                        <h3>Total Students</h3>
                        <p><?=$numberOfStudents['total_students']?></p>
                    </div>
                </div>
                <div class="stat-card">
                    <i class="fas fa-chalkboard-teacher"></i>
                    <div class="stat-info">
                        <h3>Total Teachers</h3>
                        <p><?=$numberOfTeachers['total_teachers']?></p>
                    </div>
                </div>
                <div class="stat-card">
                    <i class="fas fa-graduation-cap"></i>
                    <div class="stat-info">
                        <h3>Course Enrollements</h3>
                        <p><?=$numberOfEnrollements['total_enroll']?></p>
                    </div>
                </div>
            </div>

            <div class="detailed-stats">
                <div class="stat-panel">
                    <h3>Course Distribution by Category</h3>
                    <div class="chart-container">
                        <?php foreach($topCategories as $category): ?>
                            <div class="category-item">
                                <div class="category-info">
                                    <span class="category-name"><?=$category['category_name']?></span>
                                    <span class="category-count"><?=$category['category']?> courses</span>
                                </div>
                            </div>
                        <?php endforeach; ?>


                    </div>
                </div>

                <div class="stat-panel">
                    <h3>Most Popular Courses</h3>
                    <div class="ranking-list">
                        <?php $number = 0;
                        foreach($popularCourses as $course):?>
                        <div class="ranking-item">
                            <div class="ranking-info">
                                <span class="rank"><?=$number+=1?></span>
                                <div class="course-info">
                                    <h4><?=$course['title']?></h4>
                                    <p><?=$course['username']?></p>
                                </div>
                            </div>
                            <span class="stat-number"><?=$course['students'] . " students"?> </span>
                        </div>
                        <?php endforeach;?>

                        <!-- <div class="ranking-item">
                            <div class="ranking-info">
                                <span class="rank">2</span>
                                <div class="course-info">
                                    <h4>Python Masterclass</h4>
                                    <p>Jane Smith</p>
                                </div>
                            </div>
                            <span class="stat-number">987 students</span>
                        </div>
                        <div class="ranking-item">
                            <div class="ranking-info">
                                <span class="rank">3</span>
                                <div class="course-info">
                                    <h4>UI/UX Design Basics</h4>
                                    <p>Mike Johnson</p>
                                </div>
                            </div>
                            <span class="stat-number">756 students</span>
                        </div> -->
                    </div>
                </div>

                <div class="stat-panel">
                    <h3>Top 3 Teachers</h3>
                    <div class="ranking-list">
                        <?php $number = 0;
                        foreach($topTeachers as $teacher):
                            ?>
                        <div class="ranking-item">
                            <div class="ranking-info">
                                <span class="rank"><?=$number+=1?></span>
                                <div class="teacher-info">
                                    <h4><?=$teacher['username']?></h4>
                                   
                                </div>
                            </div>
                            <span class="stat-number"><?=$teacher['total_courses'] . " courses"?></span>
                        </div>
                        <?php endforeach;?>
                        <!-- <div class="ranking-item">
                            <div class="ranking-info">
                                <span class="rank">2</span>
                                <div class="teacher-info">
                                    <h4>Jane Smith</h4>
                                    <p>Programming</p>
                                </div>
                            </div>
                            <span class="stat-number">38 courses</span>
                        </div>
                        <div class="ranking-item">
                            <div class="ranking-info">
                                <span class="rank">3</span>
                                <div class="teacher-info">
                                    <h4>Mike Johnson</h4>
                                    <p>Design</p>
                                </div>
                            </div>
                            <span class="stat-number">32 courses</span>
                        </div> -->
                    </div>
                </div>
            </div>
        </section>
    </main>


    <script src="../Assets/js/admin.js"></script>
</body>

</html>