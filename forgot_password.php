<?php

require_once "config/database.php";

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = $_POST['email'];

    $check_sql = "SELECT id FROM students WHERE email = ?";
    $check_stmt = $conn->prepare($check_sql);
    $check_stmt->bind_param("s", $email);
    $check_stmt->execute();

    $result = $check_stmt->get_result();

    if ($result->num_rows == 1) {

        $new_password = "new123";

        $hashed_password = password_hash(
            $new_password,
            PASSWORD_DEFAULT
        );

        $update_sql = "UPDATE students SET password = ? WHERE email = ?";
        $update_stmt = $conn->prepare($update_sql);

        $update_stmt->bind_param(
            "ss",
            $hashed_password,
            $email
        );

        if ($update_stmt->execute()) {
            $message = "Password reset successfully. Your new password is: new123";
        }

    } else {

        $message = "Email not found.";

    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Forgot Password</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

<div class="login-box">

    <div class="card">

        <h1 class="text-center">Forgot Password</h1>

        <p class="text-center">
            Reset your account password
        </p>

        <?php if ($message != "") { ?>

            <div class="message">
                <?php echo $message; ?>
            </div>

        <?php } ?>

        <form method="POST">

            <div class="form-group">

                <label>Registered Email</label>

                <input
                    type="email"
                    name="email"
                    placeholder="Enter your registered email"
                    required>

            </div>

            <div class="text-center">

                <button type="submit">
                    Reset Password
                </button>

            </div>

        </form>

        <p class="text-center" style="margin-top:20px;">
            <a href="login.php">
                Back to Login
            </a>
        </p>

    </div>

</div>

</body>
</html>