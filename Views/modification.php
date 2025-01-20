<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Modification Page</title>
    <link rel="stylesheet" href="../Assets/css/modification.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<?php
session_start();
require_once "../Classes/Course";
require_once "../Classes/CourseText";
require_once "../Classes/CourseVideo";
require_once "../Classes/Category";
require_once "../Classes/Tags";
if ($_SERVER['REQUEST_METHOD'] == "GET") {
    $courseID = $_GET['courseID'];
    $courseInstance = new Course("", "", "", "", "");
    $tagsInstance = new Tags("");
    $tags = $tagsInstance->displayTags();
    $categoryInstance = new Category("");
    $categories = $categoryInstance->displayGategories();
    $courseType = $courseInstance->getCourseType($courseID);
    $errors = [];
    if ($courseType['content_type'] === "video") {
        $courseVideo = new CourseVideo("", "", "", "", "", "");
        $courseInfo = $courseVideo->displayCourse($courseID);
        var_dump($courseInfo);
        $courseTags = $courseInstance->getCourseTag($courseID);
    } elseif ($courseType['content_type'] === "document") {
        $courseText = new CourseText("", "", "", "", "", "");
        $courseInfo = $courseText->displayCourse($courseID);
        var_dump($courseInfo);
        
        $courseTags = $courseInstance->getCourseTag($courseID);
    }
    $_SESSION['course_type'] = $courseInfo['content_type'];
 
   
    
    
}
?>

<body>
    <section id="add-course" class="dashboard-section">
        <h2><i class="fas fa-pen-to-square"></i> Modify Course</h2>
        <form id="newCourseForm" class="course-form" action="../Actions/modifyCourse.php" method="POST">
            <?php foreach ($errors as $error): ?>
                <div class="error-message"><?= htmlspecialchars($error) ?></div>
            <?php endforeach; ?>

            <div class="form-group">
                <label for="courseTitle">Course Title</label>
                <input type="text" id="courseTitle" name="title" value="<?= $courseInfo['title'] ?>" >
                <input type="hidden" name="id" value="<?= htmlspecialchars($courseInfo['courseID']) ?>">
            </div>

            <div class="form-group">
                <label for="courseDescription">Course Description</label>
                <textarea id="courseDescription" name="description" rows="4" value="<?= $courseInfo['description'] ?>" placeholder="" required><?= $courseInfo['description'] ?></textarea>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="courseCategory">Category</label>
                    <select id="courseCategory" name="category" required>
                        <option value="">Select a category</option>
                        <?php foreach ($categories as $category): ?>
                            <option value="<?= htmlspecialchars($category['categoryID']) ?>"
                                <?= ($category['categoryID'] == $courseInfo['categoryID']) ? 'selected' : '' ?>>
                                <?= htmlspecialchars($category['category_name']) ?>
                            </option>
                        <?php endforeach; ?>

                    </select>
                </div>
                <div class="form-group">
                    <label for="courseType">Course Type</label>
                    <select id="courseType" name="type" required onchange="toggleContentInput()">
                        <option value="" <?= empty($courseType['content_type']) ? 'selected' : '' ?>>Select Type</option>
                        <option value="video" <?= ($courseType['content_type'] == "video") ? 'selected' : '' ?>>Video Course</option>
                        <option value="document" <?= ($courseType['content_type'] == "document") ? 'selected' : '' ?>>Document Based</option>
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
                                        <input
                                            type="checkbox"
                                            name="tag[<?= htmlspecialchars($tag['tagID']) ?>]"
                                            value="<?= htmlspecialchars($tag['tagID']) ?>"
                                            <?php if (in_array($tag['tagID'], array_column($courseTags, 'tagID'))) echo 'checked'; ?>>
                                        <span><?= htmlspecialchars($tag['tag_name']) ?></span>
                                    </label>
                                <?php endforeach; ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="courseContent">Course Content</label>
                <div id="contentInput">
                    
                <input id="contentvid" type="url" name="contentVideo" placeholder="<?= ($courseType['content_type'] == "video") ? $courseInfo['course_content'] : 'Enter video URL'?>" style="display: none;">
                    <textarea id="contentdoc" name="contentText" rows="6" placeholder="" style="display: none;"><?= ($courseType['content_type'] == "document") ? $courseInfo['course_content'] : 'Enter your course content here...'?></textarea>
                </div>
            </div>

            <div class="form-actions">
                <button type="submit" class="submit-btn">Create Course</button>
                <button type="button" class="cancel-btn" onclick="document.getElementById('newCourseForm').reset()">Cancel</button>
            </div>
        </form>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const courseType = document.getElementById('courseType');
            const videoInput = document.getElementById('contentvid');
            const docInput = document.getElementById('contentdoc');

            function toggleContentInput() {
                if (courseType.value === 'video') {
                    videoInput.style.display = 'block';
                    docInput.style.display = 'none';
                    videoInput.required = true;
                    docInput.required = false;
                } else if (courseType.value === 'document') {
                    videoInput.style.display = 'none';
                    docInput.style.display = 'block';
                    videoInput.required = false;
                    docInput.required = true;
                } else {
                    videoInput.style.display = 'none';
                    docInput.style.display = 'none';
                    videoInput.required = false;
                    docInput.required = false;
                }
            }

            courseType.addEventListener('change', toggleContentInput);

            toggleContentInput();
        });
    </script>
</body>

</html>