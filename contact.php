<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Contact Us - Campus Connect</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f7f9fc;
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
            text-decoration: none;
            padding: 14px 20px;
        }
        nav a:hover {
            background: #1abc9c;
        }
        .container {
            max-width: 600px;
            margin: 40px auto;
            background: white;
            padding: 30px;
            box-shadow: 0 0 15px rgba(0,0,0,0.05);
            border-radius: 8px;
        }
        h2 {
            text-align: center;
            color: #2c3e50;
        }
        label {
            display: block;
            margin-bottom: 6px;
            font-weight: bold;
            color: #333;
        }
        input, textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 15px;
        }
        textarea {
            resize: vertical;
            min-height: 100px;
        }
        button {
            width: 100%;
            background: #1abc9c;
            border: none;
            color: white;
            padding: 12px;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background: #16a085;
        }
        .success {
            text-align: center;
            color: green;
            margin-top: 20px;
        }
        .back-button {
            text-align: center;
            margin: 30px 0;
        }
        .back-button a {
            background: #2c3e50;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
        }
        .footer {
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

<div class="container">
    <h2>Contact Us</h2>
    <form method="post" action="">
        <label for="name">Your Name</label>
        <input type="text" name="name" required>

        <label for="email">Your Email</label>
        <input type="email" name="email" required>

        <label for="subject">Subject</label>
        <input type="text" name="subject" required>

        <label for="message">Message</label>
        <textarea name="message" required></textarea>

        <button type="submit" name="send">Send Message</button>
    </form>

    <?php
    if (isset($_POST['send'])) {
        $stmt = $conn->prepare("INSERT INTO contact_messages (name, email, subject, message) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $_POST['name'], $_POST['email'], $_POST['subject'], $_POST['message']);
        if ($stmt->execute()) {
            echo "<p class='success'>✅ Message sent successfully!</p>";
        } else {
            echo "<p class='success' style='color:red;'>❌ Failed to send message.</p>";
        }
    }
    ?>
</div>

<div class="back-button">
    <a href="index.php">⬅️ Back to Home</a>
</div>

<div class="footer">
    <p>&copy; 2025 Campus Connect. All rights reserved.</p>
</div>

</body>
</html>
