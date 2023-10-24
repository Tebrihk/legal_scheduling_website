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

 $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $newValue = "Accepted";

    // SQL query to update the status column for the appointment
    $sql = "UPDATE appointment SET status = ? WHERE id = ?";
	$sql1 = "UPDATE assigned SET status = ? WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
	 $stmt1 = mysqli_prepare($conn, $sql1);

    if ($stmt) {
        // Bind the parameters
        mysqli_stmt_bind_param($stmt, "si", $newValue, $id);

        // Execute the update statement
        if (mysqli_stmt_execute($stmt)) {
            echo "Record updated successfully.";
			header("refresh:1;url=index.php");
           
        } else {
            echo "Error updating record: " . mysqli_error($conn);
        }
		if ($stmt1) {
        // Bind the parameters
        mysqli_stmt_bind_param($stmt1, "si", $newValue, $id);

        // Execute the update statement
        if (mysqli_stmt_execute($stmt1)) {
            echo "Record updated successfully.";
			header("refresh:1;url=index.php");
           
        } else {
            echo "Error updating record: " . mysqli_error($conn);
        }

        // Close the prepared statement
        mysqli_stmt_close($stmt);
    } else {
        echo "Failed to prepare the statement: " . mysqli_error($conn);
    }
	mysqli_stmt_close($stmt1);
    } else {
        echo "Failed to prepare the statement: " . mysqli_error($conn);
    }
}

// Close the database connection
mysqli_close($conn);
?>
