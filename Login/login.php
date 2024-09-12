<!DOCTYPE html>
<html lang="en"> 
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Login</title>
      <link rel="stylesheet" href="login.css">
      <link rel="icon"  href="../assets/logo.jpg">
   </head>
   <script>
      function switchAdminLogin(){
          document.getElementById("emp-form").style.display="none";
          document.getElementById("admin-form").style.display="block";
          document.getElementById("emp-image").style.display="none";
          document.getElementById("admin-image").style.display="block";
      
      }
      function switchEmpLogin(){
          document.getElementById("emp-form").style.display="block";
          document.getElementById("admin-form").style.display="none";
          document.getElementById("emp-image").style.display="block";
          document.getElementById("admin-image").style.display="none";
      }
   </script>
   <body style="margin:0;padding:0">
   <?php
   //admin login check
    session_start();
   
   //check already admin logged in
   if (isset($_SESSION['adminid']) && $_SESSION['adminid'] !== null) {
      header("Location: ../Admin-pages/Admin-home-pannel/Ad-home-pnnel.php");
      exit(); // Always use exit() after header redirection
  }
  if (isset($_SESSION['myadminid']) && $_SESSION['eid'] !== null) {
   header("Location: ../employe/emp-home-pannel/EMP-home-pannel.php");
   exit(); // Always use exit() after header redirection
}

   include_once("../db/conection.php");
    $aerror="";
    if (isset($_POST["submitadmin"])) {

      
        // Retrieve and sanitize form inputs
       
        $adminid = $_POST["adminid"];
        $adminpass = $_POST["adminpassword"];
    if (empty($adminid)) {
         $aerror = "*Please enter email ID!";
     }
     else if  (empty($adminpass)) {
         $aerror = "*Password cannot be empty!";

     }else {   
      $hashed_password = md5($adminpass); 
         $loginquery="SELECT * FROM users WHERE uemail='$adminid' AND upassword='$hashed_password' ";
         $result = mysqli_query($conn, $loginquery);  
         $row = mysqli_fetch_array($result, MYSQLI_ASSOC);  
         $count = mysqli_num_rows($result);  
         print_r($row);
         if($count == 1){  
           $_SESSION['adminid']=$row['uid'];  
          $_SESSION['company']=$row['ucompany'];
          
          //
           
            echo "<script type='text/javascript'>alert('Login Successfully');
            window.location.href='../Admin-pages/Admin-home-pannel/Ad-home-pnnel.php';</script>";
        } else{  
          echo "<script type='text/javascript'>alert('Invalid admin id and passwword');</script>";
        }    

        }
        
      }
    
   
    // employee login chack

    
   
   //check already admin logged in
  
   include_once("../db/conection.php");
    $aerror="";
    if (isset($_POST["submitemp"])) {

      
        // Retrieve and sanitize form inputs
       
        $empid = $_POST["employee-id"];
        $emppass = $_POST["epassword"];
      
    if (empty($empid)) {
         $aerror = "*Please enter id!";
     }
     else if(empty($emppass)) {
         $aerror = "*Password cannot be empty!";

     }else {   
      $hashed_password = md5($emppass); 
         $loginquery="SELECT * FROM employees WHERE euniqueid='$empid' AND epassword='$hashed_password' ";
         $result = mysqli_query($conn, $loginquery);  
         $row = mysqli_fetch_array($result, MYSQLI_ASSOC);  
         $count = mysqli_num_rows($result);  
         print_r($row);
         if($count == 1){  
           $_SESSION['myadminid']=$row['adminid'];  
          $_SESSION['eid']=$row['eid'];
          
          //
           
            echo "<script type='text/javascript'>alert('Login Successfully');
            window.location.href='./../employe/emp-home-pannel/EMP-home-pannel.php';</script>";
        } else{  
          echo "<script type='text/javascript'>alert('Invalid admin id and passwword');</script>";
        }    

        }
        
      }
    $conn->close();


    ?>
      <div class="container">
         <!-- left  -->
         <div id="left-container" class="left-container" style="width:50%; height:100%">
            <div id="emp-image" class="emp-image">
               <img  src="../assets/emp.jpg" style="width:100%;height:100%" />
            </div>
            <div id="admin-image" style="width:100%;height:100%">
               <img  src="../assets/emp.jpg" style="width:100%;height:100%"/>
            </div>
         </div>
         <!-- right -->
         <div id="right-container" style="width: 50%; height:100%;">
            <!-- EMPLOYEE FORM -->
            <div id="emp-form">
               <div class="emp-form-container">
               <h1>welcome</h1>
                  <p style="right:36vh;  position: absoult; font-family: Poppins;font-size: 30px;font-weight: bolder;color: #5F9FFF;background-color: #FCFCFC;padding: 10px;">EMPLOYEE LOGIN</p>
                  <form action="" method="post">
                     <h6 for="employee-id">Employee Unique ID</h6>
                     <input type="text" id="employee-id" name="employee-id" placeholder="Enter your unique ID">
                     <h6 for="password">Password</h6>
                     <input type="password" id="password" name="epassword" placeholder="Enter your password">
                     <button type="submit" class="log" name="submitemp"> LOGIN</button>
                  </form>
                  <button onclick="switchAdminLogin()" id="adminlogin-btn" class="log" type="submit">ADMIN LOGIN</button>
               </div>
            </div>
            <!-- ADMIN FORM  -->
            <div id="admin-form" style="width:100%; height:100vh;overflow: hidden;">
            <div class="emp-form-container">
                  <p style="right:39vh;  position:absoult; font-family: Poppins;font-size: 30px; font-weight: bolder; color: #5F9FFF;background-color: #FCFCFC;padding: 10px;">ADMIN LOGIN</p>
                  <form action="" method="post">
                  <span style="color:red"><?php echo $aerror ?></span>
                     <h6 for="employee-id">EMAIL ID</h6>
                     <input type="text" id="employee-id" name="adminid" placeholder="Enter your Email ID" >
                     <h6 for="password">Password</h6>
                     <input type="password" id="password" name="adminpassword" placeholder="Enter your password" >
                     <button type="submit" name="submitadmin" class="log"> LOGIN</button>
                  </form>        
                  <div class="btn">
                    <button  onclick="switchEmpLogin()" id="emplogin-btn" class="log" type="submit">EMPLOY LOGIN</button>
                    <h4><a href="../Admin-pages/admin-regi/admin-regi.php">NEW REGISTRATION</a></h4>
                  </div>
               </div>
            </div>
         </div>
         <!--  -->
      </div>
   <body>
</html>