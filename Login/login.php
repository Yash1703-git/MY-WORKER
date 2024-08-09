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
   <body style="margin:0;padding:0">
      <div style="display:flex">
         <!-- left  -->
         <div id="left-container" style="width:50%;">
            <div id="emp-image" class="emp-image" style="width:100%;height:100%" >
               <img  src="../assets/emp.jpg" style="width:100%;height:100%" />
            </div>
            <div id="admin-image" style="width:100%;height:100%" >
               <img  src="../assets/admin.jpg" style="width:100%;height:100%" />
            </div>
         </div>
         <!-- right -->
         <div id="right-container" style="width:50%;flex-direction:column">
            <!-- EMPLOYEE FORM -->
            <div id="emp-form" style="width:100%;height:100vh">
               <div  style="display:flex;flex-direction:column;height:100%;">
                  <h2>EMPLOYEE LOGIN</h2>
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
            <div id="admin-form" style="width:100%;height:100vh">
               <div  style="display:flex;flex-direction:column;height:100%;">
                  <h2>ADMIN LOGIN</h2>
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