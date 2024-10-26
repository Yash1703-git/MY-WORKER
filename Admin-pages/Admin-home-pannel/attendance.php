<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance</title> 
    <link rel="stylesheet" href="./home.css">
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
                <div class="page-name" style="font-size: 30px; font-weight: bolder; padding-top:20px">ATTENDANCE</div>
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
            <div class="emp" style="display: flex;">
                <?php
                include_once("../../db/conection.php");
                ?>
                <p style="font-size: 36px;padding-right:16px">Today</p>
                <div class="live-emp" style="font-size:36px;">
                <?php
        $liveempquery = "SELECT COUNT(markstatus) AS livetotal FROM attendance WHERE markstatus='IN' AND adminid=".$_SESSION['adminid'];;
        $liveresult = mysqli_query($conn, $liveempquery); 
        $livetotal = $liveresult ? mysqli_fetch_assoc($liveresult)['livetotal'] : 0; // Check query success
        ?>
        <?php echo "$livetotal"; ?>
                </div>
                <p style="font-size:36px;">/</p>
                <div class="totalemp" style="font-size:36px;">
                <?php
        $empquery = "SELECT COUNT(markstatus) AS etotal FROM attendance WHERE adminid=".$_SESSION['adminid'];
        $result = mysqli_query($conn, $empquery); 
        $etotal = $result ? mysqli_fetch_assoc($result)['etotal'] : 0; // Check query success
        ?>
         <?php echo $etotal; ?>
                </div>
            </div> 
            <div class="section-button">
             <button id="In-section" onclick="showSection('in')">IN</button>
             <button id="Out-section" onclick="showSection('out')">OUT</button>
             <button id="Leave-section" onclick="showSection('leave')">Leave</button>
             <button id="All-records" onclick="showSection('all')">ALL RECORDS</button>
            </div>
            
        <!-- // Connection for displaying all employees -->
        <div id="in-section" class="attendance-section" style="display: none;">
    <?php
    $currentDate = date("d/m/Y");

    include_once("../../db/conection.php");
    $adminid = $_SESSION['adminid'];
    $inquery = "SELECT * FROM attendance WHERE adminid = $adminid AND markstatus = 'IN' AND markdate='$currentDate'";
    $inresult = mysqli_query($conn, $inquery);
    ?>
    
    <table style="border-collapse: collapse;">
        <tr style="background-color: #80B17B;">
            <th>Attendance</th>  
            <th>Name</th>  
            <th>Mobile</th>  
            <th>Mark-Date</th>  
            <th>Time</th>  
            <th>Message</th>
        </tr>
        <?php  
        while ($row = mysqli_fetch_array($inresult)) {  
            $empid = $row['empid'];
            $infoquery = "SELECT * FROM employees WHERE eid = $empid";
            $inforesult = mysqli_query($conn, $infoquery);  
            $inforow = mysqli_fetch_array($inforesult, MYSQLI_ASSOC);
        ?>  
        <tr>  
            <td><?php echo htmlspecialchars($row["markstatus"]); ?></td>  
            <td><?php echo htmlspecialchars($inforow["ename"]); ?></td>
            <td><?php echo htmlspecialchars($inforow["emobile"]); ?></td>
            <td><?php echo htmlspecialchars($row["markdate"]); ?></td>
            <td><?php echo htmlspecialchars($row["marktime"]); ?></td>
            <td><?php echo htmlspecialchars($row["empsms"]); ?></td>
        </tr>
        <?php } ?>
    </table>
</div>

