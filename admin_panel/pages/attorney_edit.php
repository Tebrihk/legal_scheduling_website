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
		$sql=mysqli_query($conn,"SELECT * FROM admin WHERE name='$user'");
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
				$sql=mysqli_query($conn,"SELECT * FROM attorneys WHERE id='$id'");
				$result=mysqli_fetch_array($sql);
				
				?>     
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attorneys</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"
        integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w=="
        crossorigin="anonymous" />

    <link rel="stylesheet" href="../vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../vendor/themify-icons/themify-icons.css">
    <link rel="stylesheet" href="../vendor/perfect-scrollbar/css/perfect-scrollbar.css">

    <!-- CSS for this page only -->
<link href="../vendor/datatables.net-bs5/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
<link href="../vendor/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css" rel="stylesheet" />
    <!-- End CSS  -->

    <link rel="stylesheet" href="../assets/css/style.min.css">
    <link rel="stylesheet" href="../assets/css/bootstrap-override.min.css">
    <link rel="stylesheet" id="theme-color" href="../assets/css/dark.min.css">
</head>

<body>
    <div id="app">
        <div class="shadow-header"></div>
        <header class="header-navbar fixed">
            <div class="header-wrapper">
                <div class="header-left">
                    <div class="sidebar-toggle action-toggle"><i class="fas fa-bars"></i></div>
                    
                </div>
                <div class="header-content">
                    <div class="theme-switch-icon"></div>
                    
                    <div class="notification dropdown">
                        <a href="#" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="far fa-bell"></i>
                            <span class="badge">12</span>
                        </a>
                        <ul class="dropdown-menu medium">
                            <li class="menu-header">
                                <a class="dropdown-item" href="#">Notification</a>
                            </li>
                            <li class="menu-content ps-menu">
                                <a href="#">
                                    <div class="message-icon text-danger">
                                        <i class="fas fa-exclamation-triangle"></i>
                                    </div>
                                    <div class="message-content read">
                                        <div class="body">
                                            There's incoming event, don't miss it!!
                                        </div>
                                        <div class="time">Just now</div>
                                    </div>
                                </a>
                                <a href="#">
                                    <div class="message-icon text-info">
                                        <i class="fas fa-info"></i>
                                    </div>
                                    <div class="message-content read">
                                        <div class="body">
                                            Your licence will expired soon
                                        </div>
                                        <div class="time">3 hours ago</div>
                                    </div>
                                </a>
                                <a href="#">
                                    <div class="message-icon text-success">
                                        <i class="fas fa-check"></i>
                                    </div>
                                    <div class="message-content">
                                        <div class="body">
                                            Successfully register new user
                                        </div>
                                        <div class="time">8 hours ago</div>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="dropdown dropdown-menu-end">
                        <a href="#" class="user-dropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            <div class="label">
                                <span></span>
                                <div><?php echo $row['name']; ?></div>
                            </div>
                            <img class="img-user" src="../assets/images/avatar1.png" alt="user"srcset="">
                        </a>
                        <ul class="dropdown-menu small">
                            <!-- <li class="menu-header">
                                <a class="dropdown-item" href="#">Notifikasi</a>
                            </li> -->
                            <li class="menu-content ps-menu">
                                <a href="#">
                                    <div class="description">
                                        <i class="ti-user"></i> Profile
                                    </div>
                                </a>
                                <a href="#">
                                    <div class="description">
                                        <i class="ti-settings"></i> Setting
                                    </div>
                                </a>
                                <a href="logout.php">
                                    <div class="description">
                                        <i class="ti-power-off"></i> Logout
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div>

                </div>
            </div>
        </header>
        <nav class="main-sidebar ps-menu">
            <!-- <div class="sidebar-toggle action-toggle">
                <a href="#">
                    <i class="fas fa-bars"></i>
                </a>
            </div> -->
            <!-- <div class="sidebar-opener action-toggle">
                <a href="#">
                    <i class="ti-angle-right"></i>
                </a>
            </div> -->
            <div class="sidebar-header">
                <div class="text">MJ</div>
                <div class="close-sidebar action-toggle">
                    <i class="ti-close"></i>
                </div>
            </div>
            <div class="sidebar-content">
                <ul>
                    <li>
                        <a href="index.html" class="link">
                            <i class="ti-home"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li class="menu-category">
                        <span class="text-uppercase">User Interface</span>
                    </li>
                    <li class="active open">
                        <a href="#" class="main-menu has-dropdown">
                            <i class="ti-write"></i>
                            <span>Tables</span>
                        </a>
                        <ul class="sub-menu expand">
                            <li><a href="table-basic.php" class="link"><span>Notifacation</span></a></li>
                            <li><a href="table-datatables.php" class="link"><span>Client</span></a></li>
							<li class="active"><a href="attorney_table.php" class="link"><span>Attorneys</span></a></li>
							<li ><a href="attorney_table.php" class="link"><span>Assign</span></a></li>
                        </ul>
                    </li>
            </div>
        </nav>        
