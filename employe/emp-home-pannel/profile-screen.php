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
<style>
   @media print{
      .sidebar, .nav{
        display: none;
      }
      .print-button{
        display: none;
      }
   }
</style>

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

        function printinfo() {
       // Get the table and rows
       var table = document.querySelector('.container-2 table');
        var rows = table.querySelectorAll('tr');

          // Print the table
    window.print();
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
        <?php
            // Logout functionality
            if (isset($_POST["logout"])) {
              unset($_SESSION['myadminid']); // Unset admin session
                header("Location: ./../../Login/login.php"); // Redirect to login page
                exit(); // Stop execution after redirect
            }
            ?>
           <a href="./EMP-home-pannel.php"><img src="./../../assets/Home.png" alt="">Home</a>
           <a href="./My-attendance.php"><img src="./../../assets/attends.png" alt="">My Attends</a>
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
             $eid = $_SESSION['eid'];
             $empquery = "SELECT * FROM employees WHERE eid = $eid";
             $result = mysqli_query($conn, $empquery);  
             $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
            ?>
            <div class="box-1">
                <div class="emp-Name">
                <h1><?php echo htmlspecialchars($row["ename"])?></th>
                  <table border="1">
                   
                    <tr>
                      <td>Unique ID -:</td>
                      <td>
                      <?php echo ($row["euniqueid"]); ?>
                      </td>
                    </tr>
                    
                    <tr>
                      <td>Mobile No -:</td>
                      <td>
                    <?php echo htmlspecialchars($row["emobile"])?>
                      </td>
                    </tr>
                    <tr>
                      <td>Email -:</td>
                      <td>
                      <?php echo htmlspecialchars($row["eemail"])?>
                      </td>
                    </tr>
                    <tr>
                      <td>Joining Date -:</td>
                      <td>
                      <?php echo htmlspecialchars($row["ejoiningdate"])?>
                      </td>
                    </tr>
                    <tr>
                      <td>Salary -:</td>
                      <td>
                      <?php echo htmlspecialchars($row["esalary"])?>
                      </td>
                    </tr>
                    <tr>
                      <td>Acc NO -:</td>
                      <td>
                      <?php echo htmlspecialchars($row["accno"])?>
                      </td>
                    </tr>
                    <tr>
                      <td>IFSC CODE -:</td>
                      <td>
                      <?php echo htmlspecialchars($row["ifsc"])?>
                      </td>
                    </tr>
                  </table>
                    
                </div>

                <button id="printButton" class="print-button" onclick="printinfo()">Print </button>
                
            </div>
        </div>
    </div>
</body>
</html>