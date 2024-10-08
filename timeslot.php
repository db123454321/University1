<?php
// timeslot.php

// Database connection
$connection = new mysqli("localhost", "dbgrasya", "1234qwer", "university1");

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// Create operation
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_time_slot'])) {
    $start_time = $_POST['start_time'];
    $end_time = $_POST['end_time'];

    $query = "INSERT INTO TimeSlot (start_time, end_time) VALUES ('$start_time', '$end_time')";
    $connection->query($query);
}

// Delete operation
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $connection->query("DELETE FROM TimeSlot WHERE time_slot_id = $delete_id");
}

// Read operation
$result = $connection->query("SELECT * FROM TimeSlot");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Time Slot Management</title>
    <link rel="stylesheet" href="styles.css"> <!-- Link to your CSS file -->
</head>
<body>
    <div class="container">
        <h1 style="color: darkblue;">Time Slot Management</h1>
        <a href="index.php" class="back-button">Back to Main Page</a>
        
        <!-- Form to add a new time slot -->
        <form method="POST" action="">
            <input type="time" name="start_time" required>
            <input type="time" name="end_time" required>
            <button type="submit" name="add_time_slot">Add Time Slot</button>
        </form>

        <h2>List of Time Slots</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Start Time</th>
                <th>End Time</th>
                <th>Actions</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['time_slot_id']; ?></td>
                <td><?php echo $row['start_time']; ?></td>
                <td><?php echo $row['end_time']; ?></td>
                <td>
                    <a href="edit_timeslot.php?id=<?php echo $row['time_slot_id']; ?>">Edit</a>
                    <a href="?delete_id=<?php echo $row['time_slot_id']; ?>" onclick="return confirm('Are you sure you want to delete this time slot?');">Delete</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </table>
    </div>

    <?php
    // Close connection
    $connection->close();
    ?>
</body>
</html>
