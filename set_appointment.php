<?php
session_start();
extract($_POST);
$servername = "localhost";
$username = "root";
$password = "mysql";
$dbname = "legal_scheduling";

$conn =mysqli_connect($servername,$username,$password,$dbname);
$name = $_POST['name'];
$category = $_POST['category'];
$complaint = $_POST['complaint'];
$date = $_POST['date'];
$time = $_POST['time'];

$sql = "insert into appointment (name,category,complaint,date,time) values ('$name','$category','$complaint','$date','$time')";
				
			if ($conn->query($sql) === true) {
				$errTyp = "success";
				$errMSG = "Successfully registered";
				header("Location: appointment.php");
				
			} else {
				$errTyp = "danger";
				$errMSG = "Something went wrong, try again later...";	
			}	
$conn->close();

?>