<div id="out-section" class="attendance-section" style="display: none;">
    <?php
    $outquery = "SELECT * FROM attendance WHERE adminid = $adminid AND markstatus = 'OUT' AND markdate='$currentDate'";
    $outresult = mysqli_query($conn, $outquery);
    ?>
    
    <table style="border-collapse: collapse;">
        <tr style="background-color: #F07969;">
            <th>Attendance</th>  
            <th>Name</th>  
            <th>Mobile</th>  
            <th>Mark-Date</th>  
            <th>Time</th>  
            <th>Message</th>
        </tr>
        <?php  
        while ($row = mysqli_fetch_array($outresult)) {  
            $empid = $row['empid'];
            $infoquery = "SELECT * FROM employees WHERE eid = $empid";
            $inforesult = mysqli_query($conn, $infoquery);  
            $inforow = mysqli_fetch_array($inforesult, MYSQLI_ASSOC);
        ?>  
        <tr>  
            <td><?php echo htmlspecialchars($row["markstatus"]); ?></td>  
            <td><?php echo htmlspecialchars($inforow["ename"]); ?></td>
            <td><?php echo htmlspecialchars($inforow["emobile"]); ?></td>
            <td><?php echo htmlspecialchars($row["markdate"]); ?></td>
            <td><?php echo htmlspecialchars($row["marktime"]); ?></td>
            <td><?php echo htmlspecialchars($row["empsms"]); ?></td>
        </tr>
        <?php } ?>

    </table>
</div>
<div id="leave-section" class="attendance-section" style="display: none;">
    <?php
    $leavequery = "SELECT * FROM attendance WHERE adminid = $adminid AND markstatus = 'LEAVE' AND markdate='$currentDate'";
    $leaveresult = mysqli_query($conn, $leavequery);
    ?>
    
    <table style="border-collapse: collapse;">
        <tr style="background-color:  lightblue;">
            <th>Attendance</th>  
            <th>Name</th>  
            <th>Mobile</th>  
            <th>Mark-Date</th>  
            <th>Time</th>  
            <th>Message</th>
        </tr>
        <?php  
        while ($row = mysqli_fetch_array($leaveresult)) {  
            $empid = $row['empid'];
            $infoquery = "SELECT * FROM employees WHERE eid = $empid";
            $inforesult = mysqli_query($conn, $infoquery);  
            $inforow = mysqli_fetch_array($inforesult, MYSQLI_ASSOC);
        ?>  
        <tr>  
            <td><?php echo htmlspecialchars($row["markstatus"]); ?></td>  
            <td><?php echo htmlspecialchars($inforow["ename"]); ?></td>
            <td><?php echo htmlspecialchars($inforow["emobile"]); ?></td>
            <td><?php echo htmlspecialchars($row["markdate"]); ?></td>
            <td><?php echo htmlspecialchars($row["marktime"]); ?></td>
            <td><?php echo htmlspecialchars($row["empsms"]); ?></td>
        </tr>
        <?php } ?>
    </table>
</div>
<div id="all-section" class="attendance-section" style="display: none;">
    <?php
    $leavequery = "SELECT * FROM attendance WHERE adminid = $adminid ";
    $leaveresult = mysqli_query($conn, $leavequery);
    ?>
    
    <table style="border-collapse: collapse;">
        <tr style="background-color: #2870B9;">
            <th>Attendance</th>  
            <th>Name</th>  
            <th>Mobile</th>  
            <th>Mark-Date</th>  
            <th>Time</th>  
            <th>Message</th>
        </tr>
        <?php  
        while ($row = mysqli_fetch_array($leaveresult)) {  
            $empid = $row['empid'];
            $infoquery = "SELECT * FROM employees WHERE eid = $empid";
            $inforesult = mysqli_query($conn, $infoquery);  
            $inforow = mysqli_fetch_array($inforesult, MYSQLI_ASSOC);
        ?>  
        <tr>  
            <td><?php echo htmlspecialchars($row["markstatus"]); ?></td>  
            <td><?php echo htmlspecialchars($inforow["ename"]); ?></td>
            <td><?php echo htmlspecialchars($inforow["emobile"]); ?></td>
            <td><?php echo htmlspecialchars($row["markdate"]); ?></td>
            <td><?php echo htmlspecialchars($row["marktime"]); ?></td>
            <td><?php echo htmlspecialchars($row["empsms"]); ?></td>
        </tr>
        <?php } ?>
    </table>
</div>
        </div>
    </div>
    <!-- JavaScript at the end of the body -->
    <script type="text/javascript">
        showSection('in');
function showSection(section) {
    document.getElementById('in-section').style.display = (section === 'in') ? 'block' : 'none';
    document.getElementById('out-section').style.display = (section === 'out') ? 'block' : 'none';
    document.getElementById('leave-section').style.display = (section === 'leave') ? 'block' : 'none';
    document.getElementById('all-section').style.display = (section === 'all') ? 'block' : 'none';

}
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
