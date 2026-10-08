<?php

require_once "config/database.php";

$name = $_POST['name'];
$email = $_POST['email'];

$check_sql = "SELECT id FROM students WHERE email = ?";
$check_stmt = $conn->prepare($check_sql);
$check_stmt->bind_param("s", $email);
$check_stmt->execute();
$check_stmt->store_result();

if ($check_stmt->num_rows > 0) {
    die('
<!DOCTYPE html>
<html>
<head>
    <title>Email Already Registered</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

<div class="error-page">

    <div class="card error-card">

        <div class="error-icon">⚠️</div>

        <h1>Email Already Registered</h1>

        <p>
            This email is already registered.
            Please use a different email address.
        </p>

        <a href="index.php" class="btn">
            Back to Registration
        </a>

        <br><br>

        <a href="login.php">
            Go to Login
        </a>

    </div>

</div>

</body>
</html>
');
}

$password = $_POST['password'];
$hashed_password = password_hash($password, PASSWORD_DEFAULT);
$date_of_birth = $_POST['date_of_birth'];
$gender = $_POST['gender'];
$qualification = $_POST['qualification'];
$student_class = $_POST['student_class'];
$subject = $_POST['subject'];
$marks = $_POST['marks'];
$interests = $_POST['interests'];
$interests_text = implode(", ", $interests);

$aadhaar_file = $_FILES['aadhaar_file'];

$original_name = $aadhaar_file['name'];
$tmp_name = $aadhaar_file['tmp_name'];

$file_extension = strtolower(pathinfo($original_name, PATHINFO_EXTENSION));

if ($file_extension != "pdf") {
    die("Only PDF files are allowed.");
}

$unique_name = uniqid("aadhaar_", true) . ".pdf";

$upload_path = __DIR__ . "/uploads/aadhaar/" . $unique_name;

if (!move_uploaded_file($tmp_name, $upload_path)) {
    die("Aadhaar upload failed.");
}

$sql = "INSERT INTO students
(name, email, password, date_of_birth, gender, qualification, interests, student_class, subject, marks, aadhaar_file)
VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);

$stmt->bind_param(
    "sssssssssis",
    $name,
    $email,
    $hashed_password,
    $date_of_birth,
    $gender,
    $qualification,
    $interests_text,
    $student_class,
    $subject,
    $marks,
    $unique_name
);

if ($stmt->execute()) {

    header("Location: login.php?registered=1");
    exit();

} else {

    echo "Registration failed: " . $stmt->error;

}


?>