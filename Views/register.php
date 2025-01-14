<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - Youdemy</title>
    <link rel="stylesheet" href="../Assets/css/auth.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body>
    <div class="modal">
        <div class="modal-content">
            <h2>Create Your Account</h2>
            <form action="register.php" method="POST" class="signup-form">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" required>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                </div>

                <div class="form-group">
                    <label for="confirm_password">Confirm Password</label>
                    <input type="password" id="confirm_password" name="confirm_password" required>
                </div>

                <div class="form-group">
                    <label for="role">I want to</label>
                    <select id="role" name="role" required>
                        <option value="">Select your role</option>
                        <option value="student">Learn as a Student</option>
                        <option value="teacher">Teach as an Instructor</option>
                    </select>
                </div>

                <button type="submit" class="submit-btn">Create Account</button>
            </form>
            <p class="login-link">Already have an account? <a href="login.php" id="loginLink">Sign In</a></p>
        </div>
    </div>
</body>

</html>