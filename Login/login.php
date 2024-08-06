<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login/Signup</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <div class="container">
        <div class="image-section">
            <!-- Add your image here -->
            <img src="./assets/admin.jpg" alt="Background Image">
        </div>
        <div class="form-section">
            <div id="login-form">
                <h2>Login</h2>
                <form>
                    <label for="login-email">Email:</label>
                    <input type="email" id="login-email" name="email" required>
                    <label for="login-password">Password:</label>
                    <input type="password" id="login-password" name="password" required>
                    <button type="submit">Login</button>
                </form>
                <button id="toggle-signup">Sign Up</button>
            </div>

            <div id="signup-form" style="display: none;">
                <h2>Sign Up</h2>
                <form>
                    <label for="signup-email">Email:</label>
                    <input type="email" id="signup-email" name="email" required>
                    <label for="signup-password">Password:</label>
                    <input type="password" id="signup-password" name="password" required>
                    <button type="submit">Sign Up</button>
                </form>
                <button id="toggle-login">Login</button>
            </div>
        </div>
    </div>
    <script src="login.js"></script>
</body>
</html>
