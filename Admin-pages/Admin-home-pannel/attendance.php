<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance</title> 
    <link rel="stylesheet" href="./Ad-home-pnnel.css">
    <link rel="stylesheet" href="attendance.css">
    <link rel="icon" href="../../assets/logo.jpg">
    <link rel="stylesheet" href="./../../assets/css/all.min.css">
</head>
<body>
    <div class="contianer">
        <?php session_start(); ?>
        <div class="container">
            <div id="mySidebar" class="sidebar">
                <div class="sidebar-nav">
                <div style="width: 100%; height:100%; text-align:center; position:relative;top:30%;">
                        <p><?php echo $_SESSION['company']; ?></p>
                    
                    </div>
                    <a href="javascript:void(0)" class="closebtn" id="closebtn" onclick="closeNav()">×</a>
                </div>
                <div class="side-container">
                    <?php
                    if (isset($_POST["logout"])) {
                        unset($_SESSION['adminid']);
                        header("Location: ../../Login/login.php");
                    }
                    ?>
                    <a href="./all-emp.php"><img src="../../assets/employe.png"> Employees </a>
                    <a href=""><img src="../../assets/live employe.png"> Live Employees</a>
                    <a href="./attendance.php"><img src="../../assets/attends.png"> Attendance</a>
                    <a href=""><img src="../../assets/notification.png"> Notification</a>
                    <a href="./salary.php/salary.php"><img src="../../assets/salaerie.png"> Salaries</a> 
                    <form method="post">
                        <button class="btn-logout" type="submit" name="logout">Logout</button>
                    </form>
                </div>
            </div>
            <div class="nav">
                <div id="main">
                    <button class="openbtn" onclick="openNav()">☰</button> 
                </div>
                <div class="page-name" style="font-size: 30px; font-weight: bolder;">ATTENDANCE</div>
                <button id="openModalBtn"> <i class="fa fa-clock"></i></button>  
                <!-- The Modal -->
                <div id="myModal" class="modal">
                    <div class="modal-content">
                        <span class="close">&times;</span>
                        <h2>Time Selection</h2>
                        <!-- In section -->
                        <h2 style="text-align: left;">In section</h2>
                        <form id="timeForm">
                            <label for="fromTime">From:</label>
                            <input type="time" id="fromTime" name="fromTime" required>
                            <br>
                            <label for="toTime">To-:</label>
                            <input type="time" id="toTime" name="toTime" required>
                            <br>
                            <button type="submit">Save</button>
                        </form>
                        <!-- out section -->
                         <hr style="margin: 10px 0px 10px;">
                         <h2 style="text-align: left;">Out section</h2>
                        <form id="timeForm">
                            <label for="fromTime">From:</label>
                            <input type="time" id="fromTime" name="fromTime" required>
                            <br>
                            <label for="toTime">To-:</label>
                            <input type="time" id="toTime" name="toTime" required>
                            <br>
                            <button type="submit">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-2">
            <div class="total-emp">
                <p>Today</p>
                <p>25/30</p>
            </div>
            <div class="section-button">
                <button id="In-section" name="In section"><a href="">IN SECTION</a></button>
                <button id="Out-section" name="Out section"><a href="">OUT SECTION</a></button>
                <button id="All-records" name="All records"><a href="">ALL RECORDS</a></button>
            </div>
        </div>
    </div>
    <!-- JavaScript at the end of the body -->
    <script type="text/javascript">
        // Modal functionality
        var modal = document.getElementById("myModal");
        var btn = document.getElementById("openModalBtn");
        var span = document.getElementsByClassName("close")[0];

        btn.onclick = function() {
            modal.style.display = "block";
        }

        span.onclick = function() {
            modal.style.display = "none";
        }

        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
        document.getElementById("mySidebar").style.width = "0";
            document.getElementById("main").style.marginLeft = "0";
            document.getElementById("main").style.display = "block";
        // Sidebar functionality
        function openNav() {
            document.getElementById("mySidebar").style.width = "30%";
            document.getElementById("main").style.marginLeft = "30%";
            document.getElementById("main").style.display = "none";
        }

        function closeNav() {
            document.getElementById("mySidebar").style.width = "0";
            document.getElementById("main").style.marginLeft = "0";
            document.getElementById("main").style.display = "block";
        }
    </script>
</body>
</html>
