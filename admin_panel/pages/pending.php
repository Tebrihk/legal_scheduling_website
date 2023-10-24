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
	
$sql = "UPDATE `appointment` SET  status = ? WHERE id = ?";

// Prepare and execute the statement
$stmt = mysqli_prepare($conn, $sql);
if ($stmt) {
    // Bind the parameters
    mysqli_stmt_bind_param($stmt, "si", $status, $id);

    // Execute the statement
    if (mysqli_stmt_execute($stmt)) {
        echo "Record edited successfully.";
        header("refresh:1;url=index.php");
    } else {
        echo "Attorney not assigned.";
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
<?php
$servername = "localhost";
$username = "root";
$password = "mysql";
$dbname = "legal_scheduling";

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
	
	$sql1 = "INSERT INTO assigned (id, name, email, category, complaint, AOR, date, time, status, timestamp) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())";
$stmt1 = mysqli_prepare($conn, $sql1);
if ($stmt1) {
    // Bind the parameters
    mysqli_stmt_bind_param($stmt1, "ssssssiss", $id, $name, $email, $category, $complaint, $AOR, $date, $time, $status);

    // Execute the statement
    if (mysqli_stmt_execute($stmt1)) {
        header("refresh:1;url=index.php");
    } else {
        echo "Attorney not assigned.";
        header("refresh:1;url=assign.php");
    }

    // Close the prepared statement
    mysqli_stmt_close($stmt1);
} else {
    echo "Failed to prepare the statement.";
}
header("refresh:1;url=index.php");
	 }
?>
