<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Case</title>

    <link rel="stylesheet" href="UC.css">
    
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
    <h1>Update Case</h1>
    <br><br>

    <form method="get">
        <label for="case_id">Enter Case ID: </label>
        <br>
        <input type="number" id="case_id" name="case_id" required>
        <button type="submit">View Case</button>
    </form>
    
    <form1 action="update_case.php" method="post">
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
            echo '<p style="margin-bottom: 1em;"><strong>Evidence Collected:</strong> ' . $row['evidence'] . '</p>';
            echo '<p style="margin-bottom: 1em;"><strong>Description:</strong> ' . $row['description'] . '</p>';
            echo '</div>';

             // Display the update form
             echo '<div class="update-form">';
             echo '<h2>Update Case Information</h2>';
             echo '<form method="post" action="update_case.php">';
             echo '<input type="hidden" name="case_id" value="' . $row['ID'] . '">'; // Hidden field to pass the case ID for updating
             echo '<label for="title" style="margin-bottom: 1em">Update Title:</label>';
             echo '<input type="text" id="title" name="title" value="' . $row['title'] . '" required>';
             echo '<label for="open" style="margin-bottom: 1em">Update Date of Case Opening:</label>';
             echo '<input type="date" id="open" name="open" value="' . $row['open'] . '">';
             echo '<label style="margin-bottom: 1em">Update Status:</label>';
             echo '<input type="radio" value="Ongoing" name="status" id="status1" ' . ($row['status'] == 'Ongoing' ? 'checked' : '') . '>Ongoing';
             echo '<input type="radio" value="Pending" name="status" id="status2" ' . ($row['status'] == 'Pending' ? 'checked' : '') . '>Pending';
             echo '<input type="radio" value="Closed" name="status" id="status3" ' . ($row['status'] == 'Closed' ? 'checked' : '') . ' style="margin-bottom: 1em">Closed';
             echo '<label style="margin-bottom: 1em">Update Evidence Collected:</label>';
            // //  Add your checkbox logic here, matching it with the existing evidence
            // //  Example:
            //  echo '<input type="checkbox" value="Fingerprint" name="evidence[]" id="200" ' . (in_array('Fingerprint', $row['evidence']) ? 'checked' : '') . '>Fingerprint';
             echo '<label for="description">Update Description:</label>';
             echo '<textarea name="description" id="description" rows="5" cols="67">' . $row['description'] . '</textarea>';
             echo '<input type="submit" value="Update Case">';
             echo '</form>';
             echo '</div>';
        } 
        else {
            echo 'No case found with the provided ID.';
        }

        // Close the database connection
        $stmt->close();
        $conn->close();
    } else {
        // echo 'Please provide a case ID.';
    }
    ?>
    </form1>
</body>
</html>
