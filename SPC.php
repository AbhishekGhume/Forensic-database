<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>See Particular Case</title>

    <link rel="stylesheet" href="SPC.css">
    
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
        <a href="our_team.html">Our Team</a>
    </div>

    <br><br>
    <h1>Case Information</h1>
    <br><br>

    <form method="get">
        <label for="case_id">Enter Case ID: </label>
        <input type="number" id="case_id" name="case_id" required>
        <button type="submit">View Case</button>
    </form>
    
    <?php
    // Check if a case ID is provided in the URL
    if (isset($_GET['case_id'])) {
        $caseID = $_GET['case_id'];

        // Database connection
        $conn = new mysqli('localhost', 'root', 'Abhishek@2004', 'forensic_db');

        // Check for connection errors
        if ($conn->connect_error) {
            die('Connection failed: ' . $conn->connect_error);
        }

        // Query to fetch case information by ID from the database
        $sql = "SELECT ID, title, open, status, evidence, description FROM add_case WHERE ID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $caseID);
        $stmt->execute();
        $result = $stmt->get_result();

        // Check if a record is found
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    // Display case information in a box
    echo '<div class="case-info-box">';
    echo '<h2 style="margin-bottom: 1em">Case ID: ' . $row['ID'] . '</h2>';
    echo '<p style="margin-bottom: 1em"><strong>Title:</strong> ' . $row['title'] . '</p>';
    echo '<p style="margin-bottom: 1em;"><strong>Date of Case Opening:</strong> ' . $row['open'] . '</p>';
    echo '<p style="margin-bottom: 1em;"><strong>Status:</strong> ' . $row['status'] . '</p>';
    
    // Display the evidence values as a comma-separated list
    $evidenceArray = explode(',', $row['evidence']);
    $evidenceList = implode(', ', $evidenceArray);
    echo '<p style="margin-bottom: 1em;"><strong>Evidence Collected:</strong> ' . $evidenceList . '</p>';
    
    echo '<p style="margin-bottom: 1em;"><strong>Description:</strong> ' . $row['description'] . '</p>';
    echo '</div>';
} else {
    echo 'No case found with the provided ID.';
}


        // Close the database connection
        $stmt->close();
        $conn->close();
    } else {
        // echo 'Please provide a case ID.';
    }
    ?>


    
</body>
</html>