<div class="main-content">
    <div class="title">
        Dashboard
    </div>
    <div class="content-wrapper">
        <div class="row same-height">
            <div class="col-md-4">
                
            </div>
        </div>
    </div>
    <div class="content-wrapper">
        <div class="row same-height">
            <div class="col-md-8">
                <div class="card">
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                </div>
            </div>
        </div>
    </div>
    <div class="content-wrapper">
        <div class="row same-height">
            <div class="col-md-4">
               
           
                </div>
                    <div class="card-body">
                        <div id="apex-chart-bar"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-4"></div>
            <div class="col-md-12">
			 <div class="card">
                    <div class="card-header">
                        <h4>EDIT</h4>
                    </div>
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
                <div class="card-body">
								 <form method="post" action="edit.php">
								<br />  <input type="text" name="id" value="<?php echo $result['id']; ?>" style="width:300px; height:50px;" readonly="readonly" /><br />
								<br /> <input type="text" name="name" value="<?php echo $result['name']; ?>" style="width:300px; height:50px;" /><br />
								<br />  <input type="text" name="email" value="<?php echo $result['email']; ?>" style="width:300px; height:50px;"  /><br />
								   <br /><input type="text" name="address" value="<?php echo $result['address']; ?>" style="width:300px; height:50px;"  /><br />
								    <br /><input type="text" name="password" value="<?php echo $result['password']; ?>" style="width:300px; height:50px;"  /><br />
									  <br /><select name="practise" style="width:300px; height:50px;" >
								<br />	<option ><?php echo $result['practise']; ?></option>
                                        <option value="Civil law">Civil law</option>
                                        <option value="Family law">Family law</option>
                                        <option value="Corperate law">Corperate law</option>
										<option value="Crimal law">Crimal law</option>
										<option value="Business law">Business law</option>
                                    </select><br />
								<br /> <input type="submit" name="submit" value="EDIT"  style=" background-color:#33CCFF; color:#FFFFFF; width:90px; 95px; "/>
								</form>
              </div>
    </div>
      </div>
        </div>
    </div>

</div>
            <div class="col-md-4">
                <div class="card">
                   
                   
                       
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
        <div class="settings">
            <div class="settings-icon-wrapper">
                <div class="settings-icon">
                    <i class="ti ti-settings"></i>
                </div>
            </div>
            <div class="settings-content">
                <ul>
                    <li class="fix-header">
                        <div class="fix-header-wrapper">
                            <div class="form-check form-switch lg">
                                <label class="form-check-label" for="settingsFixHeader">Fixed Header</label>
                                <input class="form-check-input toggle-settings" name="Header" type="checkbox"
                                    id="settingsFixHeader">
                            </div>

                        </div>
                    </li>
                    <li class="fix-footer">
                        <div class="fix-footer-wrapper">
                            <div class="form-check form-switch lg">
                                <label class="form-check-label" for="settingsFixFooter">Fixed Footer</label>
                                <input class="form-check-input toggle-settings" name="Footer" type="checkbox"
                                    id="settingsFixFooter">
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="theme-switch">
                            <label for="">Theme Color</label>
                            <div>
                                <div class="form-check form-check-inline lg">
                                    <input class="form-check-input lg theme-color" type="radio" name="ThemeColor" id="light"
                                        value="light">
                                    <label class="form-check-label" for="light">Light</label>
                                </div>
                                <div class="form-check form-check-inline lg">
                                    <input class="form-check-input lg theme-color" type="radio" name="ThemeColor" id="dark"
                                        value="dark">
                                    <label class="form-check-label" for="dark">Dark</label>
                                </div>

                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="fix-footer-wrapper">
                            <div class="form-check form-switch lg">
                                <label class="form-check-label" for="settingsFixFooter">Collapse Sidebar</label>
                                <input class="form-check-input toggle-settings" name="Sidebar" type="checkbox"
                                    id="settingsFixFooter">
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div> 

        <footer>
            Copyright � 2023 &nbsp <a href="https://www.youtube.com/c/mulaidarinull" target="_blank" class="ml-1">e11even eneterprise </a> <span> . All rights Reserved</span>
        </footer>
        <div class="overlay action-toggle">
        </div>
    </div>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.js"></script>
    <script src="../vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>

    <!-- js for this page only -->
<script src="../vendor/jquery/jquery.min.js"></script>
<script src="../vendor/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="../vendor/datatables.net-bs5/js/dataTables.bootstrap5.min.js"></script>
<script src="../vendor/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="../vendor/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js"></script>
<script src="../assets/js/pages/datatables.min.js"></script>
    <!-- ======= -->
    <script src="../assets/js/main.min.js"></script>
    <script>
        Main.init()
    </script>
<script>
    DataTable.init()
</script>
</body>

</html>