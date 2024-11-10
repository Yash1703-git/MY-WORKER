<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>live-employee Employee</title>
    <link rel="stylesheet" href="./home.css">
    <link rel="stylesheet" href="live-employee.css">
    <link rel="icon" href="../../assets/logo.jpg">
    <link rel="stylesheet" href="./../../assets/css/all.min.css">
</head>
<script>
    // Function to open the sidebar
    function openNav() {
        document.getElementById("mySidebar").style.width = "30%";
        document.getElementById("main").style.marginLeft = "30%"; // Adjust main margin
        document.getElementById("main").style.display = "none";
    }

    // Function to close the sidebar
    function closeNav() {
        document.getElementById("mySidebar").style.width = "0";
        document.getElementById("main").style.marginLeft = "0";
        document.getElementById("main").style.display = "block";
    }
</script>
<body>
    <div class="container">
    <?php 
include_once("../../db/conection.php"); // Include database connection
session_start(); // Start the session
?>
        <div id="mySidebar" class="sidebar">
            <div class="sidebar-nav">
                <div style="width: 100%; height:100%; text-align:center; position:relative;top:30%;">
                    <p><?php echo $_SESSION['company']; ?></p>
                </div>
                <a href="javascript:void(0)" class="closebtn" id="closebtn" onclick="closeNav()">×</a>
            </div>
            <div class="side-container">
                <?php
                // Logout functionality
                if (isset($_POST["logout"])) { 
                    unset($_SESSION['adminid']);
                    header("Location: ../../Login/login.php");
                }
                ?>
               <a href="./home.php"><img src="./../../assets/Home.png">HOME</a>
               <a href="./all-emp.php"><img src="../../assets/employe.png"> Employees</a>
               <a href="./live-employee.php"><img src="../../assets/live employe.png"> Live Employees</a>
               <a href="./../Admin-home-pannel/attendance.php"><img src="../../assets/attends.png"> Attendance</a>
               <a href="./salary/salary.php"><img src="../../assets/salaerie.png"> Salaries</a> 
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
    <div class="container-2">
        <div class="live-emp">
            <h1>Live Emplyee</h1>
            <table>
                <tr>
                    <th>Employee Name</th>
                </tr>
                
                <?php
                    $adminid = $_SESSION['adminid'];
                    $empquery = "SELECT * FROM employees WHERE estatus='Live' AND adminid = $adminid";
                    $result = mysqli_query($conn, $empquery);  
                    
                    while ($row = mysqli_fetch_array($result)) {  
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row["ename"]) . "</td>";
                        echo "</tr>";
                    }
                    ?>
             
            </table>
        </div>
    </div>
    </div>
</body>
</html>