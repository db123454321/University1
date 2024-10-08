<?php
// Database connection
$connection = new mysqli("localhost", "dbgrasya", "1234qwer", "university1");

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// Fetch time slot details for editing
if (isset($_GET['id'])) {
    $time_slot_id = $_GET['id'];
    $result = $connection->query("SELECT * FROM TimeSlot WHERE time_slot_id = $time_slot_id");
    $time_slot = $result->fetch_assoc();
}

// Update operation
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_time_slot'])) {
    $start_time = $_POST['start_time'];
    $end_time = $_POST['end_time'];

    $query = "UPDATE TimeSlot SET start_time='$start_time', end_time='$end_time' WHERE time_slot_id = $time_slot_id";
    $connection->query($query);
    header("Location: timeslot.php"); // Redirect back to the time slot management page
}

// Close connection
$connection->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Time Slot</title>
    <link rel="stylesheet" href="styles.css"> <!-- Link to your CSS file -->
</head>
<body>
    <div class="container">
        <h1>Edit Time Slot</h1>
        <a href="index.php" class="back-button">Back to Main Page</a>
        <form method="POST" action="">
            <input type="time" name="start_time" value="<?php echo $time_slot['start_time']; ?>" required>
            <input type="time" name="end_time" value="<?php echo $time_slot['end_time']; ?>" required>
            <button type="submit" name="update_time_slot">Update Time Slot</button>
        </form>
    </div>
</body>
</html>
