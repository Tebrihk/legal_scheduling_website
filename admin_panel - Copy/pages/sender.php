<?php
$servername = "localhost";
$username = "root";
$password = "mysql";
$dbname = "legal_scheduling";
$conn = mysqli_connect($servername, $username, $password, $dbname) or die(mysqli_connect_error());

$message = trim($_POST['message']);
$message = strip_tags($message);
$message = htmlspecialchars($message);

$email = trim($_POST['email']);
$email = strip_tags($email);
$email = htmlspecialchars($email);

$id = trim($_POST['id']);
$id = strip_tags($id);
$id = htmlspecialchars($id);

$to = $email;
$subject = "YOUR APPOINTMENT WITH MARK JOHNSON FIRM";
$messages = $message; // Add $ to indicate it's a variable.
$headers = "From: zachariahcovenant@gmail.com";

// Send email
$mailSent = mail($to, $subject, $messages, $headers);

if ($mailSent) {
   $sucMSG = "Email sent";
   
    if (mysqli_query($conn, $sql)) {
       header("Location:index.php");
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }
} else {
   $errMSG = "Email sending failed";
}
?>
