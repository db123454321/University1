<?php
// department.php

// Database connection
$connection = new mysqli("localhost", "dbgrasya", "1234qwer", "university1");

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// Handle form submission for adding a department
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_department'])) {
    $department_name = $connection->real_escape_string($_POST['department_name']);
    $budget = $connection->real_escape_string($_POST['budget']);

    $query = "INSERT INTO Department (department_name, budget) VALUES ('$department_name', '$budget')";
    if ($connection->query($query) === TRUE) {
        echo "<p style='color: green;'>Department added successfully!</p>";
    } else {
        echo "<p style='color: red;'>Error: " . $connection->error . "</p>";
    }
}

// Delete operation
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $connection->query("DELETE FROM Department WHERE department_id = $delete_id");
}

// Read operation
$result = $connection->query("SELECT * FROM Department");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Department Management</title>
    <link rel="stylesheet" href="styles.css"> <!-- Link to your CSS file -->
    </style>
</head>
<body>
    <div class="container">
        <h1 style="color: darkblue;">Department Management</h1>
        <a href="index.php" class="back-button button-blue">Back to Main Page</a> <!-- Added button class -->
        <h2>List of Departments</h2>
        
        <!-- Updated form for adding department details -->
        <div class="form-container">
            <form action="department.php" method="POST"> <!-- Ensure action points to the same file -->
                <label for="department_name">Department Name:</label>
                <input type="text" id="department_name" name="department_name" required>
                
                <label for="budget">Budget:</label>
                <input type="number" id="budget" name="budget" required>
                
                <input type="submit" name="add_department" value="Add Department" class="button-blue"> <!-- Added button class -->
            </form>
        </div>
        <!-- End of updated form -->

        <!-- Moved table headers inside the container -->
        <table>
            <tr>
                <th>ID</th>
                <th>Department Name</th>
                <th>Budget</th>
                <th>Actions</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['department_id']; ?></td>
                <td><?php echo $row['department_name']; ?></td>
                <td><?php echo $row['budget']; ?></td>
                <td>
                    <a href="edit_department.php?id=<?php echo $row['department_id']; ?>">Edit</a>
                    <a href="?delete_id=<?php echo $row['department_id']; ?>" onclick="return confirm('Are you sure you want to delete this department?');">Delete</a>
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
