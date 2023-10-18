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
	$timeout = 300;

// Check for the user's last activity time
if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity']) > $timeout) {
    // User has been inactive for too long, destroy the session and log them out
    session_unset(); // Unset all session variables
    session_destroy(); // Destroy the session
    header("Location:login.php"); // Redirect to the login page
    exit;
	}
	
		$conn =mysqli_connect($servername,$username,$password,$dbname) or die(mysql_error());
		
		$user = mysqli_real_escape_string($conn, $_SESSION['user']);
		$sql=mysqli_query($conn,"SELECT * FROM appointment WHERE name='$user' ORDER BY id DESC LIMIT 1");
			$row=mysqli_fetch_array($sql);

?>
<?php
$servername = "localhost";
$username = "root";
$password = "mysql";
$dbname = "legal_scheduling";

// Check if the user is logged in
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

$conn = mysqli_connect($servername, $username, $password, $dbname) or die(mysqli_connect_error());

// Get the user's name from the session
$user = mysqli_real_escape_string($conn, $_SESSION['user']);

// Prepare and execute the SQL query to retrieve the second appointment for the user
$sql = "SELECT * FROM appointment WHERE name = ? ORDER BY id DESC LIMIT 1 OFFSET 1";
$stmt = mysqli_prepare($conn, $sql);

if ($stmt) {
    mysqli_stmt_bind_param($stmt, "s", $user);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($result->num_rows > 0) {
        $row1 = mysqli_fetch_assoc($result); // Retrieve the data for the second appointment
    } else {
        echo "No records found for this user.";
    }
} else {
    echo "Failed to prepare the statement.";
}

mysqli_close($conn);
?>
<?php
$servername = "localhost";
$username = "root";
$password = "mysql";
$dbname = "legal_scheduling";

// Check if the user is logged in
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

$conn = mysqli_connect($servername, $username, $password, $dbname) or die(mysqli_connect_error());

// Get the user's name from the session
$user = mysqli_real_escape_string($conn, $_SESSION['user']);

// Prepare and execute the SQL query to retrieve the third appointment for the user
$sql2 = "SELECT * FROM appointment WHERE name = ? ORDER BY id DESC LIMIT 1 OFFSET 2";
$stmt = mysqli_prepare($conn, $sql2);

if ($stmt) {
    mysqli_stmt_bind_param($stmt, "s", $user);
    mysqli_stmt_execute($stmt);
    $result2 = mysqli_stmt_get_result($stmt);

   if ($result2->num_rows > 0) {
    $row2 = mysqli_fetch_assoc($result2); // Retrieve the data for the third appointment
} else {
    echo "No records found for this user.";
}
} else {
    echo "Failed to prepare the statement.";
}

mysqli_close($conn);
?>





<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="utf-8">
    <title>MARK JOHNSON</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">
    <link href="img/favicon.ico" rel="icon">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&family=Roboto:wght@300;500;700&display=swap"
        rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />
    <link href="css/style.css" rel="stylesheet">
	<link href="../css/style.css" rel="stylesheet">
	<link href="../css/style.min.css" rel="stylesheet">

