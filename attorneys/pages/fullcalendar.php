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
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>calendar</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"
        integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w=="
        crossorigin="anonymous" />

    <link rel="stylesheet" href="../vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../vendor/themify-icons/themify-icons.css">
    <link rel="stylesheet" href="../vendor/perfect-scrollbar/css/perfect-scrollbar.css">

    <!-- CSS for this page only -->
<link href='https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css' rel='stylesheet'>
<style>
    .fc-event {
        cursor: move;
    }
</style>
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
                    <div class="dropdown dropdown-menu-end">
                        <a href="#" class="user-dropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            <div class="label">
                                <span><?php
							$servername = "localhost";
							$username = "root";
							$password = "mysql";
							$dbname = "legal_scheduling";
							
							$conn = mysqli_connect($servername, $username, $password, $dbname);
							
							if ($conn->connect_error) {
								echo "Connection failed: " . $conn->connect_error;
								header("refresh:1;url=login.php");
								exit;
							}
							
							if (!isset($_SESSION['user'])) {
								echo "User not logged in";
								header("refresh:1;url=login.php");
								exit;
							}
							
							$user = mysqli_real_escape_string($conn, $_SESSION['user']);
							$sql = mysqli_query($conn, "SELECT * FROM admin WHERE name='$user'");
							$row = mysqli_fetch_array($sql);
							
							if ($row) {
								echo $row['name'];
							} else {
								echo "User not logged in";
							}
							
							mysqli_close($conn);
							?></span>
                                <div></div>
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
                                <a href="#">
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
                        <a href="index.php" class="link">
                            <i class="ti-home"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li class="menu-category">
                        <span class="text-uppercase">User Interface</span>
                    </li>
                    
                    <li>
                        <a href="#" class="main-menu has-dropdown">
                            <i class="ti-write"></i>
                            <span>Tables</span>
                        </a>
                        <ul class="sub-menu ">
                           <li><a href="table-basic.php" class="link"><span>Appointments</span></a></li>
                            <li class="active"><a href="fullcalendar.php" class="link"><span>Calendar</span></a></li>
                        </ul>
                    </li>
                   
                </ul>
            </div>
        </nav>        
        <div class="main-content">
            <div class="title">
                Full Calendar
            </div>
            <div class="content-wrapper">
                <div class="row">
                    <div class="col-md-10">
                        <div id="calendar"></div>
                    </div>
                    <div class="col-md-2">
                        <div id='external-events'>
                            <p>
                              <strong>Draggable Events</strong>
                            </p>
                            <div class='fc-event py-1 mb-1 fc-h-event fc-daygrid-event fc-daygrid-block-event'>
                              <div class='fc-event-main'>My Event 1</div>
                            </div>
                            <div class='fc-event py-1 mb-1 fc-h-event fc-daygrid-event fc-daygrid-block-event'>
                              <div class='fc-event-main'>My Event 2</div>
                            </div>
                            <div class='fc-event py-1 mb-1 fc-h-event fc-daygrid-event fc-daygrid-block-event'>
                              <div class='fc-event-main'>My Event 3</div>
                            </div>
                            <div class='fc-event py-1 mb-1 fc-h-event fc-daygrid-event fc-daygrid-block-event'>
                              <div class='fc-event-main'>My Event 4</div>
                            </div>
                            <div class='fc-event py-1 mb-1 fc-h-event fc-daygrid-event fc-daygrid-block-event'>
                              <div class='fc-event-main'>My Event 5</div>
                            </div>
                          
                            <p>
                              <input type='checkbox' class="form-check-input" id='drop-remove' />
                              <label for='drop-remove'>remove after drop</label>
                            </p>
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
            Copyright © 2023 &nbsp <a href="https://www.youtube.com/c/mulaidarinull" target="_blank" class="ml-1">e11even eneterprise </a> <span> . All rights Reserved</span>
        </footer>
        <div class="overlay action-toggle">
        </div>
    </div>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.js"></script>
    <script src="../vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>

    <!-- js for this page only -->
<script src="../vendor/fullcalendar/index.global.min.js"></script>
<script src='../vendor/@fullcalendar/bootstrap5/index.global.min.js'></script>
    <!-- ======= -->
    <script src="../assets/js/main.min.js"></script>
    <script>
        Main.init()
    </script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        const today = new Date()

        var containerEl = document.getElementById('external-events');

        var checkbox = document.getElementById('drop-remove');

        new FullCalendar.Draggable(containerEl, {
            itemSelector: '.fc-event',
            eventData: function(eventEl) {
                return {
                    title: eventEl.innerText
                };
            }
        });

        var calendar = new FullCalendar.Calendar(calendarEl, {
            themeSystem: 'bootstrap5',
            initialView: 'dayGridMonth',
            editable: true,
            droppable: true,
            drop: function(info) {
                if (checkbox.checked) {
                    info.draggedEl.parentNode.removeChild(info.draggedEl);
                }
            },
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            events: [
                {
                    id: '1',
                    title: 'Meeting with Client',
                    start: today.getFullYear() + '-' + ('0' + (today.getMonth() + 1)).slice(-2) + '-' + ('0' + (today.getDate() + 1)).slice(-2),
                    end: today.getFullYear() + '-' + ('0' + (today.getMonth() + 1)).slice(-2) + '-' + ('0' + (today.getDate() + 6)).slice(-2),
                    textColor: '#084298',
                    backgroundColor: '#cfe2ff',
                    borderColor: '#b6d4fe'
                },
                {
                    id: '1',
                    title: 'Start new Project',
                    start: today.getFullYear() + '-' + ('0' + (today.getMonth() + 1)).slice(-2) + '-' + ('0' + (today.getDate() + 2)).slice(-2),
                    end: today.getFullYear() + '-' + ('0' + (today.getMonth() + 1)).slice(-2) + '-' + ('0' + (today.getDate() + 4)).slice(-2),
                    textColor: '#084298',
                    backgroundColor: '#cfe2ff',
                    borderColor: '#b6d4fe'
                },
                {
                    id: '2',
                    title: 'Travel Time!!',
                    start: today.getFullYear() + '-' + ('0' + (today.getMonth() + 1)).slice(-2) + '-' + ('0' + (today.getDate() + 10)).slice(-2),
                    end: today.getFullYear() + '-' + ('0' + (today.getMonth() + 1)).slice(-2) + '-' + ('0' + (today.getDate() + 13)).slice(-2),
                    textColor: '#842029',
                    backgroundColor: '#f8d7da',
                    borderColor: '#f5c2c7'
                }
            ],
            weekNumbers: true,
            selectable:true,
            dayMaxEvents: true,
        });
        calendar.render();
        calendar.setOption( 'id');


      });
</script>
</body>

</html>