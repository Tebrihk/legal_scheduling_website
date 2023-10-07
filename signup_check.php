
<?php
$servername = "localhost";
$username = "root";
$password = "mysql";
$dbname = "legal_scheduling";

$conn = new mysqli($servername,$username,$password,$dbname);

$name = $_POST['name'];
$email = $_POST['email'];
$address = $_POST['address'];
$password = $_POST['password'];
$cpassword = $_POST['confirm_password'];

$sql = "insert into client (name,email,address,password) values ('$name','$email','$address','$password')";
if ($conn->query($sql) === true)
{
echo "successful";
header("Location: login.php");
}else{
echo "error" . $sql . "<br>" . $conn->error;
}
$conn->close();

?>
