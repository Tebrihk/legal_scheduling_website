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
    $category = $_POST['category'];
    $complaint = $_POST['complaint'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $status = 'pending';

    // Prepare the SQL statement with placeholders
    $sql = "UPDATE appointment SET name = ?, category = ?, date = ?, complaint = ?, time = ?, status = ? WHERE id = ?";

    // Prepare and execute the statement
    $stmt = mysqli_prepare($conn, $sql);
    if ($stmt) {
        // Bind the parameters
        mysqli_stmt_bind_param($stmt, "ssssssi", $name, $category, $date, $complaint, $time, $status, $id);

        // Execute the statement
        if (mysqli_stmt_execute($stmt)) {
            echo "Record updated successfully.";
            header("refresh:1;url=table-basic.php");
			    } else {
            echo "Record not updated.";
            header("refresh:1;url=assign-attorney_table.php");
        }

        // Close the prepared statement
        mysqli_stmt_close($stmt);
    } else {
        echo "Failed to prepare the statement.";
		header("refresh:1;url=assign-attorney.php");
    }
}

		if (isset($_POST['push'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $complaint = $_POST['complaint'];
	 $AOR= $_POST['AOR'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $status = 'pending';
	
	$sql =mysqli_query($conn, "insert into pend (name,complaint,AOR,date,time,status) values ('$name','$complaint','$AOR','$date','$time','$status')");
	}

?>
