<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Case</title>

    <link rel="stylesheet" href="DC.css">

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
    <h1>Delete Case</h1>
    <br><br>
    
    <?php
    // Database connection
    $conn = new mysqli('localhost', 'root', 'Abhishek@2004', 'forensic_db');

    // Check for connection errors
    if ($conn->connect_error) {
        die('Connection failed: ' . $conn->connect_error);
    }

    // Function to display the confirmation dialog using JavaScript
    function displayConfirmationDialog($caseId) {
        echo '<script>';
        echo 'var modal = document.getElementById("myModal");';
        echo 'modal.style.display = "block";';
        echo 'document.getElementById("confirmButton").addEventListener("click", function() {';
        echo '   window.location.href = "delete_case.php?case_id=' . $caseId . '";';
        echo '});';
        echo 'document.getElementById("cancelButton").addEventListener("click", function() {';
        echo '   modal.style.display = "none";';
        echo '});';
        echo '</script>';
    }

    // Check if the "case_id" is provided in the URL
    if (isset($_GET['case_id'])) {
        $caseId = $_GET['case_id'];
        displayConfirmationDialog($caseId);
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

    <form method="get">
        <label for="case_id">Enter Case ID of case which you wanted to delete : </label>
        <input type="number" id="case_id" name="case_id" required>
        <button type="submit">Delete Case</button>
    </form>

    

    <!-- Modal for confirmation dialog -->
    <div id="myModal" class="modal">
        <div class="modal-content">
            <p>Are you sure you want to delete this case?</p>
            <div class="modal-button-container">
                <button id="confirmButton">Yes</button>
                <button id="cancelButton">No</button>
            </div>
        </div>
    </div>

    

    <script>
    // Function to display the confirmation dialog
function displayConfirmationDialog(caseId) {
    var modal = document.getElementById("myModal");
    modal.style.display = "block";

    var confirmButton = document.getElementById("confirmButton");
    var cancelButton = document.getElementById("cancelButton");

    // Function to handle the "Yes" button click
    function onConfirmButtonClick() {
        // Remove the event listener for the "Yes" button
        confirmButton.removeEventListener("click", onConfirmButtonClick);

        // Make an AJAX request to delete the case
        var xhr = new XMLHttpRequest();
        xhr.open("GET", "delete_case.php?case_id=" + caseId, true);
        xhr.onload = function() {
            if (xhr.status === 200) {
                // Hide the modal
                modal.style.display = "none";

                // Update the table after a short delay to allow time for the database to update
                setTimeout(function() {
                    updateTable();
                    // Display success message
                    displaySuccessMessage();
                }, 1000); // Delay for 1 second
            }
        };
        xhr.send();
    }

    confirmButton.onclick = onConfirmButtonClick;

    cancelButton.onclick = function() {
        modal.style.display = "none";
    };
}


    // Function to display the success message
    function displaySuccessMessage() {
        var successMessage = document.createElement("p");
        successMessage.innerHTML = "Case is deleted successfully.";
        document.body.appendChild(successMessage);

        // Hide the success message after 3 seconds
        setTimeout(function() {
            successMessage.style.display = "none";
        }, 3000); // 3000 milliseconds (3 seconds)
    }

    // Function to update the table
    function updateTable() {
        // You can use AJAX to fetch updated data from the server and update the table here
        // For simplicity, I'll just reload the page to demonstrate the concept
        location.reload();
    }

    // Check if the "case_id" is provided in the URL
    if (<?php echo isset($_GET['case_id']) ? 'true' : 'false'; ?>) {
        var caseId = <?php echo isset($_GET['case_id']) ? $_GET['case_id'] : 'null'; ?>;
        if (caseId !== null) {
            displayConfirmationDialog(caseId);
        }
    }
</script>


    <footer>
        <p>&copy; Forensic Database</p>
        <p>Contact: team@coders.com</p>
    </footer>
    
</body>
</html>