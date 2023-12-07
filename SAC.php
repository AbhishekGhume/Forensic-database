<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>See All Cases</title>

    <link rel="stylesheet" href="SAC.css">
    
</head>
<body>
    <div class="navbar">
        <a href="Index.html">
            <img src="logo.png" alt="A15-Forensic Database Logo"> 
        </a>
        <a href="Index.html">Home</a>
        <a href="about.html">About Us</a>
        <a href="contact.html">Contact Us</a>
        <a href="feedback.html">Feedback</a>
        <!-- <a href="our_team.html">Our Team</a> -->
    </div>

    <br><br>
    <h1>Information of all cases</h1>
    <br><br>

    
    <?php
    // Database connection
    $conn = new mysqli('localhost', 'root', 'Abhishek@2004', 'forensic_db');

    // Check for connection errors
    if ($conn->connect_error) {
        die('Connection failed: ' . $conn->connect_error);
    }

    // Query to fetch case information from the database
    $sql = "SELECT ID, title, open, status, evidence, description FROM add_case";
    $result = $conn->query($sql);

    // Check if there are any records
    if ($result->num_rows > 0) {
        // Start the HTML table
        echo '<table border="1">';
        echo '<tr>';
        echo '<th>ID</th>';
        echo '<th>Title</th>';
        echo '<th>Date of Case Opening</th>';
        echo '<th>Status</th>';
        echo '<th>Evidence Collected</th>';
        echo '<th>Description</th>';
        echo '</tr>';

        // Loop through the database results and populate the table rows
        while ($row = $result->fetch_assoc()) {
            echo '<tr>';
            echo '<td>' . $row['ID'] . '</td>';
            echo '<td>' . $row['title'] . '</td>';
            echo '<td>' . $row['open'] . '</td>';
            echo '<td>' . $row['status'] . '</td>';
            echo '<td>' . $row['evidence'] . '</td>';
            echo '<td>' . $row['description'] . '</td>';
            echo '</tr>';
        }

        // Close the HTML table
        echo '</table>';
    } else {
        echo 'No case information available.';
    }

    // Close the database connection
    $conn->close();
    ?>

<footer>
        <p>&copy; Forensic Database</p>
        <p>Contact: team@coders.com</p>
    </footer>

</body>
</html>