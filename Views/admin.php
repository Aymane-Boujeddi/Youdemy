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
    $admin = new Admin("","","","","");
    $pendingTeachers = $admin->displayPendingTeacher();
    $Users = $admin->displayUsers();
    ?>
    <header>
        <nav class="navbar">
            <div class="nav-container">
                <div class="logo">
                    <h2>Youdemy Admin</h2>
                </div>
                <ul class="nav-links">

                    <li class="active" data-tab="teachers">
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
                    <li data-tab="statistics">
                        <i class="fas fa-chart-bar"></i>
                        <span>Statistics</span>
                    </li>
                    <li class="logout">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>Logout</span>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <main class="main-content">


        <section class="content-section active" id="teachers">
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
                    foreach($pendingTeachers as $teacher):
                    ?>
                        <tr>
                            <td><?= $teacher['username']?></td>
                            <td><?= $teacher['email']?></td>
                            <td>
                                <span class="status pending"><?= $teacher['status']?></span>
                            </td>
                            <td class="actions">
                                <a <?php echo "href='../Actions/teacherValidate.php?teacherID=" . $teacher['userID'] ."'";?>><button class="validate-btn"><i class="fas fa-check"></i></button></a>
                                <a <?php echo "href='../Actions/teacherRemove.php?teacherID=" . $teacher['userID'] . "'" ;?>><button class="reject-btn"><i class="fas fa-times"></i></button></a>

                            </td>
                        </tr>
                        <?php endforeach?>
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
                        foreach($Users as $user):
                        ?>
                        <tr>

                            <td><?= $user['username']?></td>
                            <td><?= $user['email']?></td>
                            <td><?= $user['role']?></td>
                            <td>
                               <form action="../Actions/" onchange="this.form.submit">
                               <select name="status" id="status" class="status-select">
                                    <option value="inactive">Inactive</option>
                                    <option value="active">Active</option>
                                </select>
                               </form>
                            </td>
                            <td class="actions">
                                <a href=""><button class="delete-btn"><i class="fas fa-trash"></i></button></a>
                            </td>
                        </tr>
                        <?php endforeach?>
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
                    <tbody>
                        <tr>
                            <td>Web Development Basics</td>
                            <td>John Doe</td>
                            <td>Programming</td>
                            <td>150</td>
                            <td class="actions">
                                <button class="view-btn"><i class="fas fa-eye"></i></button>
                                <button class="edit-btn"><i class="fas fa-edit"></i></button>
                                <button class="delete-btn"><i class="fas fa-trash"></i></button>
                            </td>
                        </tr>
                    </tbody>
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
                    <div class="category-card">
                        <div class="category-header">
                            <h3>Programming</h3>
                        </div>
                        <div class="category-actions">
                            <button class="delete-btn">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </div>

                    <div class="category-card">
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
                    </div>
                </div>
            </div>
        </section>

        <section class="content-section" id="tags">
            <h2>Tag Management</h2>
            <div class="tags-container">
                <div class="tags-actions">
                    <button class="add-btn">
                        <i class="fas fa-plus"></i>
                        Add Tag
                    </button>

                </div>
                <div class="tags-grid">
                    <div class="tag-item">
                        <span>JavaScript</span>
                        <div class="tag-actions">

                            <button class="delete-btn">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="tag-item">
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
                    </div>
                </div>
            </div>
        </section>

        <section class="content-section" id="statistics">
            <h2>Platform Statistics</h2>

            <div class="stats-cards">
                <div class="stat-card">
                    <i class="fas fa-book"></i>
                    <div class="stat-info">
                        <h3>Total Courses</h3>
                        <p>456</p>
                    </div>
                </div>
                <div class="stat-card">
                    <i class="fas fa-users"></i>
                    <div class="stat-info">
                        <h3>Total Students</h3>
                        <p>1,234</p>
                    </div>
                </div>
                <div class="stat-card">
                    <i class="fas fa-chalkboard-teacher"></i>
                    <div class="stat-info">
                        <h3>Total Teachers</h3>
                        <p>89</p>
                    </div>
                </div>
                <div class="stat-card">
                    <i class="fas fa-graduation-cap"></i>
                    <div class="stat-info">
                        <h3>Course Completions</h3>
                        <p>789</p>
                    </div>
                </div>
            </div>

            <div class="detailed-stats">
                <div class="stat-panel">
                    <h3>Course Distribution by Category</h3>
                    <div class="chart-container">
                        <canvas id="categoryChart"></canvas>
                    </div>
                </div>

                <div class="stat-panel">
                    <h3>Most Popular Courses</h3>
                    <div class="ranking-list">
                        <div class="ranking-item">
                            <div class="ranking-info">
                                <span class="rank">1</span>
                                <div class="course-info">
                                    <h4>Complete Web Development</h4>
                                    <p>John Doe</p>
                                </div>
                            </div>
                            <span class="stat-number">1,234 students</span>
                        </div>
                        <div class="ranking-item">
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
                        </div>
                    </div>
                </div>

                <div class="stat-panel">
                    <h3>Top 3 Teachers</h3>
                    <div class="ranking-list">
                        <div class="ranking-item">
                            <div class="ranking-info">
                                <span class="rank">1</span>
                                <div class="teacher-info">
                                    <h4>John Doe</h4>
                                    <p>Web Development</p>
                                </div>
                            </div>
                            <span class="stat-number">45 courses</span>
                        </div>
                        <div class="ranking-item">
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
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>


    <script src="../Assets/js/admin.js"></script>
</body>

</html>