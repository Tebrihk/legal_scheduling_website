<?php
$servername = "localhost";
$username = "root";
$password = "mysql";
$dbname = "legal_scheduling";

$conn = mysqli_connect($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
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

$id = strip_tags($_POST['id']);
$name = strip_tags($_POST['name']);
$email = strip_tags($_POST['email']);
$category = strip_tags($_POST['category']);
$complaint = strip_tags($_POST['complaint']);
$AOR = strip_tags($_POST['AOR']);
$date = strip_tags($_POST['date']);
$time = strip_tags($_POST['time']);
$status = "Adjusted";

$sql = "UPDATE `appointment` SET  status = ? WHERE id = ?";

// Prepare and execute the statement
$stmt = mysqli_prepare($conn, $sql);
if ($stmt) {
    // Bind the parameters
mysqli_stmt_bind_param($stmt, "sssi", $status, $id);

    // Execute the statement
    if (mysqli_stmt_execute($stmt)) {
        $sucMSG = "Appointment adjusted successful";
        header("refresh:1;url=index.php");
    } else {
         $errMSG = "Failed to adjust appointment";
        header("refresh:1;url=adjust.php");
    }

    // Close the prepared statement
    mysqli_stmt_close($stmt);
} else {
    echo "Failed to prepare the statement.";
}
$conn->close();

?>

