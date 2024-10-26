<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Salaery</title>
    <link rel="stylesheet" href="./../home.css">
    <link rel="stylesheet" href="salary.css">
    <link rel="icon" href="./../../../assets/logo.jpg">
    <link rel="stylesheet" href="./../../assets/css/all.min.css">
    <script>
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
</head>
<body>
<div class="container"> <!-- Corrected class name -->
    <?php session_start(); ?>
    <div class="sidebar" id="mySidebar">
        <div class="sidebar-nav">
            <div style="width: 100%; height:100%; text-align:center; position:relative;top:30%;">
                <p><?php echo isset($_SESSION['company']) ? $_SESSION['company'] : 'Company'; ?></p>
            </div>
            <a href="javascript:void(0)" class="closebtn" id="closebtn" onclick="closeNav()">×</a>
        </div>
        <div class="side-container">
            <?php
            if (isset($_POST["logout"])) {
                unset($_SESSION['adminid']);
                header("Location: ../../../Login/login.php");
                exit(); // Ensure script stops after redirection
            }
            ?>
            <a href="../all-emp.php"><img src="./../../../assets/employe.png"> Employees</a>
            <a href="../live-emp.php"><img src="./../../../assets/live employe.png"> Live Employees</a>
            <a href="../attendance.php"><img src="./../../../assets/attends.png"> Attendance</a>
            <a href="#"><img src="./../../../assets/notification.png"> Notification</a>
            <a href="./"><img src="./../../../assets/salaerie.png"> Salaries</a> 
            <form method="post">
                <button class="btn-logout" type="submit" name="logout">Logout</button>
            </form>
        </div>
    </div>
    <div class="nav">
        <div id="main">
            <button class="openbtn" onclick="openNav()">☰</button> 
        </div>
        <div class="page-name" style="font-size: 30px; font-weight: bolder; position:relative; top:50%">Salary Section</div>
        <div></div>
    </div>
    <div class="container-2">
        <div class="current-date">
            <?php
            // Set the default timezone to India
            date_default_timezone_set('Asia/Kolkata');
            // Get the current date
            $currentDate = date('d/m/Y');
            // Display the current date
            echo "Current Date: " . $currentDate;
            ?>
        </div>
        <div class="section-button">
            <button id="Paid-salary" name="Paid salary"><a href="">Paid salary</a></button>
            <button id="Unpaid-salary" name="Unpaid salary"><a href="">Unpaid salary</a></button>
            <button id="All-salary" name="All salary"><a href="">All salary</a></button>
        </div>
    </div>
</div>
</body>
</html>
