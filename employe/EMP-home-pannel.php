<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="EMP-home-pannel.css"> 
    <link rel="icon"  href="../assets/logo.jpg">
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
</head>
<body>
    <div class="container">
      <div id="mySidebar" class="sidebar">
        <div class="sidebar-nav">
          <div class="sidebar-nav-img">
          </div>
          <a href="javascript:void(0)" class="closebtn" id="closebtn" onclick="closeNav()">×</a>
        </div>
        <div class="sidebar-container">
           <a href=""><img src="../assets/Home.png" alt="">Home</a>
           <a href=""><img src="../assets/live employe.png" alt="">My Records</a>
           <a href=""><img src="../assets/attends.png" alt="">My Attends</a>
           <a href=""><img src="../assets/notification.png" alt="">Notification</a>
           <a href=""><img src="../assets/profile.png" alt="">profile</a>
           <a class="btn-logout" href="../index.php">logout</a>
        </div>
        </div>
        <div class="Nav-bar">
          <div id="main">
            <button class="openbtn" onclick="openNav()">☰</button> 
          </div>
          <div class="pro-icon"></div>
        </div>
    </div>
</body>
</html>