<?php
$servername = "localhost";
$username = "root";
$password = "mysql";
$dbname = "legal_scheduling";

ob_start();
session_start();

// if the session is not set, this will redirect to the login page
if (!isset($_SESSION['user'])) {
    header("refresh:1;url=login.php");
    exit;
}

$conn = mysqli_connect($servername, $username, $password, $dbname) or die(mysqli_error($conn);

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $newValue = "Accepted";

    // SQL query to update the status column for the appointment
    $sql = "UPDATE appointment SET status = ? WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        // Bind the parameters
        mysqli_stmt_bind_param($stmt, "si", $newValue, $id);

        // Execute the update statement
        if (mysqli_stmt_execute($stmt)) {
            echo "Record updated successfully.";

            // Send email
            $to = $email; // Replace with the recipient's email address
            $subject = "YOUR APPOINTMENT WITH MARK JOHNSON FIRM";
            $message = "Your appointment has been accepted. Please check your account for details."; // Modify the message as needed
            $headers = "From: covenant@example.com";

            // Send the email
            $mailSent = mail($to, $subject, $message, $headers);

            if ($mailSent) {
                header("refresh:1;url=index.php");
            } else {
                // Handle email sending failure
                echo "Email sending failed.";
            }
        } else {
            echo "Error updating record: " . mysqli_error($conn);
        }

        // Close the prepared statement
        mysqli_stmt_close($stmt);
    } else {
        echo "Failed to prepare the statement: " . mysqli_error($conn);
    }
}

// Close the database connection
mysqli_close($conn);
?>
