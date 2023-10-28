<?php
$servername = "localhost";
$username = "root";
$password = "mysql";
$dbname = "legal_scheduling";

ob_start();
session_start();

// If the session is not set, this will redirect to the login page
if (!isset($_SESSION['user'])) {
    header("refresh:1;url=login.php");
    exit;
}

$conn = mysqli_connect($servername, $username, $password, $dbname) or die(mysqli_error($conn));

		if (isset($_POST['push'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
	$email = $_POST['email'];
	$category = $_POST['category'];
    $complaint = $_POST['complaint'];
	 $AOR= $_POST['AOR'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $status = 'Assigned';
	
$sql = "UPDATE `appointment` SET status = ?, AOR = ? WHERE id = ?";

// Prepare and execute the statement
$stmt = mysqli_prepare($conn, $sql);
if ($stmt) {
    // Bind the parameters
    mysqli_stmt_bind_param($stmt, "ssi", $status, $AOR, $id);

    // Execute the statement
    if (mysqli_stmt_execute($stmt)) {
        $sucMSG = "Successfully assigned an attorney";
        header("refresh:1;url=index.php");
    } else {
        $errMSG = "Attorney couldn't be assigned";
        header("refresh:1;url=assign.php");
    }

    // Close the prepared statement
    mysqli_stmt_close($stmt);
} else {
    echo "Failed to prepare the statement.";
}


	 header("refresh:1;url=index.php");
	 }
?>
