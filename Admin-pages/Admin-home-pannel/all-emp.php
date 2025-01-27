<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="./home.css">
    <link rel="stylesheet" href="all-emp.css">
    <link rel="icon" href="../../assets/logo.jpg">
    <link rel="stylesheet" href="./../../assets/css/all.min.css">
    <style>
        @media print {
            title {
        display: none; /* This won't work; see below for proper way */
    }

    /* Hide the print button during print */
    .print-button {
        display: none;
    }
.nav{
    display: none;
}
    /* You can also hide other elements if necessary */
    .sidebar, .nav {
        display: none;
    }

    .container table {
        width: 100%;
        border-collapse: collapse; /* Optional: To ensure borders collapse */
    }
    /* Hide the print button during print */
    .print-button {
        display: none;
    }
}
        </style>
    <script>
        // Function to open the sidebar
        function openNav() {
            document.getElementById("mySidebar").style.width = "30%";
            document.getElementById("main").style.marginLeft = "30%"; // Adjust main margin
            document.getElementById("main").style.display = "none";
        }
    
        // Function to close the sidebar
        function closeNav() {
            document.getElementById("mySidebar").style.width = "0";
            document.getElementById("main").style.marginLeft = "0";
            document.getElementById("main").style.display = "block";
        }

        function confirmDelete() {
            return confirm("Are you sure you want to delete this item?");
        }

    // Function to print the table excluding the last column
    function printtable() {
    // Get the table and rows
    var table = document.querySelector('.container-2 table');
    var rows = table.querySelectorAll('tr');

    // Hide the last column for printing
    for (var i = 0; i < rows.length; i++) {
        var cells = rows[i].querySelectorAll('td, th');
        if (cells.length > 0) {
            cells[cells.length - 1].style.display = 'none'; // Hide last cell
        }
    }
    
    // Print the table
    window.print();

    // Show the last column again after printing
    for (var i = 0; i < rows.length; i++) {
        var cells = rows[i].querySelectorAll('td, th');
        if (cells.length > 0) {
            cells[cells.length - 1].style.display = ''; // Show last cell
        }
    }
}

    </script>
</head>
<body>
  
<?php 
  session_start(); // Start the session
