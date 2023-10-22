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
    $complaint = $_POST['complaint'];
	 $AOR= $_POST['AOR'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $status = 'pending';
	
	$sql =mysqli_query($conn, "insert into pend (id,name,email,complaint,AOR,date,time,status) values ('$id','$name','$email','$complaint','$AOR','$date','$time','$status')");
	
	$sql1 = mysqli_query($conn, "insert into assigned (id, name, email, complaint, AOR, date, time, status) values ('$id', '$name', '$email', '$complaint', '$AOR', '$date', '$time', '$status')");

	}
	$sql1 = mysqli_query($conn, "delete from pend ");
	 header("refresh:1;url=index.php");

?>
