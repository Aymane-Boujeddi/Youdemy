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
if($_SERVER['REQUEST_METHOD'] == "GET"){

}
?>
<body>
    <section id="add-course" class="dashboard-section">
        <h2><i class="fas fa-plus-circle"></i> Add New Course</h2>
        <form id="newCourseForm" class="course-form" action="../Actions/addCourse.php" method="POST">
            <?php foreach ($errors as $error): ?>
                <div class="error-message"><?= htmlspecialchars($error) ?></div>
            <?php endforeach; ?>

            <div class="form-group">
                <label for="courseTitle">Course Title</label>
                <input type="text" id="courseTitle" name="title" required>
                <input type="hidden" name="id" value="<?= htmlspecialchars($teacherID) ?>">
            </div>

            <div class="form-group">
                <label for="courseDescription">Course Description</label>
                <textarea id="courseDescription" name="description" rows="4" required></textarea>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="courseCategory">Category</label>
                    <select id="courseCategory" name="category" required>
                        <option value="">Select a category</option>
                        <?php foreach ($categories as $category): ?>
                            <option value="<?= htmlspecialchars($category['categoryID']) ?>"><?= htmlspecialchars($category['category_name']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="courseType">Course Type</label>
                    <select id="courseType" name="type" required onchange="toggleContentInput()">
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
                                        <input type="checkbox" name="tag[<?= htmlspecialchars($tag['tagID']) ?>]" value="<?= htmlspecialchars($tag['tagID']) ?>">
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
                    <input id="contentvid" type="url" name="contentVideo" placeholder="Enter video URL" style="display: none;">
                    <textarea id="contentdoc" name="contentText" rows="6" placeholder="Enter your course content here..." style="display: none;"></textarea>
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