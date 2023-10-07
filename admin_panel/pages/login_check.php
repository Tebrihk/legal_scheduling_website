<?php
extract($_POST);
$servername = "localhost";
$username = "root";
$password = "mysql";
$dbname = "scheduler_db";

$conn =mysqli_connect($servername,$username,$password,$dbname);
$email = $_POST['email'];
$password = $_POST['password'];

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}else
{
$sql = mysqli_query($conn, "SELECT email, password FROM admin WHERE email = '$email' and password='$password'");
$row = mysqli_fetch_array($sql);
if (is_array($row)) {
$_SESSION['loggedin'] = true;
      $_SESSION['email'] = $email;
   echo " successfully logged in"; 
   header("Location: index.html");
} else {

   echo "account not found";
   header("Location: auth-login.html");
}
}
$conn->close();
?>