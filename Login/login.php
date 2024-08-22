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
                  <p style="right:36vh;  position: relative; font-family: Poppins;font-size: 30px;font-weight: bolder;color: #5F9FFF;background-color: #FCFCFC;padding: 10px;">EMPLOYEE LOGIN</p>
                  <form action="#" method="post">
                     <h6 for="employee-id">Employee Unique ID</h6>
                     <input type="text" id="employee-id" name="employee-id" placeholder="Enter your unique ID" required>
                     <h6 for="password">Password</h6>
                     <input type="password" id="password" name="password" placeholder="Enter your password" required>
                     <button type="submit" class="log"><a href="../employe/EMP-home-pannel.php">LOGIN</a></button>
                  </form>
                  <button onclick="switchAdminLogin()" id="adminlogin-btn" class="log-2" type="submit">ADMIN LOGIN</button>
               </div>
            </div>
            <!-- ADMIN FORM  -->
            <div id="admin-form" style="width:100%; height:100vh;overflow: hidden;">
            <div class="emp-form-container">
                  <p style="right:39vh;  position: relative; font-family: Poppins;font-size: 30px; font-weight: bolder; color: #5F9FFF;background-color: #FCFCFC;padding: 10px;">ADMIN LOGIN</p>
                  <form action="#" method="post">
                     <h6 for="employee-id">EMAIL ID</h6>
                     <input type="text" id="employee-id" name="employee-id" placeholder="Enter your unique ID" required>
                     <h6 for="password">Password</h6>
                     <input type="password" id="password" name="password" placeholder="Enter your password" required>
                     <button type="submit" class="log"><a href="../Admin-pages/Admin-home-pannel/Ad-home-pnnel.php"> LOGIN</a></button>
                  </form>
                  <div class="btn">
                    <button  onclick="switchEmpLogin()" id="emplogin-btn" class="log-2" type="submit">EMPLOY LOGIN</button>
                    <h4><a href="./admin-regi/admin-regi.php">NEW REGISTRATION</a></h4>
                  </div>
               </div>
            </div>
         </div>
         <!--  -->
      </div>
   <body>
</html>