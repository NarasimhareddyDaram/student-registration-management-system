<!DOCTYPE html>
<html>
<head>
    <title>Student Registration</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

<div class="container">

    <div class="card">

        <h1 class="text-center">Student Registration</h1>
        <p class="text-center">Create your student account</p>

        <form action="register.php" method="POST" enctype="multipart/form-data">

            <div class="form-group">
                <label>Name</label>
                <input type="text" name="name" required>
            </div>

            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" required>
            </div>

            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" required>
            </div>

            <div class="form-group">
                <label>Date of Birth</label>
                <input type="date" name="date_of_birth" required>
            </div>

            <div class="form-group">
                <label>Gender</label>

                <input type="radio" name="gender" value="Male" required>
                <label style="display:inline; font-weight:normal;">Male</label>

                <input type="radio" name="gender" value="Female">
                <label style="display:inline; font-weight:normal;">Female</label>
            </div>

            <div class="form-group">
                <label>Qualification</label>

                <select name="qualification" required>
                    <option value="">Select Qualification</option>
                    <option value="B.Tech">B.Tech</option>
                    <option value="B.Sc">B.Sc</option>
                    <option value="B.Com">B.Com</option>
                    <option value="M.Tech">M.Tech</option>
                    <option value="M.Sc">M.Sc</option>
                    <option value="Other">Other</option>
                </select>
            </div>

            <div class="form-group">
                <label>Interests</label>

                <input type="checkbox" name="interests[]" value="Coding">
                <label style="display:inline; font-weight:normal;">Coding</label>

                <input type="checkbox" name="interests[]" value="Sports">
                <label style="display:inline; font-weight:normal;">Sports</label>

                <input type="checkbox" name="interests[]" value="Reading">
                <label style="display:inline; font-weight:normal;">Reading</label>

                <input type="checkbox" name="interests[]" value="Music">
                <label style="display:inline; font-weight:normal;">Music</label>
            </div>

            <div class="form-group">
                <label>Class</label>
                <input type="text" name="student_class" required>
            </div>

            <div class="form-group">
                <label>Subject</label>
                <input type="text" name="subject" required>
            </div>

            <div class="form-group">
                <label>Marks</label>
                <input type="number" name="marks" min="0" max="100" required>
            </div>

            <div class="form-group">
                <label>Aadhaar Document (PDF only)</label>
                <input type="file" name="aadhaar_file" accept=".pdf" required>
            </div>

            <div class="text-center">
                <button type="submit">Register</button>
            </div>

        </form>

        <p class="text-center" style="margin-top:20px;">
            Already registered?
            <a href="login.php">Login here</a>
        </p>

    </div>

</div>

</body>
</html>