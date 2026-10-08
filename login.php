<?php

  session_start();

$error = "";

 require_once "config/database.php";

  if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM students WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows == 1) {

        $student = $result->fetch_assoc();

        if (password_verify($password, $student['password'])) {


    $_SESSION['user_id'] = $student['id'];
    $_SESSION['user_name'] = $student['name'];
    $_SESSION['role'] = $student['role'];

    if ($student['role'] == 'admin') {
        header("Location: admin_dashboard.php");
        exit();
    } else {
        header("Location: student_dashboard.php");
        exit();
    }

        } else {
            $error = "Invalid email or password.";
        }

            } else {
                $error = "Invalid email or password.";
            }
        }

?>

<!DOCTYPE html>
<html>
<head>
    <title>Student System - Login</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

<div class="login-box">

    <div class="card">


    <?php if ($error != "") { ?>

    <div class="message">
        <?php echo $error; ?>
    </div>

<?php } ?>


     <?php if (isset($_GET['registered'])) { ?>

    <div class="message">
        Registration successful! Please login with your email and password.
    </div>

<?php } ?>




        <h1 class="text-center">Student Login</h1>
        <p class="text-center">Login to your account</p>

        <form method="POST" action="login.php">

            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" required>
            </div>

            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" required>
            </div>

            <div class="text-center">
                <button type="submit">Login</button>
            </div>

        </form>

        <p class="text-center" style="margin-top:20px;">
            <a href="forgot_password.php">Forgot Password?</a>
        </p>

        <p class="text-center">
            New student?
            <a href="index.php">Register here</a>
        </p>

    </div>

</div>

</body>
</html>