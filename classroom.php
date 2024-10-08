<?php
// classroom.php

// Database connection
$connection = new mysqli("localhost", "dbgrasya", "1234qwer", "university1");

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// Create operation
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_classroom'])) {
    $room_number = $_POST['room_number'];
    $capacity = $_POST['capacity'];

    $query = "INSERT INTO Classroom (room_number, capacity) VALUES ('$room_number', '$capacity')";
    $connection->query($query);
}

// Delete operation
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $connection->query("DELETE FROM Classroom WHERE classroom_id = $delete_id");
}

// Read operation
$result = $connection->query("SELECT * FROM Classroom");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Classroom Management</title>
    <link rel="stylesheet" href="styles.css"> <!-- Link to your CSS file -->
</head>
<body>
    <div class="container">
        <h1 style="color: darkblue;">Classroom Management</h1>
        <a href="index.php" class="back-button">Back to Main Page</a>
       

        <!-- Form to add a new classroom -->
        <form method="POST" action="">
            <input type="text" name="room_number" placeholder="Room Number" required>
            <input type="number" name="capacity" placeholder="Capacity" required>
            <button type="submit" name="add_classroom">Add Classroom</button>
        </form>

        <h2>List of Classrooms</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Room Number</th>
                <th>Capacity</th>
                <th>Actions</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['classroom_id']; ?></td>
                <td><?php echo $row['room_number']; ?></td>
                <td><?php echo $row['capacity']; ?></td>
                <td>
                    <a href="edit_classroom.php?id=<?php echo $row['classroom_id']; ?>">Edit</a>
                    <a href="?delete_id=<?php echo $row['classroom_id']; ?>" onclick="return confirm('Are you sure you want to delete this classroom?');">Delete</a>
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
