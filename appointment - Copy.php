<?php
    $servername = "localhost";
	$username = "root";
	$password = "mysql";
	$dbname = "legal_scheduling";
	
	
    ob_start();
	session_start();
	
	// if session is not set this will redirect to login page
	if( !isset($_SESSION['user']) ) {
		 header("Location:login.php");
		exit;
	}
	
	$timeout = 300;

// Check for the user's last activity time
if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity']) > $timeout) {

    session_unset(); 
    session_destroy(); // Destroy the session
    header("Location:login.php"); // Redirect to the login page
    exit;
	}
		$conn =mysqli_connect($servername,$username,$password,$dbname) or die(mysql_error());
		
		$user = mysqli_real_escape_string($conn, $_SESSION['user']);
		$sql=mysqli_query($conn,"SELECT * FROM client WHERE name='$user'");
			$row=mysqli_fetch_array($sql);

?>
<?php
$servername = "localhost";
$username = "root";
$password = "mysql";
$dbname = "legal_scheduling";

// Check if the form is submitted
if (isset($_POST['submit'])) {
    // Get and sanitize user inputs
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $category = trim($_POST['category']);
    $complaint = trim($_POST['complaint']);
	$AOR = 'Unassigned';
    $date = trim($_POST['date']);
    $time = trim($_POST['time']);
    $status = 'Pending';
    
    // Check if the appointment date is in the past
    $currentDate = date("m/d/Y");
if ($date < $currentDate) {
    $sucMSG = "Error: You cannot schedule appointments in the past.";
    header("Location:appointment.php"); // Redirect to the appointment.php page

} else {
        // Attempt to connect to the database
        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Use prepared statements to insert data into the database
        $stmt = $conn->prepare("INSERT INTO appointment (name, email, category, complaint, AOR, date, time, status, timestamp) VALUES (?, ?, ?, ?, ?, ?, ?, ?, NOW())");
        $stmt->bind_param("ssssssss", $name, $email, $category, $complaint, $AOR, $date, $time, $status);

		
        if ($stmt->execute() ) {
            // Insertion successful
            $sucMSG = "Appointment successfully sent.";
 			header("Location:success.php");
           
        } else {
            // Handle the database insert error
            $errMSG = "Failed to set appointment";
        }

        $stmt->close();
        $conn->close();
    }
}
?>

<?php
if (isset($_POST['submit'])) {
    // Get and sanitize user inputs
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $category = trim($_POST['category']);
    $complaint = trim($_POST['complaint']);
	$AOR = 'Unassigned';
    $date = trim($_POST['date']);
    $time = trim($_POST['time']);
    $status = 'Pending';
    

 // Send email
            $to = $email;
            $subject = "YOUR APPOINTMENT WITH MARK JOHNSON FIRM";
            $message = "Dear $name, Your appointment has been scheduled for $date at $time. Please check your account for more details.";
            $headers = "From: zachariahcovenant@gmail.com";

            $mailSent = mail($to, $subject, $message, $headers);

            if ($mailSent) {
               
            } else {
                // Email sending failed
                $errMSG = "Email sending failed.";
				header("Location:success.php");
            }
			}
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
	<style type="text/css">
#notification {
  background-color: #555;
  color: white;
  text-decoration: none;
  padding: 15px 26px;
  position: relative;
  display: inline-block;
  border-radius: 2px;
}

#notification:hover {
  background: red;
}

#notification .badge {
  position: absolute;
  top: -10px;
  right: -10px;
  padding: 5px 10px;
  border-radius: 50%;
  background: red;
  color: white;
  }
