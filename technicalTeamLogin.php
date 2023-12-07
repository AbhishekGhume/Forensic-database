<?php
$username = $_POST['username'];
$password = $_POST['password'];

// DB connection
$conn = new mysqli('localhost', 'root', 'Abhishek@2004', 'forensic_db');

// Check for connection errors
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

// Prepare a query to check if the provided credentials exist in the database
$checkQuery = "SELECT * FROM technical_team WHERE username = ? AND password = ?";
$stmtCheck = $conn->prepare($checkQuery);
$stmtCheck->bind_param("ss", $username, $password);
$stmtCheck->execute();
$stmtCheck->store_result();

if ($stmtCheck->num_rows > 0) {
    // Redirect to technicalInfo.html if credentials are valid
    header("Location: techInfo.html");
    exit();
} else {
    // Display an error message if credentials are invalid
    echo '<script>
            alert("Invalid username or password. Please try again.");
            window.location.href = "technicalTeamLogin.html"; 
          </script>';
}

$stmtCheck->close();
$conn->close();
?>