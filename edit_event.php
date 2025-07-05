<?php
session_start();
include '../db.php';
if (!isset($_SESSION['admin'])) {
    header("Location: ../login.php");
    exit();
}

$id = $_GET['id'];
$event = $conn->query("SELECT * FROM events WHERE id = $id")->fetch_assoc();

if (isset($_POST['update'])) {
    $title = $_POST['title'];
    $desc = $_POST['description'];
    $date = $_POST['event_date'];

    $stmt = $conn->prepare("UPDATE events SET title=?, description=?, event_date=? WHERE id=?");
    $stmt->bind_param("sssi", $title, $desc, $date, $id);
    if ($stmt->execute()) {
        echo "<script>alert('✅ Event updated successfully!'); window.location='dashboard.php';</script>";
    } else {
        echo "<p style='color:red;'>❌ Update failed.</p>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Event</title>
    <style>
        body { font-family: Arial; background: #f7f9fc; }
        .container {
            max-width: 600px; margin: 50px auto; background: white;
            padding: 30px; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        input, textarea {
            width: 100%; padding: 10px; margin-bottom: 20px;
            border: 1px solid #ccc; border-radius: 5px;
        }
        button {
            background: #1abc9c; color: white; padding: 10px 20px;
            border: none; border-radius: 5px; cursor: pointer;
        }
        button:hover { background: #16a085; }
        .back { text-align: center; margin-top: 20px; }
        .back a {
            background: #2c3e50; color: white; padding: 10px 20px;
            text-decoration: none; border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Edit Event</h2>
        <form method="post">
            <input type="text" name="title" value="<?= htmlspecialchars($event['title']) ?>" required>
            <textarea name="description" required><?= htmlspecialchars($event['description']) ?></textarea>
            <input type="date" name="event_date" value="<?= $event['event_date'] ?>" required>
            <button type="submit" name="update">Update Event</button>
        </form>

        <div class="back">
            <a href="dashboard.php">⬅ Back to Dashboard</a>
        </div>
    </div>
</body>
</html>
