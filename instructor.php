<?php
// instructor.php

// Database connection
$connection = new mysqli("localhost", "dbgrasya", "1234qwer", "university1");

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// Create operation
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_instructor'])) {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $hire_date = $_POST['hire_date'];

    $query = "INSERT INTO Instructor (first_name, last_name, email, hire_date) VALUES ('$first_name', '$last_name', '$email', '$hire_date')";
    $connection->query($query);
}

// Delete operation
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $connection->query("DELETE FROM Instructor WHERE instructor_id = $delete_id");
}

// Read operation
$result = $connection->query("SELECT * FROM Instructor");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instructor Management</title>
    <link rel="stylesheet" href="styles.css"> <!-- Link to your CSS file -->
</head>
<body>
    <div class="container">
        <h1 style="color: darkblue;">Instructor Management</h1>
        <a href="index.php" class="back-button">Back to Main Page</a>

        <!-- Form to add a new instructor -->
        <form method="POST" action="">
            <input type="text" name="first_name" placeholder="First Name" required>
            <input type="text" name="last_name" placeholder="Last Name" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="date" name="hire_date" required>
            <button type="submit" name="add_instructor">Add Instructor</button>
        </form>

        <h2>List of Instructors</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Hire Date</th>
                <th>Actions</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['instructor_id']; ?></td>
                <td><?php echo $row['first_name']; ?></td>
                <td><?php echo $row['last_name']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td><?php echo $row['hire_date']; ?></td>
                <td>
                    <a href="edit_instructor.php?id=<?php echo $row['instructor_id']; ?>">Edit</a>
                    <a href="?delete_id=<?php echo $row['instructor_id']; ?>" onclick="return confirm('Are you sure you want to delete this instructor?');">Delete</a>
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
