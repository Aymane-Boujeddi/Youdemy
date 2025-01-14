<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In - Youdemy</title>
    <link rel="stylesheet" href="../Assets/css/auth.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body>
    <div class="modal">
        <div class="modal-content">
            <h2>Welcome Back</h2>
            <form action="../Actions/signIn.php" method="POST" class="signin-form">
                <div class="form-group">
                    <label for="login-email">Email</label>
                    <input type="email" id="login-email" name="email" required>
                </div>

                <div class="form-group">
                    <label for="login-password">Password</label>
                    <input type="password" id="login-password" name="password" required>
                </div>

                <button type="submit" class="submit-btn">Sign In</button>
            </form>
            <p class="register-link">Don't have an account? <a href="register.php" id="registerLink">Sign Up</a></p>
        </div>
    </div>
    <script src="Assets/js/script.js"></script>
</body>

</html>