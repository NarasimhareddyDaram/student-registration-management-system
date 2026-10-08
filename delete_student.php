<?php

session_start();

require_once "config/database.php";

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    die("Access denied.");
}

if (!isset($_GET['id'])) {
    die("Student ID missing.");
}

$id = $_GET['id'];

$sql = "DELETE FROM students WHERE id = ? AND role = 'student'";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    header("Location: admin_dashboard.php");
    exit();
} else {
    die("Delete failed: " . $stmt->error);
}

?>