?>
    <div class="container">
        <!-- Sidebar -->
        <div id="mySidebar" class="sidebar">
            <div class="sidebar-nav">
                <div style="width: 100%; height:100%; text-align:center; position:relative;top:30%;">
                    <p><?php echo $_SESSION['company']; ?></p>
                </div>
                <a href="javascript:void(0)" class="closebtn" id="closebtn" onclick="closeNav()">×</a>
            </div>
            <div class="side-container">
                <?php
                // Logout functionality
                if (isset($_POST["logout"])) { 
                    unset($_SESSION['adminid']);
                    header("Location: ../../Login/login.php");
                }
                ?>
                <a href="./home.php"><img src="./../../assets/Home.png">HOME</a>
            <a href="./all-emp.php"><img src="../../assets/employe.png"> Employees</a>
            <a href="./live-employee.php"><img src="../../assets/live employe.png"> Live Employees</a>
            <a href="./../Admin-home-pannel/attendance.php"><img src="../../assets/attends.png"> Attendance</a>
            <a href="./salary/salary.php"><img src="../../assets/salaerie.png"> Salaries</a> 
                <form method="post">
                    <button class="btn-logout" type="submit" name="logout">Logout</button>
                </form>
            </div>
        </div>

        <!-- Navigation bar -->
        <div class="nav">
            <div id="main">   
                <button class="openbtn" onclick="openNav()">☰</button> 
            </div>
            
            <button id="openModalBtn" class="add-button"> <i class="fa fa-add"></i></button>
            
            <!-- The Modal for adding an employee -->
            <div id="myModal" class="modal">
                <?php
                include_once("./../../db/conection.php"); // Database connection
                $_serror = ""; // Initialize error message

                // Handle form submission for adding an employee
                if (isset($_POST["submit"])) {
                    // Retrieve and sanitize form inputs
                    $ename = $_POST["ename"];
                    $eemail = $_POST["eemail"];
                    $accno = $_POST["accno"];
                    $ifsc = $_POST["ifsc"];
                    $emobile = $_POST["emobile"];
                    $ejoiningdate = $_POST["ejoiningdate"];
                    $esalary = $_POST["esalary"];
                    $estatus = $_POST["estatus"];
                    
                    // Server-side validation
                    if (empty($ename)) {
                        $_serror = "*Please enter name";
                    }
                    else if (empty($accno)) {
                        $serror = "*Please enter Account No!";
                    }
                    else if  (empty($ifsc)) {
                        $serror = "*Please enter IFSC CODE!";
                    }
                    
                    elseif (empty($eemail)) {
                        $_serror = "*Please enter email";
                    } elseif (empty($emobile)) {
                        $_serror = "*Please enter mobile number";
                    } elseif (empty($ejoiningdate)) {
                        $_serror = "*Please enter joining date";
                    } elseif (empty($esalary)) {
                        $_serror = "*Please enter salary";
                    } elseif (empty($estatus)) {
                        $_serror = "*Please enter status";
                    } else {
                        // Hash the mobile number for password
                        $hashed_password = md5($emobile); 
                        // Generate unique ID for employee
                        $digits = range(0, 9);
                        shuffle($digits);
                        $randomDigits = array_slice($digits, 0, 5);
                        $randomString = implode('', $randomDigits);
                        $companyname = $_SESSION["company"];
                        $euniqueid = $companyname . $randomString;
                        $adminid = $_SESSION['adminid'];

                        // Insert query
                        $sql = "INSERT INTO `employees`( `ename`, `emobile`, `eemail`, `ejoiningdate`, `esalary`, `estatus`, `euniqueid`, `epassword`, `adminid`)
                                VALUES ('$ename', '$emobile', '$eemail', '$ejoiningdate', $esalary, '$estatus', '$euniqueid', '$hashed_password', $adminid)";

                        if ($conn->query($sql) === TRUE) {
                            echo "<script type='text/javascript'>alert('Account registered successfully');
                            window.location.href='../../Login/login.php';</script>";
                        } else {
                            echo "<script type='text/javascript'>alert('Error: " . $sql . "<br>" . $conn->error . "');</script>";
                        }
                    }
                }
                ?>
                <!-- Add employee form -->
                <div class="modal-content">
                    <span class="close">&times;</span>
                    <form method="post">
                        <h1>New Employee</h1>
                        <input type="text" name="ename" placeholder="Enter name" required>
                        <input type="text" name="ename" placeholder="Enter name" required>
                        <input type="text" name="accno" placeholder="Bank Account No" >
                        <input type="text" name="ifsc" placeholder="IFSC CODE" >
                        <input type="email" name="eemail" placeholder="Enter Email" required>
                        <input type="tel" name="emobile" placeholder="Enter Mobile No" required>
                        <input type="date" name="ejoiningdate" required>
                        <input type="number" name="esalary" placeholder="Salary" required>
                        <!-- <input type="text" name="estatus" placeholder="Live/Gone" required> -->
                         <select name="estatus">
                            <option>Live</option>
                            <option>Gone</option>
                         </select>
                        <button type="submit" name="submit">Save Me</button>
                    </form>
                </div>
            </div>
        </div>

        <?php
        // Connection for displaying all employees
        include_once("../../db/conection.php");
        $adminid = $_SESSION['adminid'];
        $empquery = "SELECT * FROM employees WHERE adminid = $adminid";
        $result = mysqli_query($conn, $empquery);  


        // delte employee

        if(isset($_POST['deletesubmit'])){

            $eid = $_POST["eid"];
            $sql = "DELETE FROM `employees` WHERE eid=$eid";
            echo "<script type='text/javascript'>if(Confirm('Are you sure you want to delete this employee?')==true){</script>";
            if ($conn->query($sql) === TRUE) {
                echo "<script type='text/javascript'>alert('Employee deleted successfully');
                window.location.href='../Admin-home-pannel/all-emp.php';</script>";
            } else {
                echo "<script type='text/javascript'>alert('Error: " . $sql . "<br>" . $conn->error . "');</script>";
            }
    
            echo "<script type='text/javascript'>}else{}</script>";

           
        }
        ?>
        <!-- All Employees Table -->
        <div class="container-2">
            
            <table style="border-collapse: collapse;" >
                <tr style="background-color: green;">
                    <th>Name</th>  
                    <th>Mobile Number</th>  
                    <th>Email</th>  
                    <th>Joining Date</th>  
                    <th>Status</th>  
                    <th>Actions</th>
                </tr>
                <?php  
                while ($row = mysqli_fetch_array($result)) {  
                    $editurl="edit-emp.php?ename=".htmlspecialchars($row["ename"])."&emobile=".htmlspecialchars($row["emobile"])."&eemail=".htmlspecialchars($row["eemail"])."&ejoiningdate=".htmlspecialchars($row["ejoiningdate"])."&esalary=".htmlspecialchars($row["esalary"])."&estatus=".htmlspecialchars($row["estatus"])."&eid=".$row["eid"];
                ?>  
                <tr>  
                    <td><?php echo htmlspecialchars($row["ename"]); ?></td>  
                    <td><?php echo htmlspecialchars($row["emobile"]); ?></td>  
                    <td><?php echo htmlspecialchars($row["eemail"]); ?></td>  
                    <td><?php echo htmlspecialchars($row["ejoiningdate"]); ?></td>  
                    <td><?php echo $row["estatus"]; ?></td>  
                    <td>
                       <a href=<?php echo $editurl ?>> <i class="fa fa-pen"></i></a>

                       <!-- delete button -->
                       <!-- <h1>Item Details</h1>
                       <p>Item ID: <?php echo htmlspecialchars($row['eid']); ?></p> -->

                       <form action="" method="post" onsubmit="return confirmDelete();">
                         <input type="hidden" name="eid" value="<?php echo htmlspecialchars($row['eid']); ?>" />
                        <button type="submit" name="deletesubmit" style="border:none; background:none; cursor:pointer;">
                           <i class="fa fa-trash"></i>
                        </button>
                       </form>
                    </td>  
                </tr>  
                <?php  
                }  
                ?>  
            </table>
            <button id="printButton" class="print-button" onclick="printtable()">Print </button>
            </div>
           <!-- print button -->
    </div>    

    <!-- JavaScript for modal functionality -->
    <script type="text/javascript">
        // Modal functionality
        var modal = document.getElementById("myModal");
        var btn = document.getElementById("openModalBtn");
        var span = document.getElementsByClassName("close")[0];

        // Open modal on button click
        btn.onclick = function() {
            modal.style.display = "block";
        }

        // Close modal on clicking the close button
        span.onclick = function() {
            modal.style.display = "none";
        }

        // Close modal when clicking outside of it
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>
</body>
</html>
