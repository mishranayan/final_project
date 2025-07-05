<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register - Campus Connect</title>
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
        input, select {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
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
        @media (max-width: 480px) {
    .container {
        margin: 20px;
        padding: 20px;
    }
    nav a {
        padding: 10px;
        font-size: 14px;
    }
    button {
        font-size: 14px;
    }
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
    <h2>Event Registration Form</h2>
    <form method="post" action="">
        <label for="name">Full Name</label>
        <input type="text" name="name" required>

        <label for="email">Email Address</label>
        <input type="email" name="email" required>

        <label for="phone">Phone Number</label>
        <input type="text" name="phone" pattern="[0-9]{10}" maxlength="10" placeholder="Enter 10-digit mobile number" required>


        <label for="event">Select Event</label>
        <select name="event_id" required>
            <option value="">-- Select an Event --</option>
            <?php
            $selected = isset($_GET['event_id']) ? $_GET['event_id'] : '';
            $res = $conn->query("SELECT * FROM events");
            while($event = $res->fetch_assoc()) {
                $isSelected = ($selected == $event['id']) ? "selected" : "";
                echo "<option value='{$event['id']}' $isSelected>{$event['title']}</option>";
            }
            ?>
        </select>

        <button type="submit" name="register">Submit Registration</button>
    </form>

    <?php
   if (isset($_POST['register'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $event_id = $_POST['event_id'];

    // ✅ Server-side phone validation
    if (!preg_match("/^[0-9]{10}$/", $phone)) {
        echo "<p style='color:red;'>❌ Invalid phone number. Please enter a valid 10-digit number.</p>";
        exit;
    }

    $stmt = $conn->prepare("INSERT INTO registrations (name, email, phone, event_id) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("sssi", $name, $email, $phone, $event_id);
    if ($stmt->execute()) {
        echo "<p class='success'>✅ Registration Successful!</p>";
    } else {
        echo "<p class='success' style='color:red;'>❌ Failed to register. Please try again.</p>";
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
