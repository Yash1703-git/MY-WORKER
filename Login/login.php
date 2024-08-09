<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Login</title>
      <link rel="stylesheet" href="login.css">
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
   <body>
      <div class="container">
         <!-- left  -->
         <div id="left-container" style="width:45%;">
            <div id="emp-image" class="emp-image" >
               <img  src="../assets/emp.jpg" />
            </div>
            <div id="admin-image" >
               <img  src="../assets/admin-1.jpg" />
            </div>
         </div>
         <!-- right -->
         <div id="right-container"  style="width: 55%;">
            <!-- EMPLOYEE FORM -->
            <div id="emp-form" class="emp-form">
               <div class="emp-form-container">
                  <p>EMPLOYEE LOGIN</p>
                  <form action="#" method="post">
                     <h6 for="employee-id">Employee Unique ID</h6>
                     <input type="text" id="employee-id" name="employee-id" placeholder="Enter your unique ID" required>
                     <h6 for="password">Password</h6>
                     <input type="password" id="password" name="password" placeholder="Enter your password" required>
                     <button type="submit">LOGIN</button>
                  </form>
                  <button onclick="switchAdminLogin()" id="adminlogin-btn" type="submit">ADMIN LOGIN</button>
               </div>
            </div>
            <!-- ADMIN FORM  -->
            <div id="admin-form">
               <div class="admin-form-container">
                  <p>ADMIN LOGIN</p>
                  <form action="#" method="post">
                     <h6 for="employee-id">Employee Unique ID</h6>
                     <input type="text" id="employee-id" name="employee-id" placeholder="Enter your unique ID" required>
                     <h6 for="password">Password</h6>
                     <input type="password" id="password" name="password" placeholder="Enter your password" required>
                     <button  type="submit">LOGIN</button>
                  </form>
                  <button onclick="switchEmpLogin()" id="emplogin-btn" type="submit">EMPLOYEE LOGIN</button>
               </div>
            </div>
            <!--  -->
         </div>
      </div>
</html>