<?php
$servername = "localhost";
$username = "root";
$password = "mysql";
$dbname = "legal_scheduling";

$conn = mysqli_connect($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = strip_tags($_POST['id']);
$name = strip_tags($_POST['name']);
$complaint = strip_tags($_POST['complaint']);
$AOR = strip_tags($_POST['AOR']);
$date = strip_tags($_POST['date']);
$time = strip_tags($_POST['time']);
$status = "adjusted";

$sql = "INSERT INTO adjust (id, name, complaint, AOR, date, time, status) VALUES ('$id', '$name', '$complaint', '$AOR', '$date', '$time', '$status')";

if ($conn->query($sql) === true) {
    $sql1 = "UPDATE pend SET date = '$date', time = '$time',status = '$status' WHERE id = $id";
    if ($conn->query($sql1) === true) {
	echo "successfull "; 
        header("location:index.php");
    } else {
        echo "Error updating pend: " . $conn->error;
    }
} else {
    echo "Error inserting record: " . $conn->error;
}

$conn->close();
?>
