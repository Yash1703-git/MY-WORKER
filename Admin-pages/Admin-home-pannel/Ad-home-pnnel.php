<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin-pannel</title>
    <link rel="stylesheet" href="Ad-home-pnnel.css">
    <link rel="icon"  href="/assets/logo.jpg">
    <script>
        function openNav() {
          document.getElementById("mySidebar").style.width = "30%";
          document.getElementById("main").style.marginLeft = "0px";
          document.getElementById("main").style.display="none"
        }
      //  hahah
        function closeNav() {
          document.getElementById("mySidebar").style.width = "0";
          document.getElementById("main").style.marginLeft= "0";
          document.getElementById("main").style.display="block"
        }
        </script>
</head>
<body>
  <?php 
  include_once("../../db/conection.php");
  session_start();
   ?>
    <div class="container">
        <div id="mySidebar" class="sidebar">
          <div class="sidebar-nav">
            <div class="">
              
            
                <p ><?php  echo $_SESSION['company'] ?></p>
            
              </div>
      
            <a href="javascript:void(0)" class="closebtn" id="closebtn" onclick="closeNav()">×</a>
          </div>
          <div class="side-container">
            <?php
            
            

           
            if (isset($_POST["logout"])) {
              unset($_SESSION['adminid']);
             
               header("Location: ../../Login/login.php");
            //session_destroy();
            }
            ?>
            <a href="./all-emp.php"><img src="../../assets/employe.png"> Employess </a>
            <a href="#"><img src="../../assets/live employe.png">Live Employess</a>
            <a href="#"><img src="../../assets/attends.png">Attendance</a>
            <a href="#"><img src="../../assets/notification.png">Notification</a>
            <a href="#"><img src="../../assets/salaerie.png">Salaries</a> 
            <form method="post">  
             <button class="btn-logout" type="submit" name="logout">logout</button> 
      </form>
            
      </form>
          </div>
          </div>
          <div class="nav">
            <div id="main">
              <button class="openbtn" onclick="openNav()">☰</button> 
            </div>
            <div class="pro-icon"> </div>
            <div class="profile-img">
              <a href="#"><img src="../../assets/profile.png">profile<?php echo $_SESSION['adminid']?></a>
            </div>
          </div>
         <?php
         $empquery="SELECT COUNT(ename) AS etotal FROM employees";
           $result = mysqli_query($conn, $empquery); 
           $row = mysqli_fetch_array($result, MYSQLI_ASSOC); 
           $etotal = $row ["etotal"]
         ?>
         <h1>
          <?php
          echo $etotal;
          ?>
         </h1>
    </div>
</body>
</html>