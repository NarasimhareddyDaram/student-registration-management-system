<?php

session_start();

require_once "config/database.php";

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'student') {
    die("Access denied.");
}

$id = $_SESSION['user_id'];

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

    $aadhaar_file_name = $student['aadhaar_file'];

    // Check if a new Aadhaar PDF was uploaded
    if (isset($_FILES['aadhaar_file']) && $_FILES['aadhaar_file']['error'] == 0) {

        $original_name = $_FILES['aadhaar_file']['name'];
        $tmp_name = $_FILES['aadhaar_file']['tmp_name'];

        $file_extension = strtolower(
            pathinfo($original_name, PATHINFO_EXTENSION)
        );

        if ($file_extension != "pdf") {
            die("Only PDF files are allowed.");
        }

        $aadhaar_file_name = uniqid("aadhaar_", true) . ".pdf";

        $upload_path = __DIR__ . "/uploads/aadhaar/" . $aadhaar_file_name;

        if (!move_uploaded_file($tmp_name, $upload_path)) {
            die("Aadhaar upload failed.");
        }
    }

    $sql = "UPDATE students
            SET qualification = ?,
                student_class = ?,
                subject = ?,
                marks = ?,
                aadhaar_file = ?
            WHERE id = ?";

    $update = $conn->prepare($sql);

    $update->bind_param(
        "sssisi",
        $qualification,
        $student_class,
        $subject,
        $marks,
        $aadhaar_file_name,
        $id
    );

    $update->execute();

    header("Location: student_dashboard.php");
    exit();
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Profile</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

<div class="container">

    <div class="card">

        <h1>Edit Profile</h1>

        <p>Update your profile information</p>

        <form method="POST" enctype="multipart/form-data">

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

            <div class="form-group">
                <label>Replace Aadhaar PDF</label>
                <input
                    type="file"
                    name="aadhaar_file"
                    accept=".pdf">
            </div>

            <div class="actions">

                <button type="submit" class="btn-success">
                    Update Profile
                </button>

                <a
                    href="student_dashboard.php"
                    class="btn btn-secondary">
                    Back to Dashboard
                </a>

            </div>

        </form>

    </div>

</div>

</body>
</html>