</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 bg-secondary d-none d-lg-block">
                <a href="../appointment.php"
                    class="navbar-brand w-100 h-100 m-0 p-0 d-flex align-items-center justify-content-center">
                    <h1 class="m-0 display-4 text-primary text-uppercase">Justice</h1>
                </a>
            </div>
            <div class="col-lg-9">
                <div class="row bg-white border-bottom d-none d-lg-flex">
                    <div class="col-lg-5 text-right">
                        <div class="d-inline-flex align-items-center p-2">
                            <a class="btn btn-sm btn-outline-primary btn-sm-square mr-2" href="">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a class="btn btn-sm btn-outline-primary btn-sm-square mr-2" href="">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a class="btn btn-sm btn-outline-primary btn-sm-square mr-2" href="">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                            <a class="btn btn-sm btn-outline-primary btn-sm-square mr-2" href="">
                                <i class="fab fa-instagram"></i>
                            </a>
                            <a class="btn btn-sm btn-outline-primary btn-sm-square mr-2" href="">
                                <i class="fab fa-youtube"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <nav class="navbar navbar-expand-lg bg-white navbar-light p-0">
                    <a href="index.html" class="navbar-brand d-block d-lg-none">
                        <h1 class="m-0 display-4 text-primary text-uppercase">MARK JOHNSON</h1>
                    </a>
                    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                        <div class="navbar-nav mr-auto py-0">
                            <a href="team.html" class="nav-item nav-link">Attorneys</a>
                            <a href="../index.html" class="nav-item nav-link">Home</a>
                            <div class="nav-item dropdown">

                                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Profile</a>
                                <div class="dropdown-menu rounded-0 m-0">

                                    <a href="../appointment.php" class="dropdown-item" ><span>Appointment</span>
 </a>
									
                                    <a href="../logout.php" class="dropdown-item">Log out</a>
                                </div>
                            </div>
                        </div>
                    </div>

                </nav>
            </div>
        </div>
    </div>

    <!-- Notification Start -->
	<section class="section-50">
  <div class="container">
    <h3 class="m-b-50 heading-line">Notifications <i class="fa fa-bell text-muted"></i></h3>
    <div class="notification-ui_dd-content">
      <div class="notification-list notification-list--read">
        <div class="notification-list_content">
          <div class="notification-list_img"> <img src="images/users/user1.jpg" alt="user"> </div>
		  <?php
				$servername = "localhost";
				$username = "root";
				$password = "mysql";
				$dbname = "legal_scheduling";
				
				// Check if the user is logged in
				if (!isset($_SESSION['user'])) {
					header("Location: login.php");
					exit;
				}
				
				$conn = mysqli_connect($servername, $username, $password, $dbname) or die(mysqli_connect_error());
				
				// Get the user's name from the session
				$user = mysqli_real_escape_string($conn, $_SESSION['user']);
				
				// Prepare and execute the SQL query to retrieve the second appointment for the user
				$sql = "SELECT * FROM appointment WHERE name = ? ORDER BY id DESC LIMIT 1 OFFSET 1";
				$stmt = mysqli_prepare($conn, $sql);
				
				if ($stmt) {
					mysqli_stmt_bind_param($stmt, "s", $user);
					mysqli_stmt_execute($stmt);
					$result = mysqli_stmt_get_result($stmt);
				
					if ($result->num_rows > 0) {
						$row1 = mysqli_fetch_assoc($result); // Retrieve the data for the second appointment
						$visibilityStyle = 'visible';
					} else {
						// No records found for the user
						$visibilityStyle = 'hidden';
					}
				
					// Close the prepared statement
					mysqli_stmt_close($stmt);
				} else {
					echo "Failed to prepare the statement.";
				}
				
				mysqli_close($conn);
				?>

				<div class="notification-list_detail" style="visibility: <?php echo $visibilityStyle; ?>">
					<p><b><?php echo $row1['name']; ?></b> <?php echo $row1['status']; ?></p>
					<p class="text-muted"><?php echo $row1['complaint']; ?></p>
					<p class="text-muted"><small>date:<?php echo $row1['date'] ?></small></p>
					<p class="text-muted"><small>time:<?php echo $row1['time'] ?></small></p>
				</div>

        </div>
        <div class="notification-list_feature-img"> <img src="images/features/random1.jpg" alt="Feature image"> </div>
      </div>
      <div class="notification-list notification-list--read">
        <div class="notification-list_content">
          <div class="notification-list_img"> <img src="images/users/user1.jpg" alt="user"> </div>
		  <?php
				$servername = "localhost";
				$username = "root";
				$password = "mysql";
				$dbname = "legal_scheduling";
				
				// Check if the user is logged in
				if (!isset($_SESSION['user'])) {
					header("Location: login.php");
					exit;
				}
				
				$conn = mysqli_connect($servername, $username, $password, $dbname) or die(mysqli_connect_error());
				
				// Get the user's name from the session
				$user = mysqli_real_escape_string($conn, $_SESSION['user']);
				
				// Prepare and execute the SQL query to retrieve the second appointment for the user
				$sql2 = "SELECT * FROM appointment WHERE name = ? ORDER BY id DESC LIMIT 1 OFFSET 2";
				$stmt = mysqli_prepare($conn, $sql2);
				
				if ($stmt) {
					mysqli_stmt_bind_param($stmt, "s", $user);
					mysqli_stmt_execute($stmt);
					$result = mysqli_stmt_get_result($stmt);
				
					if ($result->num_rows > 0) {
						$row = mysqli_fetch_assoc($result); // Retrieve the data for the second appointment
						$visibilityStyle = 'visible';
					} else {
						// No records found for the user
						$visibilityStyle = 'hidden';
					}
				
					// Close the prepared statement
					mysqli_stmt_close($stmt);
				} else {
					echo "Failed to prepare the statement.";
				}
				
				mysqli_close($conn);
				?>
          <div class="notification-list_detail" style="visibility: <?php echo $visibilityStyle; ?>">
					<p><b><?php echo $row['name']; ?></b> <?php echo $row['status']; ?></p>
					<p class="text-muted"><?php echo $row['complaint']; ?></p>
					<p class="text-muted"><small>date:<?php echo $row['date'] ?></small></p>
					<p class="text-muted"><small>time:<?php echo $row['time'] ?></small></p>
				</div>
        </div>
        <div class="notification-list_feature-img"> <img src="images/features/random2.jpg" alt="Feature image"> </div>
      </div>
      <div class="notification-list notification-list--read">
        <div class="notification-list_content">
          <div class="notification-list_img"> <img src="images/users/user1.jpg" alt="user"> </div>
		  <?php
				$servername = "localhost";
				$username = "root";
				$password = "mysql";
				$dbname = "legal_scheduling";
				
				// Check if the user is logged in
				if (!isset($_SESSION['user'])) {
					header("Location: login.php");
					exit;
				}
				
				$conn = mysqli_connect($servername, $username, $password, $dbname) or die(mysqli_connect_error());
				
				// Get the user's name from the session
				$user = mysqli_real_escape_string($conn, $_SESSION['user']);
				
				// Prepare and execute the SQL query to retrieve the second appointment for the user
				$sql3 = "SELECT * FROM appointment WHERE name = ? ORDER BY id DESC LIMIT 1 OFFSET 2";
				$stmt = mysqli_prepare($conn, $sql2);
				
				if ($stmt) {
					mysqli_stmt_bind_param($stmt, "s", $user);
					mysqli_stmt_execute($stmt);
					$result = mysqli_stmt_get_result($stmt);
				
					if ($result->num_rows > 0) {
						$row3 = mysqli_fetch_assoc($result); // Retrieve the data for the second appointment
						$visibilityStyle = 'visible';
					} else {
						// No records found for the user
						$visibilityStyle = 'hidden';
					}
				
					// Close the prepared statement
					mysqli_stmt_close($stmt);
				} else {
					echo "Failed to prepare the statement.";
				}
				
				mysqli_close($conn);
				?>
           <div class="notification-list_detail" style="visibility: <?php echo $visibilityStyle; ?>">
					<p><b><?php echo $row3['name']; ?></b> <?php echo $row3['status']; ?></p>
					<p class="text-muted"><?php echo $row3['complaint']; ?></p>
					<p class="text-muted"><small>date:<?php echo $row3['date'] ?></small></p>
					<p class="text-muted"><small>time:<?php echo $row3['time'] ?></small></p>
				</div>
        </div>
        <div class="notification-list_feature-img"> <img src="images/features/random3.jpg" alt="Feature image"> </div>
      </div>
      
