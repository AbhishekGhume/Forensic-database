<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ID = $_POST['ID'];
    $title = $_POST['title'];
    $open = $_POST['open'];
    $status = $_POST['status'];
    $evidenceArray = isset($_POST["evidence"]) ? $_POST["evidence"] : [];
    $evidence = implode(', ', $evidenceArray);
    $description = $_POST['description'];

    // DB connection
    $conn = new mysqli('localhost', 'root', 'Abhishek@2004', 'forensic_db');
    if ($conn->connect_error) {
        die('Connection failed : ' . $conn->connect_error);
    } else {
        $stmt = $conn->prepare("INSERT INTO add_case (ID, title, open, status, evidence, description) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("isssss", $ID, $title, $open, $status, $evidence, $description);
        if ($stmt->execute()) {
            // Redirect back to the original page with a success message
            // header("Location: add_case.php?message=" . urlencode("New case is added successfully"));
            echo "New case is submitted successfully";
            exit();
        } else {
            // Redirect back to the original page with an error message
            // header("Location: add_case.php?message=" . urlencode("Error: " . $stmt->error));
            echo "Error : ".$stmt->error;
            exit();
        }
        $stmt->close();
        $conn->close();
    }
}
?>