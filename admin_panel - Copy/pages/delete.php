<?php
$servername = "localhost";
$username = "root";
$password = "mysql";
$dbname = "legal_scheduling";

$conn = mysqli_connect($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

session_start();
if (empty($_SESSION['user'])) {
    header('location: index.php');
}

$id = $_GET['id'];
$sql = "DELETE FROM attorneys WHERE id='$id'";
if (mysqli_query($conn, $sql)) {
    $sucMSG = "Record deleted successful";
	header("refresh:1;url=attorney.php");
} else {
    $errMSG = "Record did not delete";
	header("refresh:1;url=attorney_table.php");
}

mysqli_close($conn);
?>
