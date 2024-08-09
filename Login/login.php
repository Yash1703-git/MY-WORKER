<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Login</title>
      <link rel="stylesheet" href="login.css">
      <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
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
         <div id="left-container" class="left-container">
            <div id="emp-image" class="emp-image">
               <img  src="../assets/emp.jpg" style="width:100%;height:100%" />
            </div>
            <div id="admin-image" style="width:100%;height:100%">
               <img  src="../assets/admin-1.jpg" style="width:100%;height:100%"/>
            </div>
         </div>
         <!-- right -->
         <div id="right-container">
            <!-- EMPLOYEE FORM -->
            <div id="emp-form">
               <div class="emp-form-container">
                  <p>EMPLOYEE LOGIN</p>
                  <form action="#" method="post">
                     <h6 for="employee-id">Employee Unique ID</h6>
                     <input type="text" id="employee-id" name="employee-id" placeholder="Enter your unique ID" required>
                     <h6 for="password">Password</h6>
                     <input type="password" id="password" name="password" placeholder="Enter your password" required>
                     <button type="submit">LOGIN</button><button onclick="switchAdminLogin()" id="adminlogin-btn" type="submit">ADMIN LOGIN</button>
                     </div>
                   
                  </form>
                  <!-- <button onclick="switchAdminLogin()" id="adminlogin-btn" type="submit">ADMIN LOGIN</button> -->
               </div>
            </div>
            <!-- ADMIN FORM  -->
            <div id="admin-form">
               < class="admin-form-container">
                  <p>ADMIN LOGIN</p>
                  <form action="#" method="post">
                     <h6 for="employee-id">Email ID/ Mobile No.</h6>
                     <input type="email/No" id="employee-id" name="employee-id" placeholder="Enter Email/no" required>
                     <h6 for="password">Password</h6>
                     <input type="password" id="password" name="password" placeholder="Enter your password" required>
                     <button  type="submit">LOGIN</button>
                  </form>
                  <button onclick="switchEmpLogin()" id="emplogin-btn" type="submit">EMPLOYEE LOGIN</button>
                  <h3>New Register</h3>
             </div>
   </div>
             <!--  -->
         </div>
      </div>
</html>