</section>
  
    <!-- Appointment End -->



    <!-- Footer Start -->
    <div class="container-fluid bg-secondary text-white pt-5 px-sm-3 px-md-5" style="margin-top: 90px;">
        <div class="row mt-5">
            <div class="col-lg-4">
                <div class="d-flex justify-content-lg-center p-4" style="background: rgba(256, 256, 256, .05);">
                    <i class="fa fa-2x fa-map-marker-alt text-primary"></i>
                    <div class="ml-3">
                        <h5 class="text-white">Our Office</h5>
                        <p class="m-0">No 17 Independence way,Kaduna Nigeria.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="d-flex justify-content-lg-center p-4" style="background: rgba(256, 256, 256, .05);">
                    <i class="fa fa-2x fa-envelope-open text-primary"></i>
                    <div class="ml-3">
                        <h5 class="text-white">Email Us</h5>
                        <p class="m-0">MarkJohnson.info@gmail.com</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="d-flex justify-content-lg-center p-4" style="background: rgba(256, 256, 256, .05);">
                    <i class="fa fa-2x fa-phone-alt text-primary"></i>
                    <div class="ml-3">
                        <h5 class="text-white">Call Us</h5>
                        <p class="m-0">+234 8193 456 2345</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row pt-5">
            <div class="col-lg-3 col-md-6 mb-5">

                <div class="d-flex justify-content-start mt-4">
                    <a class="btn btn-lg btn-outline-light btn-lg-square mr-2" href="#"><i
                            class="fab fa-twitter"></i></a>
                    <a class="btn btn-lg btn-outline-light btn-lg-square mr-2" href="#"><i
                            class="fab fa-facebook-f"></i></a>
                    <a class="btn btn-lg btn-outline-light btn-lg-square mr-2" href="#"><i
                            class="fab fa-linkedin-in"></i></a>
                    <a class="btn btn-lg btn-outline-light btn-lg-square" href="#"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-5">
                <h4 class="font-weight-semi-bold text-primary mb-4">Popular Links</h4>
                <div class="d-flex flex-column justify-content-start">
                    <a class="text-white mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Home</a>
                    <a class="text-white mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>About</a>
                    <a class="text-white mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Services</a>
                    <a class="text-white mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Attorney</a>
                    <a class="text-white" href="#"><i class="fa fa-angle-right mr-2"></i>Contact</a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-5">
            </div>
            <div class="col-lg-3 col-md-6 mb-5">

                <div class="w-100">
                    <div class="input-group">
                        <input type="text" class="form-control border-0" style="padding: 25px;"
                            placeholder="Your Email">
                        <div class="input-group-append">
                            <button class="btn btn-primary px-4">Sign Up</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row p-4 mt-5 mx-0" style="background: rgba(256, 256, 256, .05);">
            <div class="col-md-6 text-center text-md-left mb-3 mb-md-0">
                <p class="m-0 text-white">&copy; <a class="font-weight-bold" href="#">Your Site Name</a>. All Rights
                    Reserved.</p>
            </div>
            <div class="col-md-6 text-center text-md-right">
                <p class="m-0 text-white">Designed by <a class="font-weight-bold"
                        href="11enterprise.wordpress.com">e11even enterpris</a></p>
            </div>
        </div>
    </div>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-primary px-3 back-to-top"><i class="fa fa-angle-double-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Contact Javascript File -->
    <script src="mail/jqBootstrapValidation.min.js"></script>
    <script src="mail/contact.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>
