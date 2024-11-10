<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="Ad-home-pnnel.css">
    <link rel="icon" href="../../assets/logo.jpg">
    <script>
        // Function to open the sidebar
        function openNav() {
            document.getElementById("mySidebar").style.width = "30%";
            document.getElementById("main").style.marginLeft = "0px";
            document.getElementById("main").style.display = "none";
        }
        
        // Function to close the sidebar
        function closeNav() {
            document.getElementById("mySidebar").style.width = "0";
            document.getElementById("main").style.marginLeft = "0";
            document.getElementById("main").style.display = "block";
        }
    </script>
</head>
<body>
<?php 
include_once("../../db/conection.php"); // Include database connection
session_start(); // Start the session
?>
<div class="container">
    <div id="mySidebar" class="sidebar">
        <div class="sidebar-nav">
            <div style="width: 100%; height: 100%; text-align: center; position: relative; top: 30%;">
                <p><?php echo htmlspecialchars($_SESSION['company'] ?? 'Company'); ?></p>
            </div>
            <a href="javascript:void(0)" class="closebtn" id="closebtn" onclick="closeNav()">×</a>
        </div>
        <div class="side-container">
            <?php
            // Logout functionality
            if (isset($_POST["logout"])) {
                unset($_SESSION['adminid']); // Unset admin session
                header("Location: ../../Login/login.php"); // Redirect to login page
                exit(); // Stop execution after redirect
            }
            ?>
            <a href="./home.php"><img src="./../../assets/Home.png">HOME</a>
            <a href="./all-emp.php"><img src="../../assets/employe.png"> Employees</a>
            <a href="#"><img src="../../assets/live employe.png"> Live Employees</a>
            <a href="./../Admin-home-pannel/attendance.php"><img src="../../assets/attends.png"> Attendance</a>
            <a href="#"><img src="../../assets/notification.png"> Notification</a>
            <a href="../Admin-home-pannel/salary/salary.php"><img src="../../assets/salaerie.png"> Salaries</a> 
            <form method="post">
                <button class="btn-logout" type="submit" name="logout">Logout</button>
            </form>
        </div>
    </div>

    <div class="nav">
        <div id="main">
            <button class="openbtn" onclick="openNav()">☰</button> 
        </div>
        <div class="pro-icon"></div>
        <div class="profile-img">
            <a href="#"><img src="../../assets/profile.png"> Profile</a>
            <?php echo htmlspecialchars($_SESSION['adminid'] ?? 'Admin'); ?>
        </div>
    </div>

    <div class="emp-total">
        <!-- Total Employees Query -->
        <?php
        $empquery = "SELECT COUNT(ename) AS etotal FROM employees";
        $result = mysqli_query($conn, $empquery); 
        $etotal = $result ? mysqli_fetch_assoc($result)['etotal'] : 0; // Check query success
        ?>
        <div class="emp-box">
            <?php echo $etotal; ?>
            <p>Total Employees</p>
        </div>

        <!-- Live Employees Query -->
        <?php
        $liveempquery = "SELECT COUNT(ename) AS livetotal FROM employees WHERE estatus='Live'";
        $liveresult = mysqli_query($conn, $liveempquery); 
        $livetotal = $liveresult ? mysqli_fetch_assoc($liveresult)['livetotal'] : 0; // Check query success
        ?>
        <div class="emp-box">
            <?php echo $livetotal; ?>
            <p>Employees on Work</p>
        </div>

        <!-- Employees on Gone Query -->
        <?php
        $Goneempquery = "SELECT COUNT(ename) AS Gonetotal FROM employees WHERE estatus='Gone'";
        $Goneresult = mysqli_query($conn, $Goneempquery); 
        $Gonetotal = $Goneresult ? mysqli_fetch_assoc($Goneresult)['Gonetotal'] : 0; // Check query success
        ?>
        <div class="emp-box">
            <?php echo $Gonetotal; ?>
            <p>Employees on Gone</p>
        </div>
    </div>
</div>
</body>
</html>
