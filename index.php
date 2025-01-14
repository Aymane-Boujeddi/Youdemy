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
    <header>
        <nav class="navbar">
            <div class="logo">
                <h1>Youdemy</h1>
            </div>
            <div class="auth-buttons">
               <a href="Views/login.php"><button class="sign-in-btn" >Sign In</button></a> 
               <a href="Views/register.php"><button class="sign-up-btn" >Sign Up</button></a> 
            </div>
        </nav>

        <div class="search-section">
            <h2>Expand Your Knowledge</h2>
            <p>Learn from thousands of experienced instructors</p>
            <div class="search-bar">
                <input type="text" placeholder="What do you want to learn today?">
                <button><i class="fas fa-search"></i> Search</button>
            </div>
        </div>
    </header>

    <main>
        <div class="courses-container">
            <div class="course-card">
                <img src="https://images.unsplash.com/photo-1461749280684-dccba630e2f6" alt="Web Development Course">
                <div class="course-info">
                    <h2>Advanced Web Development Bootcamp</h2>
                    <div class="category">Development</div>
                    <div class="tags">
                        <span>React</span>
                        <span>Node.js</span>
                        <span>MongoDB</span>
                    </div>
                    <p class="instructor">By Sarah Johnson</p>
                    <p class="description">Master modern web development with this comprehensive full-stack course.</p>
                </div>
            </div>

            <div class="course-card">
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