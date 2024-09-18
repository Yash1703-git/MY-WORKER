<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin-pannel</title>
    <link rel="stylesheet" href="./Ad-home-pnnel.css">
    <link rel="stylesheet" href="all-emp.css">
    <link rel="icon"  href="../../assets/logo.jpg">
    <link rel="stylesheet" href="./../../assets/css/all.min.css">
    <script>
     
        function openNav() {
          document.getElementById("mySidebar").style.width = "30%";
          document.getElementById("main").style.marginLeft = "0px";
          document.getElementById("main").style.display="none"
        }
    
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
          <div style="width: 100%; height:100%; text-align:center; position:relative;top:30%;">
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
            <a href=""><img src="../../assets/live employe.png">Live Employess</a>
            <a href="./attendance.php"><img src="../../assets/attends.png">Attendance</a>
            <a href=""><img src="../../assets/notification.png">Notification</a>
            <a href="./salary.php/salary.php"><img src="../../assets/salaerie.png">Salaries</a> 
            <form method="post">
                        <button class="btn-logout" type="submit" name="logout">Logout</button>
                    </form>
          </div>
          </div>
          <div class="nav">
            <div id="main">   
              <button class="openbtn" onclick="openNav()">☰</button> 
            </div>
            
            <button id="openModalBtn" class="add-button"> <i class="fa fa-add"></i></button>
            <!-- The Modal -->
            <div id="myModal" class="modal">
            <?php
    // connection for add employee
     include_once("./../../db/conection.php");
     $_serror="";
     if(isset($_POST["submit"])){
         // Retrieve and sanitize form inputs
         $ename = $_POST["ename"];
         $eemail = $_POST["eemail"];
         $emobile = $_POST["emobile"];
         $ejoiningdate = $_POST["ejoiningdate"];
         $esalary = $_POST["esalary"];
         $estatus = $_POST["estatus"];
        
        //  serverside validation
        if (empty($ename)) {
            $serror = "*Please enter  name";
        }
        elseif(empty($eemail)){
            $_serror= "*please enter email";
        }
        elseif(empty($emobile)){
            $serror = "*please enter mobile no";
        }
        elseif(empty($ejoiningdate)){
            $serror = "*please enter Joining date";
        }
        elseif(empty($esalary)){
            $serror = "*please enter salary";
        }
        elseif(empty($estatus)){
            $serror = "*please enter status";
        }
        else{
            $hashed_password = md5($emobile); 
            $digits = range(0, 9);
            shuffle($digits);
            $randomDigits = array_slice($digits, 0, 5);
            $randomString = implode('', $randomDigits);
            $companyname=$_SESSION["company"];
            $euniqueid= $companyname.$randomString;
            $adminid=$_SESSION['adminid'];
        //   insert query
        $sql="  INSERT INTO `employees`( `ename`, `emobile`, `eemail`, `ejoiningdate`, `esalary`, `estatus`, `euniqueid`, `epassword`, `adminid`)
             VALUES ('$ename','$emobile','$eemail','$ejoiningdate',$esalary,'$estatus','$euniqueid','$hashed_password',$adminid)";

             if ($conn->query($sql) === TRUE) {
                echo "<script type='text/javascript'>alert('Account registration successfully');
                window.location.href='../../Login/login.php';</script>";
               

            } else {
                echo "<script type='text/javascript'>alert('Error: " . $sql . "<br>" . $conn->error . "');</script>";
            }
        }
     }
    ?>
    <!-- add employee div -->
                    <div class="modal-content">
                        <span class="close">&times;</span>
                        <form method="post">
                <h1>New Employee</h1>
            <input type="text" name="ename" placeholder="Enter name">
            <input type="text" name="eemail" placeholder="Enter Email">
            <input type="text" name="emobile" placeholder="Enter Moblie No">
            <input type="date" name="ejoiningdate" placeholder="Joing Date">
            <input type="text" name="esalary" placeholder="Salaery">
            <input type="text" name="estatus" placeholder="Live/leave">
            <button type="submit" value="submit" name="submit">Save Me</button>
            </form>
                    </div>
                </div>  
            
          </div>
          <?php
          // connection for displya all employees
          include_once("../../db/conection.php");
          $adminid=$_SESSION['adminid'];
          $empquery="SELECT * FROM employees WHERE adminid=$adminid ";
          $result = mysqli_query($conn, $empquery);  
          
          ?>
          <!-- all-employees -->
          <div class="container-2">
            
            <table>
              <tr style="background-color: green;">
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
                               <td><i class="fa fa-pen"><i class="fa fa-trash"></td>  
                          </tr>  
                          <?php  
                          }  
                          ?>  
            </table>
            
          </div>
    </div>    
    <!-- JavaScript at the end of the body -->
    <script type="text/javascript">
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