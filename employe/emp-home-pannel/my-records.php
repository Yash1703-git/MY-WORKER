<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Records</title>
    <link rel="stylesheet" href="My-Records.css">
    <link rel="stylesheet" href="./EMP-home-pannel.css">
  <link rel="icon" href="../../assets/logo.jpg">
  <link rel="stylesheet" href="./../../assets/css/all.min.css">
  <script type="text/javascript">
    function openNav() {
      document.getElementById("mySidebar").style.width = "30%";
      document.getElementById("main").style.marginLeft = "0px";
      document.getElementById("main").style.display = "none"
    }
    //  kjhgf
    function closeNav() {
      document.getElementById("mySidebar").style.width = "0";
      document.getElementById("main").style.marginLeft = "0";
      document.getElementById("main").style.display = "block"
    }
  </script>
</head>
<body>
    <?php
    session_start();
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
        <a href="./My-attendance.php"><img src="./../../assets/attends.png" alt="">My  Attendance</a>
        <a href="./my-records.php"><img src="./../../assets/salaerie.png" alt="">My Records</a>
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
    <table  style="border-collapse: collapse;">
        <tr style="background-color:steelblue;">
        <th>Date</th>   
            <th>Acc No</th>
            <th>No of Leaves</th>
            <th>Salary</th>
           
        </tr>     
           <?php
             include_once("../../db/conection.php");
             $empid = $_SESSION['euniqueid'];
             $query = "SELECT * FROM salaries WHERE sempid = '$empid' ORDER BY sdate DESC";
             $result = mysqli_query($conn, $query);
              
           ?>

           <?php
             while ($row = mysqli_fetch_array($result)) {
                       
          ?>
          <tr>
          <td><?php echo htmlspecialchars($row["sdate"]); ?></td>
          <td><?php echo htmlspecialchars($row["saccno"]); ?></td>
          <td><?php echo htmlspecialchars($row["snoleaves"]); ?></td>
          <td><?php echo htmlspecialchars($row["samountpaid"]); ?></td>
          
          </tr>
          <?php }?>
    </table>
  </div>
</body>
</html>