<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>About Us - Campus Connect</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f6f9;
        }
        header {
            background-color: #2c3e50;
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
            display: block;
        }
        nav a:hover {
            background-color: #1abc9c;
        }
        .about-section {
            max-width: 900px;
            margin: 40px auto;
            background: white;
            padding: 30px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
            border-radius: 8px;
        }
        .about-section h2 {
            text-align: center;
            color: #2c3e50;
        }
        .about-section p {
            line-height: 1.8;
            font-size: 1.1em;
            color: #444;
        }
        .mission {
            background-color: #ecf0f1;
            padding: 20px;
            margin-top: 30px;
            border-left: 5px solid #1abc9c;
        }
        .footer {
            background-color: #2c3e50;
            color: white;
            text-align: center;
            padding: 15px 0;
            margin-top: 50px;
        }
        @media (max-width: 768px) {
            .about-section {
                margin: 20px;
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

    <section class="about-section">
        <h2>About Campus Connect</h2>
        <p>
            Campus Connect is a vibrant student club dedicated to building a strong and engaging campus community. We organize
            fun, educational, and meaningful events throughout the academic year to encourage student involvement, creativity,
            and leadership. Our goal is to bring together like-minded individuals who are passionate about making a positive
            impact both on campus and beyond.
        </p>

        <div class="mission">
            <h3>Our Mission</h3>
            <p>
                To foster a culture of collaboration, learning, and growth through inclusive and diverse student-led initiatives.
                We aim to empower every student to develop their potential while contributing to a lively and supportive campus
                environment.
            </p>
        </div>

        <div class="mission">
            <h3>Our Vision</h3>
            <p>
                To be recognized as the heart of student engagement and leadership at our college—uniting students through
                shared passions and unforgettable experiences.
            </p>
        </div>
    </section>

    <div class="footer">
        <p>&copy; 2025 Campus Connect. All rights reserved.</p>
    </div>

</body>
</html>
