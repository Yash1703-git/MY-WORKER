<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home pannel</title>
    <link rel="stylesheet" href="./EMP-home-pannel.css"> 
    <link rel="icon"  href="../../assets/logo.jpg">
    <link rel="stylesheet" href="./../../assets/css/all.min.css">
    <script type="text/javascript">
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

        // script for modal
        function openmodal(){
            document.getElementById("myModal").style.display = "block";
        }
        function closemodal(){
            document.getElementById("myModal").style.display = "none";
        }
      </script>
</head>
<body>
<?php
include_once("../../db/conection.php");
session_start();

$serror = "";
if (isset($_POST["submit"])) {
    $currentDate = date("d/m/Y");
    $currentTime = date("h:i:s A"); // Corrected time format
    $markstatus = $_POST["markstatus"]; // Removed space
    $empsms = $_POST["empsms"]; // Fixed variable name

    // Ensure that markstatus and empsms are set
    if ($markstatus!=="IN/LEAVE") {
        $sql = "INSERT INTO attendance (markstatus, empsms, markdate, marktime, empid, adminid) 
                VALUES ('$markstatus', '$empsms', '$currentDate', '$currentTime', '".$_SESSION['eid']."', '".$_SESSION['myadminid']."')";

        if ($conn->query($sql) === TRUE) {
            // Redirect after successful submission
            header("Location: " . $_SERVER['PHP_SELF']);
            exit(); // Stop further execution
        } else {
            echo "<script type='text/javascript'>alert('Error: " . $sql . "<br>" . $conn->error . "');</script>";
        }
    } else {
        echo "<script type='text/javascript'>alert('Please Select Mark');</script>";
    }
}
?>
    <div class="container">
      <div id="mySidebar" class="sidebar">
        <div class="sidebar-nav">
        <div style="width: 100%; height: 100%; text-align: center; position: relative; top: 30%;">
                <p><?php echo htmlspecialchars($_SESSION['company'] ?? 'Company'); ?></p>
            </div>
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
   $currentDate = date("d/m/Y");
   $currentTime = date("h:i:s A"); // Corrected time format
   $empid = $_SESSION['eid'];
    $query = "SELECT * FROM attendance WHERE empid = $empid AND markdate = '$currentDate'  ";
    $result = mysqli_query($conn, $query);
    $inforow = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $count = mysqli_num_rows($result);  
    if($count >= 1){
            ?>
 
 <div class="btn-attendance">
    <button id="openModalBtn" onclick="alert('Attendance already marked.')">
      <p><?php echo htmlspecialchars($inforow['markstatus']); ?> MARKED (<?php echo htmlspecialchars($currentDate); ?>)</p>
      <i class="fa fa-user-check"></i>
    </button>
  </div>
      <?php
      
    }else{
     
    ?>
      <div class="btn-attendance">
        <button  id="openModalBtn" onclick="openmodal()">
          <p>Mark Attendance</p>
          <i class="fa fa-hand-pointer"></i>
        </button>
      </div>
      <?php
      
    }
    ?>

      <!-- Modal -->
               <div  id="myModal" class="modal">
                  <div class="modal-content">
                      <span class="close" id="close-modal" onclick="closemodal()"><i class="fa fa-close"></i></span>
                     <h1>ATTENDANCE</h1>
                     <form method="post" action="">
                        <div class="status">
                         <select name="markstatus">
                           <option style="display: none;">IN/LEAVE</option>
                           <option value="IN">IN</option>
                           <!-- <option value="OUT">OUT</option> -->
                           <option value="LEAVE">LEAVE</option>
                         </select>
                        </div>
                        <div class="message">
                        <h3><label for="empsms">Leave A Message</label></h3>
                        <textarea id="w3review" name="empsms" rows="10" cols="30"></textarea>
                        </div>
                        <div class="btn-reg">
                          <button type="submit" name="submit" class="empsubmit">Register</button>
                        </div>
                      </form>
                  </div>
                </div>
      <div class="notice-pannel">
        <div class="notice-box">
          <div class="notice-header">
            <p>Notice </p>
          </div>
          <div class="notice-content">
            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Animi recusandae assumenda eum 
              libero ducimus eius officiis magnam, optio atque consequuntur harum minus? Provident minima 
              eius ducimus libero consectetur minus corrupti!
            Distinctio voluptatem reprehenderit reiciendis deleniti quia neque sequi cumque 
             iste expedita. Perferendis odio quos laudantium, sint dolores ratione ea esse eius libero repellendus enim praesentium autem earum, quia officiis.
          </div>
        </div>
      </div>
    </div>
    </div>
    
</body>
<!-- <script type="text/javascript">
        function openmodal(){
            document.getElementById("myModal").style.display = "block";
        }
        function closemodal(){
            document.getElementById("myModal").style.display = "none";
        }
    </script> -->
</html>