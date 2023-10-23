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

$to = $email;
$subject = "YOUR APPOINTMENT WITH MARK JOHNSON FIRM";
$message = $message; // Add $ to indicate it's a variable.
$headers = "From: covenant@example.com";

// Send email
$mailSent = mail($to, $subject, $message, $headers);

if ($mailSent) {
    echo "Email sent successfully.";
    $sql = "DELETE FROM adjust WHERE email='$email'";
    if (mysqli_query($conn, $sql)) {
       header("Location:index.php");
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }
} else {
    echo "Email sending failed.";
}
?>
