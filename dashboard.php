<?php
session_start();
include '../db.php';
if (!isset($_SESSION['admin'])) {
    header("Location: ../login.php");
    exit();
}

// ✅ Handle Event Deletion
if (isset($_GET['delete_event'])) {
    $id = intval($_GET['delete_event']);
    $del = $conn->prepare("DELETE FROM events WHERE id = ?");
    $del->bind_param("i", $id);
    if ($del->execute()) {
        echo "<p style='color:green;'>✅ Event deleted successfully!</p>";
        echo "<script>setTimeout(() => window.location = 'dashboard.php', 1000);</script>";
    } else {
        echo "<p style='color:red;'>❌ Delete failed.</p>";
    }
}

// ✅ Handle New Event Addition
if (isset($_POST['add_event'])) {
    $title = $_POST['title'];
    $desc = $_POST['description'];
    $date = $_POST['event_date'];

    // Check for duplicates
    $check = $conn->prepare("SELECT id FROM events WHERE title = ? AND event_date = ?");
    $check->bind_param("ss", $title, $date);
    $check->execute();
    $check->store_result();

    if ($check->num_rows > 0) {
        echo "<p style='color:red;'>❌ Duplicate event already exists with the same title and date.</p>";
    } else {
        $stmt = $conn->prepare("INSERT INTO events (title, description, event_date) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $title, $desc, $date);
        if ($stmt->execute()) {
            echo "<p style='color:green;'>✅ Event added successfully!</p>";
            echo "<script>setTimeout(() => window.location='dashboard.php', 1000);</script>";
        } else {
            echo "<p style='color:red;'>❌ Error adding event.</p>";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard - Campus Connect</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f9;
            margin: 0;
        }
        .container {
            max-width: 1100px;
            margin: 30px auto;
            background: white;
            padding: 30px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            border-radius: 8px;
        }
        h2 {
            color: #2c3e50;
            margin-top: 40px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ddd;
        }
        th {
            background: #1abc9c;
            color: white;
        }
        .logout {
            text-align: right;
            margin-bottom: 20px;
        }
        .logout a {
            background: #e74c3c;
            color: white;
            padding: 8px 15px;
            text-decoration: none;
            border-radius: 5px;
        }
        .form-section {
            margin-top: 40px;
        }
        input, textarea {
            width: 100%;
            padding: 10px;
            margin: 8px 0 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            background: #1abc9c;
            color: white;
            padding: 10px 18px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background: #16a085;
        }
        a.action-link {
            margin-right: 10px;
            text-decoration: none;
            font-weight: bold;
        }
        a.edit {
            color: blue;
        }
        a.delete {
            color: red;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="logout">
        Logged in as <b><?php echo $_SESSION['admin']; ?></b> |
        <a href="logout.php">Logout</a>
    </div>

    <!-- ✅ Registered Users -->
    <h2>Registered Users</h2>
    <table>
        <tr>
            <th>Name</th><th>Email</th><th>Phone</th><th>Event</th>
        </tr>
        <?php
        $res = $conn->query("SELECT r.name, r.email, r.phone, e.title FROM registrations r JOIN events e ON r.event_id = e.id");
        while ($row = $res->fetch_assoc()) {
            echo "<tr><td>{$row['name']}</td><td>{$row['email']}</td><td>{$row['phone']}</td><td>{$row['title']}</td></tr>";
        }
        ?>
    </table>

    <!-- ✅ Add New Event -->
    <div class="form-section">
        <h2>Add New Event</h2>
        <form method="post">
            <input type="text" name="title" placeholder="Event Title" required>
            <textarea name="description" placeholder="Event Description" required></textarea>
            <input type="date" name="event_date" required>
            <button type="submit" name="add_event">Add Event</button>
        </form>
    </div>

    <!-- ✅ List Events with Edit/Delete -->
    <div class="form-section">
        <h2>All Events</h2>
        <table>
            <tr>
                <th>Title</th><th>Date</th><th>Description</th><th>Actions</th>
            </tr>
            <?php
            $events = $conn->query("SELECT * FROM events ORDER BY event_date ASC");
            while ($ev = $events->fetch_assoc()) {
                echo "<tr>
                    <td>{$ev['title']}</td>
                    <td>{$ev['event_date']}</td>
                    <td>{$ev['description']}</td>
                    <td>
                        <a class='action-link edit' href='edit_event.php?id={$ev['id']}'>🖊️ Edit</a>
                        <a class='action-link delete' href='?delete_event={$ev['id']}' onclick=\"return confirm('Are you sure you want to delete this event?');\">❌ Delete</a>
                    </td>
                </tr>";
            }
            ?>
        </table>
    </div>

    <!-- ✅ Contact Messages -->
    <div class="form-section">
        <h2>Contact Messages</h2>
        <table>
            <tr>
                <th>Name</th><th>Email</th><th>Subject</th><th>Message</th><th>Date</th>
            </tr>
            <?php
            $msg = $conn->query("SELECT * FROM contact_messages ORDER BY created_at DESC");
            while ($m = $msg->fetch_assoc()) {
                echo "<tr>
                    <td>{$m['name']}</td>
                    <td>{$m['email']}</td>
                    <td>{$m['subject']}</td>
                    <td>{$m['message']}</td>
                    <td>{$m['created_at']}</td>
                </tr>";
            }
            ?>
        </table>
    </div>

</div>

</body>
</html>
