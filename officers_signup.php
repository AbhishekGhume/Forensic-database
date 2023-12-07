<?php
// Function to validate email using a regular expression
function is_valid_email($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

// Function to validate password strength
function is_valid_password($password) {
    // Password should contain at least one letter, one number, and be at least 8 characters long
    return preg_match('/^(?=.*[A-Za-z])(?=.*\d).{8,}$/', $password);
}

$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
$response = "";

// Check if email is in the correct syntax
if (!is_valid_email($email)) {
    $response = "Invalid email address.";
} elseif (!is_valid_password($password)) {
    $response = "Invalid password. Password should be at least 8 characters long and contain both letters and numbers.";
} else {
    // DB connection
    $conn = new mysqli('localhost', 'root', 'Abhishek@2004', 'forensic_db');

    // Check for connection errors
    if ($conn->connect_error) {
        die('Connection failed : ' . $conn->connect_error);
    }

    // Check if the officer already exists
    $checkQuery = "SELECT * FROM officers WHERE username = ? OR email = ?";
    $stmtCheck = $conn->prepare($checkQuery);
    $stmtCheck->bind_param("ss", $username, $email);
    $stmtCheck->execute();
    $stmtCheck->store_result();

    if ($stmtCheck->num_rows > 0) {
        $response = "You have already signed up. Please sign in with the correct username and password.";
    } else {
        // Insert the new officer
        $insertQuery = "INSERT INTO officers (username, email, passward) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($insertQuery);
        $stmt->bind_param("sss", $username, $email, $password);

        if ($stmt->execute()) {
            // Registration successful
            $response = "Registration successful.";
        } else {
            $response = "Error: " . $stmt->error;
        }

        $stmt->close();
    }

    $stmtCheck->close();
    $conn->close();
}

// Output the response message in a JavaScript script tag
echo '<script>
        var responseMessage = "' . $response . '";
        if (responseMessage) {
            alert(responseMessage);
        }
        window.location.href = "officers_signup.html"; // Redirect back to the signup page
      </script>';
?>
