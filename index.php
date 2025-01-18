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
        $button = "<a href='Action/enrollCourse.php?courseID=". $courseID . "&userID=" . $teacherID .  "'><button class='enroll-button'>Enroll Now</button></a>";
    } else {
        $button = "<a href='Views/register.php'><button class='sign-up-now'>Sign Up Now</button></a>";

        require_once "Views/header.php";
    }
    if(isset($_SESSION['enroll_errors'])){
        $enrollError = "<p>" . $_SESSION['enroll_errors'] . "</p>";
        unset($_SESSION['enroll_errors']);
    }
    
    $newCourse = new Course("","","","","");
    $courses = $newCourse->getAllCourses();

    ?>



    <main>
        <?= $enrollError?>
        <div class="courses-container">
            <?php foreach($courses as $course):?>
            <div class="course-card">
                <img src="https://images.unsplash.com/photo-1461749280684-dccba630e2f6" alt="Web Development Course">
                <div class="course-info">
                    <h2><?= $course['title']?></h2>
                    <div class="category"><?= $course['title']?></div>
                    <div class="tags">
                        <?php $getTags = new Course("","","","","");
                              $tags = $getTags->getCourseTag($course['courseID']);
                              foreach($tags as $tag){
                                echo "<span>" . $tag['tag_name'] . "</span>";
                              }
                        ?>
                        
                        
                       
                    </div>
                    <p class="instructor"><?= $course['username']?></p>
                    <p class="description"><?= $course['description']?></p>
                    <?php
                    $teacherID = $course['userID'];
                    $courseID = $course['courseID'];
                    if (isset($_SESSION['id']) && $_SESSION['status'] == 'active') {
                        echo"<a href='Actions/enrollCourse.php?courseID=". $courseID . "&userID=" . $_SESSION['id'] .  "'><button class='enroll-button'>Enroll Now</button></a>";
                    }elseif(isset($_SESSION['id']) && $_SESSION['status'] == 'inactive'){
                        echo"<a href='Actions/enrollCourse.php?courseID=". $courseID . "&userID=" . $_SESSION['id'] .  "'><button class='banned-button'>You are banned </button></a>";
                    } else {
                        echo "<a href='Views/register.php'><button class='sign-up-now'>Sign Up Now</button></a>";
                
                    }
                     ?>
                </div>
            </div>
            <?php endforeach ?>

            <!-- <div class="course-card">
                <img src="https://images.unsplash.com/photo-1542831371-29b0f74f9713" alt="Python Course">
                <div class="course-info">
                    <h2>Python for Data Science</h2>
                    <div class="category">Data Science</div>
                    <div class="tags">
                        <span>Python</span>
                        <span>Pandas</span>
                        <span>NumPy</span>
                    </div>
                    <p class="instructor">By Michael Chen</p>
                    <p class="description">Learn Python programming with focus on data analysis and visualization.</p>
                </div>
            </div>

            <div class="course-card">
                <img src="https://images.unsplash.com/photo-1551434678-e076c223a692" alt="UI Design Course">
                <div class="course-info">
                    <h2>UI/UX Design Masterclass</h2>
                    <div class="category">Design</div>
                    <div class="tags">
                        <span>Figma</span>
                        <span>Adobe XD</span>
                        <span>UI Design</span>
                    </div>
                    <p class="instructor">By Emma Davis</p>
                    <p class="description">Create beautiful and functional user interfaces with modern design principles.</p>
                </div>
            </div>

            <div class="course-card">
                <img src="https://images.unsplash.com/photo-1526374965328-7f61d4dc18c5" alt="Cybersecurity Course">
                <div class="course-info">
                    <h2>Cybersecurity Fundamentals</h2>
                    <div class="category">Security</div>
                    <div class="tags">
                        <span>Network</span>
                        <span>Security</span>
                        <span>Ethical Hacking</span>
                    </div>
                    <p class="instructor">By Alex Thompson</p>
                    <p class="description">Learn essential cybersecurity concepts and protect against digital threats.</p>
                </div>
            </div>

            <div class="course-card">
                <img src="https://images.unsplash.com/photo-1506748686214-e9df14d4d9d0" alt="Data Science Course">
                <div class="course-info">
                    <h2>Data Science Masterclass</h2>
                    <div class="category">Data Science</div>
                    <div class="tags">
                        <span>Python</span>
                        <span>Machine Learning</span>
                        <span>Data Analysis</span>
                    </div>
                    <p class="instructor">By Alex Smith</p>
                    <p class="description">Dive deep into data science with hands-on projects and expert guidance.</p>
                    <button class="sign-up-now">Sign Up Now</button>
                </div>
            </div> -->
        </div>

        <div class="pagination">
            <button class="prev">Previous</button>
            <div class="page-numbers">
                <span class="active">1</span>
                <span>2</span>
                <span>3</span>
                <span>4</span>
            </div>
            <button class="next">Next</button>
        </div>

        </div>



    </main>



</body>

</html>