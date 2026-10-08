<?php

session_start();

require_once "config/database.php";

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
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
            You do not have permission to access this page.
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

$sql = "SELECT * FROM students WHERE role = 'student' ORDER BY id DESC";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html>
<head>

    <title>Admin Dashboard</title>

    <link rel="stylesheet" href="style.css">

</head>

<body>

<div class="container">

    <div class="card">

        <h1>Admin Dashboard</h1>

        <p>
            Welcome,
            <strong><?php echo $_SESSION['user_name']; ?></strong>
        </p>

        <div class="actions">
            <a class="btn btn-secondary" href="logout.php">
                Logout
            </a>
        </div>

        <h2>All Students</h2>

        <!-- Filters -->

        <div class="filters">

            <div>
                <label>Name</label>
                <input
                    type="text"
                    id="nameFilter"
                    placeholder="Search by name">
            </div>

            <div>
                <label>Class</label>
                <input
                    type="text"
                    id="classFilter"
                    placeholder="Search by class">
            </div>

            <div>
                <label>Minimum Age</label>
                <input
                    type="number"
                    id="minAge"
                    min="0"
                    placeholder="Minimum age">
            </div>

            <div>
                <label>Maximum Age</label>
                <input
                    type="number"
                    id="maxAge"
                    min="0"
                    placeholder="Maximum age">
            </div>

        </div>

        <!-- Student Table -->

        <div style="overflow-x:auto;">

        <table id="studentsTable">

            <tr>

                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>DOB</th>
                <th>Gender</th>
                <th>Qualification</th>
                <th>Interests</th>
                <th>Class</th>
                <th>Subject</th>
                <th>Marks</th>
                <th>Aadhaar</th>
                <th>Actions</th>

            </tr>

            <?php while ($student = $result->fetch_assoc()) { ?>

            <tr
                class="student-row"
                data-name="<?php echo strtolower($student['name']); ?>"
                data-class="<?php echo strtolower($student['student_class']); ?>"
                data-dob="<?php echo $student['date_of_birth']; ?>"
            >

                <td>
                    <?php echo $student['id']; ?>
                </td>

                <td>
                    <?php echo $student['name']; ?>
                </td>

                <td>
                    <?php echo $student['email']; ?>
                </td>

                <td>
                    <?php echo $student['date_of_birth']; ?>
                </td>

                <td>
                    <?php echo $student['gender']; ?>
                </td>

                <td>
                    <?php echo $student['qualification']; ?>
                </td>

                <td>
                    <?php echo $student['interests']; ?>
                </td>

                <td>
                    <?php echo $student['student_class']; ?>
                </td>

                <td>
                    <?php echo $student['subject']; ?>
                </td>

                <td>
                    <?php echo $student['marks']; ?>
                </td>

                <td>
                    <a
                        href="uploads/aadhaar/<?php echo $student['aadhaar_file']; ?>"
                        target="_blank">
                        View PDF
                    </a>
                </td>

                <td>

                    <a
                        class="btn btn-success"
                        href="edit_student.php?id=<?php echo $student['id']; ?>">
                        Edit
                    </a>

                    <br><br>

                    <a
                        class="btn btn-danger"
                        href="delete_student.php?id=<?php echo $student['id']; ?>"
                        onclick="return confirm('Are you sure you want to delete this student?');">
                        Delete
                    </a>

                </td>

            </tr>

            <?php } ?>

        </table>

        </div>

    </div>

</div>

<script>

function calculateAge(dateOfBirth) {

    const today = new Date();

    const birthDate = new Date(dateOfBirth);

    let age =
        today.getFullYear() -
        birthDate.getFullYear();

    const monthDifference =
        today.getMonth() -
        birthDate.getMonth();

    if (
        monthDifference < 0 ||
        (
            monthDifference === 0 &&
            today.getDate() < birthDate.getDate()
        )
    ) {

        age--;

    }

    return age;
}


function filterStudents() {

    const nameFilter =
        document.getElementById("nameFilter")
        .value
        .toLowerCase();

    const classFilter =
        document.getElementById("classFilter")
        .value
        .toLowerCase();

    const minAge =
        document.getElementById("minAge").value;

    const maxAge =
        document.getElementById("maxAge").value;

    const rows =
        document.querySelectorAll(".student-row");


    rows.forEach(function(row) {

        const name =
            row.dataset.name;

        const studentClass =
            row.dataset.class;

        const dob =
            row.dataset.dob;

        const age =
            calculateAge(dob);

        let showRow = true;


        if (!name.includes(nameFilter)) {

            showRow = false;

        }


        if (!studentClass.includes(classFilter)) {

            showRow = false;

        }


        if (
            minAge !== "" &&
            age < Number(minAge)
        ) {

            showRow = false;

        }


        if (
            maxAge !== "" &&
            age > Number(maxAge)
        ) {

            showRow = false;

        }


        row.style.display =
            showRow ? "" : "none";

    });

}


document
    .getElementById("nameFilter")
    .addEventListener("input", filterStudents);


document
    .getElementById("classFilter")
    .addEventListener("input", filterStudents);


document
    .getElementById("minAge")
    .addEventListener("input", filterStudents);


document
    .getElementById("maxAge")
    .addEventListener("input", filterStudents);

</script>

</body>
</html>