<?php
// Database connection
$connection = new mysqli("localhost", "dbgrasya", "1234qwer", "university1");

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// Fetch student details for editing
if (isset($_GET['id'])) {
    $student_id = $_GET['id'];
    $result = $connection->query("SELECT * FROM Student WHERE student_id = $student_id");
    $student = $result->fetch_assoc();
}

// Update operation
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_student'])) {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $enrollment_date = $_POST['enrollment_date'];

    $query = "UPDATE Student SET first_name='$first_name', last_name='$last_name', email='$email', enrollment_date='$enrollment_date' WHERE student_id = $student_id";
    $connection->query($query);
    header("Location: student.php"); // Redirect back to the student management page
}

// Close connection
$connection->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Student</title>
    <link rel="stylesheet" href="styles.css"> <!-- Link to your CSS file -->
</head>
<body>
    <div class="container">
        <h1>Edit Student</h1>
        <a href="index.php" class="back-button">Back to Main Page</a>
        <form method="POST" action="">
            <input type="text" name="first_name" placeholder="First Name" value="<?php echo $student['first_name']; ?>" required>
            <input type="text" name="last_name" placeholder="Last Name" value="<?php echo $student['last_name']; ?>" required>
            <input type="email" name="email" placeholder="Email" value="<?php echo $student['email']; ?>" required>
            <input type="date" name="enrollment_date" value="<?php echo $student['enrollment_date']; ?>" required>
            <button type="submit" name="update_student">Update Student</button>
        </form>
    </div>
</body>
</html>
