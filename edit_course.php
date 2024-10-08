<?php
// Database connection
$connection = new mysqli("localhost", "dbgrasya", "1234qwer", "university1");

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// Fetch course details for editing
if (isset($_GET['id'])) {
    $course_id = $_GET['id'];
    $result = $connection->query("SELECT * FROM Course WHERE course_id = $course_id");
    $course = $result->fetch_assoc();
}

// Update operation
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_course'])) {
    $course_name = $_POST['course_name'];
    $department_id = $_POST['department_id'];
    $credits = $_POST['credits'];

    $query = "UPDATE Course SET course_name='$course_name', department_id='$department_id', credits='$credits' WHERE course_id = $course_id";
    $connection->query($query);
    header("Location: course.php"); // Redirect back to the course management page
}

// Fetch departments for dropdown
$departments = $connection->query("SELECT department_id, department_name FROM Department");

// Close connection
$connection->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Course</title>
    <link rel="stylesheet" href="styles.css"> <!-- Link to your CSS file -->
</head>
<body>
    <div class="container">
        <h1>Edit Course</h1>
        <a href="index.php" class="back-button">Back to Main Page</a>
        <form method="POST" action="">
            <input type="text" name="course_name" placeholder="Course Name" value="<?php echo $course['course_name']; ?>" required>
            <select name="department_id" required>
                <option value="">Select Department</option>
                <?php while ($dept = $departments->fetch_assoc()): ?>
                    <option value="<?php echo $dept['department_id']; ?>" <?php echo ($dept['department_id'] == $course['department_id']) ? 'selected' : ''; ?>>
                        <?php echo $dept['department_name']; ?>
                    </option>
                <?php endwhile; ?>
            </select>
            <input type="number" name="credits" placeholder="Credits" value="<?php echo $course['credits']; ?>" required>
            <button type="submit" name="update_course">Update Course</button>
        </form>
    </div>
</body>
</html>
