<?php
$servername = "localhost";
$username = "root";
$password = "mysql";
$dbname = "legal_scheduling";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

ob_start();
session_start();

// If the session is not set, this will redirect to the login page
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

// Establish a new connection for the insert operation
$connInsert = mysqli_connect($servername, $username, $password, $dbname);

if (!$connInsert) {
    die("Connection failed: " . mysqli_connect_error());
}

// Get the user from the session
$user = mysqli_real_escape_string($connInsert, $_SESSION['user']);

// Select records from the 'adjust' table
$sql = "SELECT * FROM adjust WHERE name = '$user'";
$result = mysqli_query($connInsert, $sql);

if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $id = $row['id']; 
        $name = $row['name']; 
        $email = $row['email'];
		$complaint = $row['complaint'];
		$AOR = $row['AOR'];
		$date = $row['date'];
		$time = $row['time'];
		$status = "approved"; 

        
        $insertQuery = "INSERT INTO accept (id, name, email,complaint, AOR, date,time,status) VALUES ('$id', '$name', '$email','$complaint','$AOR','$date','$time','$status')";
        if (mysqli_query($connInsert, $insertQuery)) {
            echo "Record inserted successfully.<br>";
			header("Location:index.php");
        } else {
            // Handle insertion errors here
            echo "Error: " . mysqli_error($connInsert) . "<br>";
        }
    }
} else {
    echo "Error selecting records: " . mysqli_error($connInsert);
}

mysqli_close($connInsert);
?>
