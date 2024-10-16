<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile-Scereen</title>
    <link rel="stylesheet" href="profile-screen.css">
    <link rel="stylesheet" href="./EMP-home-pannel.css"> 
    <link rel="icon"  href="../../assets/logo.jpg">
    <link rel="stylesheet" href="./../../assets/css/all.min.css">
</head>
<script>
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
</script>
<body>
  <?php
   session_start(); // Start the session
  ?>
    <div class="container">
    <div id="mySidebar" class="sidebar">
        <div class="sidebar-nav">
          <div class="sidebar-nav-img">
          </div>
          <a href="javascript:void(0)" class="closebtn" id="closebtn" onclick="closeNav()">×</a>
        </div>
        <div class="sidebar-container">
           <a href="./EMP-home-pannel.php"><img src="./../../assets/Home.png" alt="">Home</a>
           <a href="./My-Records"><img src="./../../assets/live employe.png" alt="">My Records</a>
           <a href="./My-attendance"><img src="./../../assets/attends.png" alt="">My Attends</a>
           <a href="./Notification.php"><img src="./../../assets/notification.png" alt="">Notification</a>
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
        <div class="container-2">
            <?php
             include_once("./../../db/conection.php");
             $adminid = $_SESSION['adminid'];
             $empquery = "SELECT * FROM employees WHERE adminid = $adminid";
             $result = mysqli_query($conn, $empquery);  
            ?>
            <div class="box-1">
                <div class="emp-Name">
                    <p><?php echo htmlspecialchars($row["ename"]); ?></p>
                    <div class="edit-btn">
                        <i class="fa fa-pen"></i>
                        <i class="fa fa-trash"></i>
                    </div>
                </div>
                <div class="emp-content">
                    <p>info</p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>