<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>University Management System</title>
    <link rel="stylesheet" href="styles.css"> <!-- Link to your CSS file -->
    <style>
        body {
            background-color: #f0f0f0; /* Light background color */
            font-family: 'Arial', sans-serif; /* Clean font */
            color: #333; /* Dark text color */
            text-align: center; /* Center the text */
        }
        
        h1 {
            color: #003366; /* Dark blue color for the title */
            background-color: #ffffff; /* White background for the title */
            padding: 10px; /* Padding around the title */
            border-radius: 5px; /* Rounded corners */
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* Shadow for depth */
            font-family: cursive; /* Cursive font for the title */
        }
        
        h1 {
            color: #003366; /* Dark blue color for the subtitle/message */
            background-color: #0AD1C8; /* Light gray background for the subtitle */
            padding: 10px; /* Padding around the subtitle */
            border-radius: 5px; /* Rounded corners */
        }
        
        nav {
            display: flex; /* Use flexbox for centering */
            justify-content: center; /* Center the navigation items */
            margin: 20px 0; /* Add some margin for spacing */
        }

        nav ul {
            list-style-type: none; /* Remove bullet points */
            padding: 0; /* Remove padding */
        }

        nav li {
            margin: 0 15px; /* Add space between buttons */
        }

        nav a {
            text-decoration: none; /* Remove underline from links */
            padding: 10px 15px; /* Add padding for buttons */
            border-radius: 5px; /* Rounded corners */
            color: white; /* Text color */
        }

        
    </style>
</head>
<body>
    <h1>University Management System</h1>
    <nav>
        <ul>
            <li><a href="instructor.php">Manage Instructors</a></li>
            <li><a href="department.php">Manage Departments</a></li>
            <li><a href="course.php">Manage Courses</a></li>
            <li><a href="classroom.php">Manage Classrooms</a></li>
            <li><a href="timeslot.php">Manage Time Slots</a></li>
            <li><a href="student.php">Manage Students</a></li>
        </ul>
    </nav>

    <h2 style="font-style: italic;">Welcome to the University Management System</h2>
    <p style="font-style: italic;">Select an option from the menu to manage the respective entities.</p>

   

