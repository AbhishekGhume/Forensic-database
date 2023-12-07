<?php
// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the updated case information from the form
    $caseId = $_POST['case_id'];
    $title = $_POST['title'];
    $open = $_POST['open'];
    $status = $_POST['status'];
    $description = $_POST['description'];

    // Database connection
    $conn = new mysqli('localhost', 'root', 'Abhishek@2004', 'forensic_db');

    // Check for connection errors
    if ($conn->connect_error) {
        die('Connection failed: ' . $conn->connect_error);
    }

    // Prepare an SQL statement to update the case information
    $sql = "UPDATE add_case SET title=?, open=?, status=?, description=? WHERE ID=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssi", $title, $open, $status, $description, $caseId);

    // Execute the SQL statement
    if ($stmt->execute()) {
        echo "Case updated successfully.";
    } else {
        echo "Error updating case: " . $stmt->error;
    }

    // Close the database connection
    $stmt->close();
    $conn->close();
}
?> 
