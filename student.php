<?php
// student.php

// Database connection
$connection = new mysqli("localhost", "dbgrasya", "1234qwer", "university1");

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// Create operation
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_student'])) {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $enrollment_date = $_POST['enrollment_date'];

    $query = "INSERT INTO Student (first_name, last_name, email, enrollment_date) VALUES ('$first_name', '$last_name', '$email', '$enrollment_date')";
    $connection->query($query);
}

// Delete operation
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $connection->query("DELETE FROM Student WHERE student_id = $delete_id");
}

// Read operation
$result = $connection->query("SELECT * FROM Student");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Management</title>
    <link rel="stylesheet" href="styles.css"> <!-- Link to your CSS file -->
</head>
<body>
    <div class="container"> <!-- Added a container div -->
        <h1>Student Management</h1>

        <a href="index.php" class="back-link">Back to Main Page</a> <!-- Added link to main page -->

        <!-- Form to add a new student -->
        <form method="POST" action="">
            <input type="text" name="first_name" placeholder="First Name" required>
            <input type="text" name="last_name" placeholder="Last Name" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="date" name="enrollment_date" required>
            <button type="submit" name="add_student">Add Student</button>
        </form>

        <h2>List of Students</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Enrollment Date</th>
                <th>Actions</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['student_id']; ?></td>
                <td><?php echo $row['first_name']; ?></td>
                <td><?php echo $row['last_name']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td><?php echo $row['enrollment_date']; ?></td>
                <td>
                    <a href="edit_student.php?id=<?php echo $row['student_id']; ?>">Edit</a>
                    <a href="?delete_id=<?php echo $row['student_id']; ?>" onclick="return confirm('Are you sure you want to delete this student?');">Delete</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </table>
    </div> <!-- End of container div -->

    <?php
    // Close connection
    $connection->close();
    ?>
</body>
</html>
