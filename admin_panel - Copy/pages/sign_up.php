<?php

	$servername = "localhost";
	$username = "root";
	$password = "mysql";
	$dbname = "legal_scheduling";
	
	$conn = new mysqli($servername,$username,$password,$dbname);
	$error = false;
	$nameError = false;
		$emailError = false;


if ( isset($_POST['submit']) ) {
        $name = trim($_POST['name']);
		$name = strip_tags($name);
		$name = htmlspecialchars($name);
		
		$email = trim($_POST['email']);
		$email = strip_tags($email);
		$email = htmlspecialchars($email);
		
		$password = trim($_POST['password']);
		$password = strip_tags($password);
		$password = htmlspecialchars($password);
		
		//additonal validation 
		if (empty($name)) {
			$error = true;
			$nameError = "Please enter your full name.";
		} else if (strlen($name) < 3) {
			$error = true;
			$nameError = "Name must have atleat 3 characters.";
		} else if (!preg_match("/^[a-zA-Z ]+$/",$name)) {
			$error = true;
			$nameError = "Name must contain alphabets and space.";
		}
		
		//basic email validation
		if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {
			$error = true;
			$emailError = "Please enter valid email address.";
		} else {
			// check email exist or not
			$sql1 = mysqli_query($conn, "SELECT email FROM admin WHERE email='$email'");
			$count = mysqli_num_rows($sql1);
			if($count!=0){
				$error = true;
				$emailError = "the email you provided has already been used";
			}
		}
		//this is the hashing of the password for security
		$pass = hash('sha256', $password);
		
		if( !$error ) {
		
		$sql =mysqli_query($conn, "insert into admin (name,email,password) values ('$name','$email','$pass')");
        if ($conn->query($sql) === true)
           {
                $errTyp = "success";
				$sucMSG = "Successfully registered";
				
				unset($name);
				unset($email);
				unset($address);
				unset($password);
				header("Location: login.php");
				
					}else{
						header("Location: login.php");
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
    <title>Admin</title>
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
                    <h1 class="fs-4 text-center fw-bold mb-4">Register</h1>
                    <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>"
                        autocomplete="off">
						<?php
			if ( isset($errMSG) ) {
				
				?>
				<div class="form-group">
            	<div class="alert alert-<?php echo ($errTyp=="success") ? "success" : $errTyp; ?>">
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
                        <div class="mb-3">
                            <label class="mb-2 text-muted" for="email">Full Name</label>
                            <div class="input-group input-group-join mb-3">
                                <input type="text" placeholder="Enter Your Name" class="form-control"
                                    name="name" value="" required autofocus>
                                <span class="input-group-text rounded-end">&nbsp<i
                                        class="fa fa-user"></i>&nbsp</span>
                               <span class="text-danger"><?php echo $nameError; ?></span>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="mb-2 text-muted" for="email">E-Mail Address</label>
                            <div class="input-group input-group-join mb-3">
                                <input id="email" type="email" placeholder="Enter Email" class="form-control"
                                    name="email" value="" required autofocus>
                                <span class="input-group-text rounded-end">&nbsp<i
                                        class="fa fa-envelope"></i>&nbsp</span>
                               <span class="text-danger"><?php echo $emailError; ?></span>
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="mb-2 w-100">
                                <label class="text-muted" for="password">Password</label>
                                <a href="forgot.html" class="float-end">
                                    Forgot Password?
                                </a>
                            </div>
                            <div class="input-group input-group-join mb-3">
                                <input type="password" class="form-control" placeholder="Your password" required name="password">
                                <span class="input-group-text rounded-end password cursor-pointer">&nbsp<i
                                        class="fa fa-eye"></i>&nbsp</span>
                                <div class="invalid-feedback">
                                    Password is required
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="mb-2 w-100">
                                <label class="text-muted" for="password">Confirm Password</label>
                            </div>
                            <div class="input-group input-group-join mb-3">
                                <input type="password" class="form-control" placeholder="Confirm Your Password"
                                    required>
                                <span class="input-group-text rounded-end password cursor-pointer">&nbsp<i
                                        class="fa fa-eye"></i>&nbsp</span>
                                <div class="invalid-feedback">
                                    Confirm Password is required
                                </div>
                            </div>
                        </div>

                        <div class="d-flex align-items-center">
                            <div class="form-check">
                                <input type="checkbox" name="remember" id="remember" class="form-check-input">
                                <label for="remember" class="form-check-label">I agree to <a
                                        href="#">terms</a></label>
                            </div>
                            <button type="submit" class="btn btn-primary ms-auto" name="submit" id="sendMessageButton" onClick="hello()">
                                Register
                            </button>
                        </div>
                    </form>
                </div>
                <div class="card-footer py-3 border-0">
                    <div class="text-center">
                        Already have an account? <a href="login.php" class="text-dark">Login instead</a>
                    </div>
                </div>
            </div>
             <div class="text-center mt-5 text-muted">
                Copyright &copy; 2023 &mdash; e11even enterprise
            </div>
        </div>
    </div>
</section>
<script src="../assets/js/login.js"></script>
<script>
        function hello (){
            var c = document.getElementById("cpassword").value
            var p = document.getElementById("password").value
            if(p.length < 8 || c.length < 8){
                alert("password or confirm password must not be less than 8")
            }else{
                
                    if(c !== p){
                alert("Password does not match")
                
               
            }
            }
         }
    </script>
</body>

</html>
<?php ob_end_flush(); ?>