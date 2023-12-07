<?php
// Check if the username and password are valid
if (!empty($_POST['username']) && !empty($_POST['password'])) {
    // DB connection
    $conn = new mysqli('localhost', 'root', 'Abhishek@2004', 'forensic_db');

    // Check for connection errors
    if ($conn->connect_error) {
        die('Connection failed : ' . $conn->connect_error);
    }

    // Check if the officer exists
    $checkQuery = "SELECT * FROM officers WHERE username = ? AND passward = ?";
    $stmtCheck = $conn->prepare($checkQuery);
    $stmtCheck->bind_param("ss", $_POST['username'], $_POST['password']);
    $stmtCheck->execute();
    $stmtCheck->store_result();

    if ($stmtCheck->num_rows > 0) {
        // The officer exists, so redirect to the officer page
        header("Location: officerPage.html");
    } 
    
    else {
        // The officer does not exist, so display an error message using JavaScript
        echo '<script>
                alert("Invalid username or password.");
                window.location.href = "officers_signin.html"; // Redirect back to the sign-in page
              </script>';
    }

    $stmtCheck->close();
    $conn->close();
}
?>
