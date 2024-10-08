<?php
// Database connection
$connection = new mysqli("localhost", "dbgrasya", "1234qwer", "university1");

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// Fetch classroom details for editing
if (isset($_GET['id'])) {
    $classroom_id = $_GET['id'];
    $result = $connection->query("SELECT * FROM Classroom WHERE classroom_id = $classroom_id");
    $classroom = $result->fetch_assoc();
}

// Update operation
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_classroom'])) {
    $room_number = $_POST['room_number'];
    $capacity = $_POST['capacity'];

    $query = "UPDATE Classroom SET room_number='$room_number', capacity='$capacity' WHERE classroom_id = $classroom_id";
    $connection->query($query);
    header("Location: classroom.php"); // Redirect back to the classroom management page
}

// Close connection
$connection->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Classroom</title>
    <link rel="stylesheet" href="styles.css"> <!-- Link to your CSS file -->
</head>
<body>
    <div class="container">
        <h1>Edit Classroom</h1>
        <a href="index.php" class="back-button">Back to Main Page</a>
        <form method="POST" action="">
            <input type="text" name="room_number" placeholder="Room Number" value="<?php echo $classroom['room_number']; ?>" required>
            <input type="number" name="capacity" placeholder="Capacity" value="<?php echo $classroom['capacity']; ?>" required>
            <button type="submit" name="update_classroom">Update Classroom</button>
        </form>
    </div>
</body>
</html>
