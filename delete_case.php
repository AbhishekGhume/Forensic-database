<?php
// Database connection
$conn = new mysqli('localhost', 'root', 'Abhishek@2004', 'forensic_db');

// Check for connection errors
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

// Check if the "case_id" is provided in the URL
if (isset($_GET['case_id'])) {
    $caseId = $_GET['case_id'];

    // Perform the delete operation (you should add appropriate error handling here)
    $sql = "DELETE FROM add_case WHERE ID = $caseId";
    if ($conn->query($sql) === TRUE) {
        echo "Case deleted successfully";
    } else {
        echo "Error deleting case: " . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>
