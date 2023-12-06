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
$timeout = 300;

// Check for the user's last activity time
if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity']) > $timeout) {
    // User has been inactive for too long, destroy the session and log them out
    session_unset(); // Unset all session variables
    session_destroy(); // Destroy the session
    header("Location:login.php"); // Redirect to the login page
    exit;
	}

 $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $newValue = "Declined";

    // SQL query to update the status column for the appointment
    $sql = "UPDATE appointment SET status = ? WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    if ($stmt) {
        // Bind the parameters
        mysqli_stmt_bind_param($stmt, "si", $newValue, $id);

        // Execute the update statement
        if (mysqli_stmt_execute($stmt)) {
			
			header("Location:index.php");
        } else {
            echo "Error declining appointment: " . mysqli_error($conn);
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
