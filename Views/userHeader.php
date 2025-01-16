
<header>
        <nav class="navbar">
            <div class="logo">
                <h1>Youdemy</h1>
            </div>
            <div class="auth-buttons">
            <a href="#"><button class="profile-btn" ><i class="fa fa-user"><?= (isset($_SESSION['username'])) ? $_SESSION['username'] : ''?></i></button></a> 
            <a href="<?= 'Views/' . $_SESSION['role'] . '.php  '?>"><button class="dashboard-btn" ><i class="fa fa-dashboard">Dashboard</i></button></a> 
            <a href="Actions/logout.php"><button class="logout-btn"><i class="fa-solid fa-left-from-bracket">Logout</i></button></a>
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