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
  
  session_start();
   ?>
    <div class="container">
        <div id="mySidebar" class="sidebar">
          <div class="sidebar-nav">
            <div>
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
            <a href="./all-emp.php" style="color:#2870B9"><img src="../../assets/employe.png"> Employess </a>
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
          include_once("../../db/conection.php");
          $adminid=$_SESSION['adminid'];
          $empquery="SELECT * FROM employees WHERE adminid=$adminid ";
          $result = mysqli_query($conn, $empquery);  
          
          ?>
         
   <div class="container" style="width:500px;">  
                <h3 >How to Use Mysql View in PHP Code</h3><br />                 
                <div class="table-responsive">  
                     <table border="1" class="table table-striped">  
                          <tr>  
                               <th>Name</th>  
                               <th>Mobile Number</th>  
                               <th>Email</th>  
                               <th>Joining date</th>  
                               <th>Status</th>  
                               <th>Actions</th>  
                          </tr>  
                          <?php  
                          while($row = mysqli_fetch_array($result))  
                          {  
                          ?>  
                          <tr>  
                               <td><?php echo $row["ename"]; ?></td>  
                               <td><?php echo $row["emobile"];?></td>  
                               <td><?php echo $row["eemail"]; ?></td>  
                               <td><?php echo $row["ejoiningdate"]; ?></td>  
                               <td><?php 
                               if($row["estatus"]=="Gone"){
                               echo "i class";
                               }else{
                                echo $row["estatus"];
                               }
                               ?></td>  
                               <td><a>Edit</a><a>Delete</a></td>  
                          </tr>  
                          <?php  
                          }  
                          ?>  
                     </table>  
                </div>  
           </div>  
    </div>
   
    
</body>
</html>