</style>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 bg-secondary d-none d-lg-block">
                <a href="index.html"
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
                            <a href="index.html" class="nav-item nav-link">Home</a>
                            <div class="nav-item dropdown">

                                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Profile</a>
                                <div class="dropdown-menu rounded-0 m-0">
								
                                    <a href="notification/index.php" class="dropdown-item" id="notification"><span>Notification</span>
  <span class="badge" id="notification" style="display: none">1</span></a>
									
                                    <a href="logout.php" class="dropdown-item">Log out</a>
                                </div>
                            </div>
                        </div>
                    </div>

                </nav>
            </div>
        </div>
    </div>

    <!-- Appointment Start -->
    <div class="container-fluid py-5" style="background-image:url(img/LAW.jpg);">
        <div class="container py-5">
            <div class="bg-appointment rounded">
                <div class="row h-100 align-items-center justify-content-center">
                    <div class="col-lg-6 py-5">
                        <div class="rounded p-5 my-5" style="background: rgba(55, 55, 63, .7);">
                            <h1 class="text-center text-white mb-4">Get An Appointment</h1>
                            <form action="#" method="POST">
							 <?php
			if ( isset($errMSG) ) {
				
				?>
				<div class="form-group">
            	<div class="alert alert-danger">
				<span class="glyphicon glyphicon-info-sign"></span> <?php echo $errMSG; ?>
                </div>
            	</div>
                <?php
			}
			?>
			 <?php
			if ( isset($sucMSG) ) {
				
				?>
				<div class="form-group" style="position: relative;
  padding: 0.75rem 1.25rem;
  margin-bottom: 1rem;
  border: 1px solid transparent;
  border-radius: 5px;
  font-weight: 700;
  color:#FFFFFF;
  background-color:#00FFFF;">
				<span class="glyphicon glyphicon-info-sign"></span> <?php echo $sucMSG; ?>
            	</div>
                <?php
			}
			?>
                                <div class="form-group" >
                                 <input type="text" name="name"  class="form-control border-0 p-4" value="<?php 
								 if($row){
								 echo $row['name'];
								 }else
								 {echo "user is logged out";
								 header("Location:login.php");
								 } ?>" style="width:355px;" readonly />
                                </div>
								<div class="form-group" >
                                 <input type="text" name="email"  class="form-control border-0 p-4" value="<?php 
								 if($row){
								 echo $row['email'];
								 }else
								 {echo "user is logged out";
								 header("Location:login.php");
								 } ?>" style="width:355px;" readonly />
                                </div>
								 <div class="form-group">
                                    <select class="custom-select border-0 px-4" style="height: 47px; width:355px; " name="category">
									<option value="#">Select Category</option>
                                        <option value="Civil law">Civil law</option>
                                        <option value="Family law">Family law</option>
                                        <option value="Corperate law">Corperate law</option>
										<option value="Crimal law">Crimal law</option>
										<option value="Business law">Business law</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <textarea placeholder="Your Complaint" style="height:250px; width:355px" name="complaint" required></textarea>
                                </div>
                                <div class="form-row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <div class="date" id="date" data-target-input="nearest">
                                                <input type="text"
                                                    class="form-control border-0 p-4 datetimepicker-input"
                                                    placeholder="Select Date" data-target="#date"
                                                    data-toggle="datetimepicker" name="date" id="date" reqiured/>
													<script>
    // Get the current date
    var today = new Date();

    // Format it as yyyy-mm-dd (compatible with the 'date' input)
    var yyyy = today.getFullYear();
    var mm = String(today.getMonth() + 1).padStart(2, '0'); // January is 0!
    var dd = String(today.getDate()).padStart(2, '0');
    today = yyyy + '-' + mm + '-' + dd;

    // Set the 'min' attribute for the input element
    document.getElementById("date").setAttribute("min", today);
</script>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <div class="time" id="time" data-target-input="nearest">
                                                <input type="text"
                                                    class="form-control border-0 p-4 datetimepicker-input"
                                                    placeholder="Select Time" data-target="#time"
                                                    data-toggle="datetimepicker" name="time" />
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div>
                                    <button class="btn btn-primary btn-block border-0 py-3" type="submit" name="submit">Request
                                        Appointment</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
	<script>
$(document).ready(function() {
    function checkForNewRecords() {
        $.ajax({
            url: 'check_for_new_record.php', // PHP script to check for new records
            method: 'GET',
            dataType: 'json',
            success: function(data) {
                if (data.newRecord) {
                    $('#notification').show(); // Show the notification if a new record is found
                }
            }
        });
    }

    // Check for new records every 5 seconds (you can adjust the interval)
    setInterval(checkForNewRecords, 5000);
});
</script>

</body>
</html>
<?php ob_end_flush(); ?>