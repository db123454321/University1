<?php
// Database connection
$connection = new mysqli("localhost", "dbgrasya", "1234qwer", "university1");

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// Fetch instructor details for editing
if (isset($_GET['id'])) {
    $instructor_id = $_GET['id'];
    $result = $connection->query("SELECT * FROM Instructor WHERE instructor_id = $instructor_id");
    $instructor = $result->fetch_assoc();
}

// Update operation
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_instructor'])) {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $hire_date = $_POST['hire_date'];

    $query = "UPDATE Instructor SET first_name='$first_name', last_name='$last_name', email='$email', hire_date='$hire_date' WHERE instructor_id = $instructor_id";
    $connection->query($query);
    header("Location: instructor.php"); // Redirect back to the instructor management page
}

// Close connection
$connection->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Instructor</title>
    <link rel="stylesheet" href="styles.css"> <!-- Link to your CSS file -->
</head>
<body>
    <div class="container">
        <h1>Edit Instructor</h1>
        <a href="index.php" class="back-button">Back to Main Page</a>
        <form method="POST" action="">
            <input type="text" name="first_name" placeholder="First Name" value="<?php echo $instructor['first_name']; ?>" required>
            <input type="text" name="last_name" placeholder="Last Name" value="<?php echo $instructor['last_name']; ?>" required>
            <input type="email" name="email" placeholder="Email" value="<?php echo $instructor['email']; ?>" required>
            <input type="date" name="hire_date" value="<?php echo $instructor['hire_date']; ?>" required>
            <button type="submit" name="update_instructor">Update Instructor</button>
        </form>
    </div>
</body>
</html>
