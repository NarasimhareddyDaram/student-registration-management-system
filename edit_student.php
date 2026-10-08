<?php

session_start();

require_once "config/database.php";

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    die("Access denied.");
}

$id = $_GET['id'];

$sql = "SELECT * FROM students WHERE id = ? AND role = 'student'";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();

$result = $stmt->get_result();
$student = $result->fetch_assoc();

if (!$student) {
    die("Student not found.");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $qualification = $_POST['qualification'];
    $student_class = $_POST['student_class'];
    $subject = $_POST['subject'];
    $marks = $_POST['marks'];

    $update_sql = "UPDATE students
                   SET qualification = ?,
                       student_class = ?,
                       subject = ?,
                       marks = ?
                   WHERE id = ?";

    $update_stmt = $conn->prepare($update_sql);

    $update_stmt->bind_param(
        "sssii",
        $qualification,
        $student_class,
        $subject,
        $marks,
        $id
    );

    $update_stmt->execute();

    header("Location: admin_dashboard.php");
    exit();
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Student</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

<div class="container">

    <div class="card">

        <h1>Edit Student</h1>

        <p>Update student information</p>

        <form method="POST">

            <div class="form-group">
                <label>Name</label>
                <input
                    type="text"
                    value="<?php echo $student['name']; ?>"
                    class="disabled-field"
                    disabled>
            </div>

            <div class="form-group">
                <label>Email</label>
                <input
                    type="email"
                    value="<?php echo $student['email']; ?>"
                    class="disabled-field"
                    disabled>
            </div>

            <div class="form-group">
                <label>Qualification</label>
                <input
                    type="text"
                    name="qualification"
                    value="<?php echo $student['qualification']; ?>"
                    required>
            </div>

            <div class="form-group">
                <label>Class</label>
                <input
                    type="text"
                    name="student_class"
                    value="<?php echo $student['student_class']; ?>"
                    required>
            </div>

            <div class="form-group">
                <label>Subject</label>
                <input
                    type="text"
                    name="subject"
                    value="<?php echo $student['subject']; ?>"
                    required>
            </div>

            <div class="form-group">
                <label>Marks</label>
                <input
                    type="number"
                    name="marks"
                    value="<?php echo $student['marks']; ?>"
                    min="0"
                    max="100"
                    required>
            </div>

            <div class="actions">

                <button type="submit" class="btn-success">
                    Update Student
                </button>

                <a
                    href="admin_dashboard.php"
                    class="btn btn-secondary">
                    Back to Dashboard
                </a>

            </div>

        </form>

    </div>

</div>

</body>
</html>