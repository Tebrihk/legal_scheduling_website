<?php
$servername = "localhost";
$username = "root";
$password = "mysql";
$dbname = "legal_scheduling";

$conn = mysqli_connect($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Ensure you get the other POST values here. For example:
$id = strip_tags($_POST['id']);
$name = strip_tags($_POST['name']);
$email = strip_tags($_POST['email']);
$address = strip_tags($_POST['address']);
$password = strip_tags($_POST['password']);
$practise = strip_tags($_POST['practise']);

$pass = hash('sha256', $password);

// Prepare the SQL statement with placeholders
$sql = "UPDATE `attorneys` SET name = ?, email = ?, `address` = ?, password = ?, practise = ? WHERE id = ?";

// Prepare and execute the statement
$stmt = mysqli_prepare($conn, $sql);
if ($stmt) {
    // Bind the parameters
    mysqli_stmt_bind_param($stmt, "sssssi", $name, $email, $address, $pass, $practise, $id);

    // Execute the statement
    if (mysqli_stmt_execute($stmt)) {
        $sucMSG = "Record edited successful";
        header("refresh:1;url=index.php");
    } else {
         $errMSG = "Record did not edit";
        header("refresh:1;url=attorney_table.php");
    }

    // Close the prepared statement
    mysqli_stmt_close($stmt);
} else {
    echo "Failed to prepare the statement.";
}
?>
