<?php
    $servername = "localhost";
	$username = "root";
	$password = "mysql";
	$dbname = "legal_scheduling";
	
	
    ob_start();
	session_start();
	
	// if session is not set this will redirect to login page
	if( !isset($_SESSION['user']) ) {
		header("refresh:1;url=login.php");
		exit;
	}
		$conn =mysqli_connect($servername,$username,$password,$dbname) or die(mysql_error());
		
		$user = mysqli_real_escape_string($conn, $_SESSION['user']);
		$sql=mysqli_query($conn,"SELECT * FROM attorneys WHERE name='$user'");
			$row=mysqli_fetch_array($sql);

?> 
				<?php
					$servername = "localhost";
					$username = "root";
					$password = "mysql";
					$dbname = "legal_scheduling";
					
					$conn = mysqli_connect($servername, $username, $password, $dbname);
					
					if ($conn->connect_error) {
						die("Connection failed: " . $conn->connect_error);
					}
					
					$id = $_GET['id'];
					$newValue = "Accepted";
					
					// SQL query to update the status column
					$sql = "UPDATE pend SET status = ? WHERE id = ?";
					$stmt = mysqli_prepare($conn, $sql);
					
					if ($stmt) {
						// Bind the parameters
						mysqli_stmt_bind_param($stmt, "si", $newValue, $id);
					
						// Execute the update statement
						if (mysqli_stmt_execute($stmt)) {
							echo "Record updated successfully.";
							header("Location:index.php");
						} else {
							echo "Error updating record: " . mysqli_error($conn);
						}
					
						// Close the prepared statement
						mysqli_stmt_close($stmt);
					} else {
						echo "Failed to prepare the statement: " . mysqli_error($conn);
					}
					
					// Close the database connection
					mysqli_close($conn);
?>