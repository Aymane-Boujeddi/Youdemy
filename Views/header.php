<header>
        <nav class="navbar">
            <div class="logo">
                <h1>Youdemy</h1>
                <?PHP
                $url = $_SERVER['REQUEST_URI'];
                $urlExplode = explode('youdemy/youdemy/', $url);
                $currentPage = $urlExplode[1];
                $link = "";
                if($currentPage == "index.php"){
                    $link = "Views/";
                }

                ?>
            </div>
            <div class="auth-buttons">
               <a href="<?=$link?>login.php"><button class="sign-in-btn" >Sign In</button></a> 
               <a href="<?=$link?>register.php"><button class="sign-up-btn" >Sign Up</button></a> 
               <a href="<?=$link?>search.php"><button class="sign-up-btn" >Search</button></a> 
            </div>
        </nav>

        <div class="intro-section">
        <h2>Welcome to Youdemy</h2>
        <p>Your Gateway to Knowledge and Growth</p>
        <div class="intro-features">
            <div class="feature">
                <i class="fas fa-graduation-cap"></i>
                <span>Expert-Led Courses</span>
            </div>
            <div class="feature">
                <i class="fas fa-certificate"></i>
                <span>Earn Certificates</span>
            </div>
            <div class="feature">
                <i class="fas fa-clock"></i>
                <span>Learn at Your Pace</span>
            </div>
        </div>
    </div>
    </header>