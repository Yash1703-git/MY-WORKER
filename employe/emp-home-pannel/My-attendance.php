<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="My-attendance.css">
    <link rel="stylesheet" href="./EMP-home-pannel.css"> 
    <link rel="icon"  href="../../assets/logo.jpg">
    <link rel="stylesheet" href="./../../assets/css/all.min.css">
<script type="text/javascript">
        function openNav() {
          document.getElementById("mySidebar").style.width = "30%";
          document.getElementById("main").style.marginLeft = "0px";
          document.getElementById("main").style.display="none"
        }
       //  kjhgf
        function closeNav() {
          document.getElementById("mySidebar").style.width = "0";
          document.getElementById("main").style.marginLeft= "0";
          document.getElementById("main").style.display="block"
        }

        // script for modal
        function openmodal(){
            document.getElementById("myModal").style.display = "block";
        }
        function closemodal(){
            document.getElementById("myModal").style.display = "none";
        }
      </script>
</head>
<body>
<?php
include_once("../../db/conection.php");
session_start();

$serror = "";
if (isset($_POST["submit"])) {
    $currentDate = date("d/m/Y");
    $currentTime = date("h:i:s A"); // Corrected time format
    $markstatus = $_POST["markstatus"]; // Removed space
    $empsms = $_POST["empsms"]; // Fixed variable name

    // Ensure that markstatus and empsms are set
    if (!empty($markstatus) && !empty($empsms)) {
        $sql = "INSERT INTO attendance (markstatus, empsms, markdate, marktime, empid, adminid) 
                VALUES ('$markstatus', '$empsms', '$currentDate', '$currentTime', '".$_SESSION['eid']."', '".$_SESSION['myadminid']."')";

        if ($conn->query($sql) === TRUE) {
            echo "<script type='text/javascript'>alert('Attendance marked successfully');</script>";
        } else {
            echo "<script type='text/javascript'>alert('Error: " . $sql . "<br>" . $conn->error . "');</script>";
        }
    } else {
        echo "<script type='text/javascript'>alert('Please fill all fields');</script>";
    }
}
?>
    <div class="container">
      <div id="mySidebar" class="sidebar">
        <div class="sidebar-nav">
        <div style="width: 100%; height: 100%; text-align: center; position: relative; top: 30%;">
                <p><?php echo htmlspecialchars($_SESSION['company'] ?? 'Company'); ?></p>
            </div>
          <div class="sidebar-nav-img">
          </div>
          <a href="javascript:void(0)" class="closebtn" id="closebtn" onclick="closeNav()">×</a>
        </div>
        <div class="sidebar-container">
        <?php
            // Logout functionality
            if (isset($_POST["logout"])) {
              unset($_SESSION['myadminid']); // Unset admin session
                header("Location: ./../../Login/login.php"); // Redirect to login page
                exit(); // Stop execution after redirect
            }
            ?>
           <a href="./EMP-home-pannel.php"><img src="./../../assets/Home.png" alt="">Home</a>
           <a href="./My-Records"><img src="./../../assets/live employe.png" alt="">My Records</a>
           <a href="./My-attendance.php"><img src="./../../assets/attends.png" alt="">My Attends</a>
           <a href="./profile-screen.php"><img src="./../../assets/profile.png" alt="">profile</a>
           <form method="post">  
             <button class="btn-logout" type="submit" name="logout">logout</button> 
           </form>
        </div>
        </div>
        <div class="Nav-bar">
          <div id="main">
            <button class="openbtn" onclick="openNav()">☰</button> 
          </div>
          <div class="pro-icon"></div>
        </div>
    </div>
    <div class="container-2">
    <table style="border-collapse: collapse;">
        <tr style="background-color:steelblue;">
            <th>Attendance</th>  
            <th>Name</th>  
            <th>Mobile</th>  
            <th>Mark-Date</th>  
            <th>Time</th>  
            <th>Message</th>
        </tr>
       
          <?php

        include_once("../../db/conection.php");
    $empid = $_SESSION['eid'];
    $query = "SELECT * FROM attendance WHERE empid = $empid ";
    $result = mysqli_query($conn, $query);
    ?>
        

        <?php  
        while ($row = mysqli_fetch_array($result)) {  
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
</body>
</html>