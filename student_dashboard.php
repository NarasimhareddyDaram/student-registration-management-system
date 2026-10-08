<?php

session_start();

require_once "config/database.php";

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'student') {
    die('
<!DOCTYPE html>
<html>
<head>
    <title>Access Denied</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

<div class="access-denied">

    <div class="card access-denied-card">

        <h1>Access Denied</h1>

        <p>
            You must be logged in as a student to access this page.
        </p>

        <a href="login.php" class="btn">
            Go to Login
        </a>

    </div>

</div>

</body>
</html>
');
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

?>

 <!DOCTYPE html>
<html>
<head>
    <title>Student Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

<div class="container">

    <div class="card">

        <h1>
            Welcome,
            <?php echo $student['name']; ?>
            (User ID: #<?php echo $student['id']; ?>)
        </h1>

        <div class="actions">

            <a href="edit_profile.php" class="btn btn-success">
                Edit Profile
            </a>

            <a href="logout.php" class="btn btn-secondary">
                Logout
            </a>

        </div>

        <h2>My Details</h2>

        <div style="overflow-x:auto;">

            <table>

                <tr>
                    <th>Name</th>
                    <td><?php echo $student['name']; ?></td>
                </tr>

                <tr>
                    <th>Email</th>
                    <td><?php echo $student['email']; ?></td>
                </tr>

                <tr>
                    <th>Date of Birth</th>
                    <td><?php echo $student['date_of_birth']; ?></td>
                </tr>

                <tr>
                    <th>Gender</th>
                    <td><?php echo $student['gender']; ?></td>
                </tr>

                <tr>
                    <th>Qualification</th>
                    <td><?php echo $student['qualification']; ?></td>
                </tr>

                <tr>
                    <th>Interests</th>
                    <td><?php echo $student['interests']; ?></td>
                </tr>

                <tr>
                    <th>Class</th>
                    <td><?php echo $student['student_class']; ?></td>
                </tr>

                <tr>
                    <th>Subject</th>
                    <td><?php echo $student['subject']; ?></td>
                </tr>

                <tr>
                    <th>Marks</th>
                    <td><?php echo $student['marks']; ?></td>
                </tr>

                <tr>
                    <th>Aadhaar</th>
                    <td>
                        <a
                            href="uploads/aadhaar/<?php echo $student['aadhaar_file']; ?>"
                            target="_blank">
                            View Aadhaar PDF
                        </a>
                    </td>
                </tr>

            </table>

        </div>

    </div>

</div>

</body>
</html>
       