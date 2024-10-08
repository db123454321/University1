<?php
// course.php

// Database connection
$connection = new mysqli("localhost", "dbgrasya", "1234qwer", "university1");

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// Create operation
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_course'])) {
    $course_name = $_POST['course_name'];
    $department_id = $_POST['department_id'];
    $credits = $_POST['credits'];

    $query = "INSERT INTO Course (course_name, department_id, credits) VALUES ('$course_name', '$department_id', '$credits')";
    $connection->query($query);
}

// Delete operation
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $connection->query("DELETE FROM Course WHERE course_id = $delete_id");
}

// Read operation
$result = $connection->query("SELECT * FROM Course");

// Fetch departments for dropdown
$departments = $connection->query("SELECT department_id, department_name FROM Department");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Management</title>
    <link rel="stylesheet" href="styles.css"> <!-- Link to your CSS file -->
</head>
<body>
    <div class="container">
        <h1 style="color: darkblue;">Course Management</h1> <!-- Changed color to dark blue -->
        <a href="index.php" class="back-button">Back to Main Page</a>
        <!-- Form to add a new course -->
        <form method="POST" action="">
            <input type="text" name="course_name" placeholder="Course Name" required>
            <select name="department_id" required>
                <option value="">Select Department</option>
                <?php while ($dept = $departments->fetch_assoc()): ?>
                    <option value="<?php echo $dept['department_id']; ?>"><?php echo $dept['department_name']; ?></option>
                <?php endwhile; ?>
            </select>
            <input type="number" name="credits" placeholder="Credits" required>
            <button type="submit" name="add_course">Add Course</button>
        </form>

        <h2>List of Courses</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Course Name</th>
                <th>Department ID</th>
                <th>Credits</th>
                <th>Actions</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['course_id']; ?></td>
                <td><?php echo $row['course_name']; ?></td>
                <td><?php echo $row['department_id']; ?></td>
                <td><?php echo $row['credits']; ?></td>
                <td>
                    <a href="edit_course.php?id=<?php echo $row['course_id']; ?>">Edit</a>
                    <a href="?delete_id=<?php echo $row['course_id']; ?>" onclick="return confirm('Are you sure you want to delete this course?');">Delete</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </table>

        <?php
        // Close connection
        $connection->close();
        ?>
    </div>
</body>
</html>
