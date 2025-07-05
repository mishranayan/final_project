<?php
session_start();

// Redirect if already logged in
if (isset($_SESSION['admin'])) {
    header("Location: admin/dashboard.php");
    exit();
}

$error = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $pass = $_POST['password'];

    // Replace with your actual admin credentials
    if ($email === "nayanmishra7464@gmail.com" && $pass === "12345678") {
        $_SESSION['admin'] = $email;
        header("Location: admin/dashboard.php");
        exit();
    } else {
        $error = "❌ Invalid email or password!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Login - Campus Connect</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, sans-serif;
            background: #f5f7fa;
            margin: 0;
            padding: 0;
        }
        header {
            background: #2c3e50;
            color: white;
            padding: 20px 0;
            text-align: center;
        }
        nav {
            display: flex;
            justify-content: center;
            background: #34495e;
            flex-wrap: wrap;
        }
        nav a {
            color: white;
            padding: 14px 20px;
            text-decoration: none;
        }
        nav a:hover {
            background-color: #1abc9c;
        }
        .login-box {
            max-width: 400px;
            margin: 50px auto;
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
        }
        .login-box h2 {
            text-align: center;
            color: #2c3e50;
        }
        input {
            width: 100%;
            padding: 12px;
            margin-top: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            width: 100%;
            background-color: #1abc9c;
            color: white;
            padding: 12px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }
        button:hover {
            background-color: #16a085;
        }
        .error {
            color: red;
            text-align: center;
            margin-top: 10px;
        }
        .back-button {
            text-align: center;
            margin-top: 20px;
        }
        .back-button a {
            background: #2c3e50;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            font-weight: bold;
            border-radius: 5px;
        }
        .footer {
            margin-top: 40px;
            background: #2c3e50;
            color: white;
            text-align: center;
            padding: 15px 0;
        }
    </style>
</head>
<body>

<header>
    <h1>Campus Connect</h1>
    <p>Your Gateway to College Club Activities</p>
</header>

<nav>
    <a href="index.php">Home</a>
    <a href="about.php">About</a>
    <a href="events.php">Events</a>
    <a href="register.php">Register</a>
    <a href="contact.php">Contact</a>
    <a href="login.php">Admin Login</a>
</nav>

<div class="login-box">
    <h2>Admin Login</h2>
    <form method="post">
        <input type="email" name="email" placeholder="Admin Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Login</button>
    </form>
    <?php if ($error) echo "<p class='error'>$error</p>"; ?>
</div>

<div class="back-button">
    <a href="index.php">⬅️ Back to Home</a>
</div>

<div class="footer">
    <p>&copy; 2025 Campus Connect. All rights reserved.</p>
</div>

</body>
</html>
