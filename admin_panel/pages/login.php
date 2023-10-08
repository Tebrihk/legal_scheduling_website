<?php
	ob_start();
	session_start();
	
	$servername = "localhost";
	$username = "root";
	$password = "mysql";
	$dbname = "legal_scheduling";
	
	$conn =mysqli_connect($servername,$username,$password,$dbname);
	$error = false;
	$emailError = false;
	$passError = false;
	
	if( isset($_POST['login']) ) {	
		
		// prevent sql injections/ clear user invalid inputs
		$email = trim($_POST['email']);
		$email = strip_tags($email);
		$email = htmlspecialchars($email);
		
		$password = trim($_POST['password']);
		$password = strip_tags($password);
		$password = htmlspecialchars($password);
		
		if(empty($email)){
			$error = true;
			$emailError = "Please enter your email address.";
		} else if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {
			$error = true;
			$emailError = "Please enter valid email address.";
		}
		
		if(empty($password)){
			$error = true;
			$passError = "Please enter your password.";
		}
		
		
		if (!$error) {
			
			$pass = hash('sha256', $password); // password hashing using SHA256
		
			$sql=mysqli_query($conn, "SELECT name,email,password FROM admin WHERE email='$email'");
			$row=mysqli_fetch_array($sql);
			$count = mysqli_num_rows($sql); 
			if ($count == 1 && $row['password']==$pass) {
			$_SESSION['user'] = $row['name'];
			 $errMSG = "Login succefully";
			header("refresh:1;url=index.php");
			} else {
			
			  $errMSG = "Incorrect Credentials, Try again...";
			  header("refresh:1;url=auth-login.php");
			}
				
		}
		
	}
		
		
	?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"
        integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w=="
        crossorigin="anonymous" />


    <link rel="stylesheet" href="../vendor/bootstrap/css/bootstrap.min.css">

    <link rel="stylesheet" href="../assets/css/style.css">
    <!-- <link rel="stylesheet" href="../vendor/themify-icons/themify-icons.css"> -->
    <link rel="stylesheet" href="../assets/css/bootstrap-override.css">


</head>

<body>
<section class="container h-100">
    <div class="row justify-content-sm-center h-100 align-items-center">
        <div class="col-xxl-4 col-xl-5 col-lg-6 col-md-7 col-sm-8">
            <div class="card shadow-lg">
                <div class="card-body p-4">
                    <h1 class="fs-4 text-center fw-bold mb-4">Login</h1>
                    <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off" >
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
                        <div class="mb-3">
                           
                            <div class="input-group input-group-join mb-3">
                                <input id="email" type="email" placeholder="Enter Email" class="form-control"
                                    name="email" value="" required autofocus>
                                    <span class="input-group-text rounded-end">&nbsp<i class="fa fa-envelope"></i>&nbsp</span>
                                <span class="text-danger"><?php echo $emailError; ?></span>
                        </div>

                        <div class="mb-3">
                            <div class="mb-2 w-100">
                                
                                                      </div>
                            <div class="input-group input-group-join mb-3">
                                <input type="password" class="form-control" placeholder="Your password" required name="password">
                                <span class="input-group-text rounded-end password cursor-pointer">&nbsp<i class="fa fa-eye"></i>&nbsp</span>
                                <span class="text-danger"><?php echo $passError; ?></span>
                        </div>
<div class="form-check">
                                <input type="checkbox" name="remember" id="remember" class="form-check-input">
                                <label for="remember" class="form-check-label">Remember Me</label>
                            </div>
                        <div class="d-flex align-items-center">
                            
							
                            <button type="submit" class="btn btn-primary ms-auto" name="login">
                                Login                            </button>
                        </div>
						 <div class="text-center">
                        Don't have an account? <a href="sign_up.php" class="text-dark">sign up instead</a>
                    </div>
                    </form>
                   
            </div>
            <div class="text-center mt-5 text-muted">
                Copyright &copy; 2023 &mdash; e11even enterprise
            </div>
        </div>
    </div>
</section>
<script src="../assets/js/login.js"></script>
</body>
</html>