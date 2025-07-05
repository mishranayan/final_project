<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Events - Campus Connect</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        /* same styling as before */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background: #f7f9fc;
        }
        header, nav, .footer {
            background: #2c3e50;
            color: white;
            padding: 15px;
            text-align: center;
        }
        nav {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            background: #34495e;
        }
        nav a {
            color: white;
            text-decoration: none;
            padding: 14px 20px;
        }
        nav a:hover {
            background-color: #1abc9c;
        }
        .event-container {
            max-width: 1000px;
            margin: 30px auto;
            padding: 0 20px;
        }
        .event-card {
            background: white;
            border-radius: 8px;
            margin-bottom: 20px;
            padding: 20px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.05);
            transition: 0.3s;
        }
        .event-card h3 {
            margin-top: 0;
        }
        .event-date {
            color: #1abc9c;
            font-weight: bold;
        }
        .register-btn {
            display: inline-block;
            margin-top: 10px;
            background: #1abc9c;
            color: white;
            padding: 10px 18px;
            text-decoration: none;
            border-radius: 5px;
        }
        .register-btn:hover {
            background: #16a085;
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

<div class="event-container">
    <h2 style="text-align:center; color:#2c3e50;">Upcoming Events</h2>

    <?php
    $result = $conn->query("SELECT * FROM events ORDER BY event_date ASC");
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<div class='event-card'>
                    <h3>{$row['title']}</h3>
                    <p>{$row['description']}</p>
                    <p class='event-date'>Date: " . date("F d, Y", strtotime($row['event_date'])) . "</p>
                    <a class='register-btn' href='register.php?event_id={$row['id']}'>Register Now</a>
                  </div>";
        }
    } else {
        echo "<p style='text-align:center; color:#999;'>No upcoming events at the moment.</p>";
    }
    ?>
</div>

<div class="footer">
    <p>&copy; 2025 Campus Connect. All rights reserved.</p>
</div>

</body>
</html>
