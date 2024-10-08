<?php
// Database connection
$connection = new mysqli("localhost", "dbgrasya", "1234qwer", "university1");

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// Fetch department details for editing
if (isset($_GET['id'])) {
    $department_id = $_GET['id'];
    $result = $connection->query("SELECT * FROM Department WHERE department_id = $department_id");
    $department = $result->fetch_assoc();
}

// Update operation
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_department'])) {
    $department_name = $_POST['department_name'];
    $budget = $_POST['budget'];

    $query = "UPDATE Department SET department_name='$department_name', budget='$budget' WHERE department_id = $department_id";
    $connection->query($query);
    header("Location: department.php"); // Redirect back to the department management page
}

// Close connection
$connection->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Department</title>
    <link rel="stylesheet" href="styles.css"> <!-- Link to your CSS file -->
</head>
<body>
    <div class="container">
        <h1>Edit Department</h1>
        <a href="index.php" class="back-button">Back to Main Page</a>
        <form method="POST" action="">
            <input type="text" name="department_name" placeholder="Department Name" value="<?php echo $department['department_name']; ?>" required>
            <input type="number" name="budget" placeholder="Budget" value="<?php echo $department['budget']; ?>" required>
            <button type="submit" name="update_department">Update Department</button>
        </form>
    </div>
</body>
</html>
