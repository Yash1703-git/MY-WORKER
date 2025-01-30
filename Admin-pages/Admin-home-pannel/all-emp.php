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
            display: none;
            /* This won't work; see below for proper way */
        }

        /* Hide the print button during print */
        .print-button {
            display: none;
        }

        .nav {
            display: none;
        }

        /* You can also hide other elements if necessary */
        .sidebar,
        .nav {
            display: none;
        }

        .container table {
            width: 100%;
            border-collapse: collapse;
            /* Optional: To ensure borders collapse */
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
            <h1 style="position: absolute; left:50%; top:20px;">All Employees</h1>
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
                    $eaadhar = $_POST["eaadhar"];
                    $epan = $_POST["epan"];
                    $photoName = null; // Default if no photo is uploaded
                    $estatus = $_POST["estatus"];
                    

                    if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
                        $uploadDir = 'uploads/'; // Directory where files will be stored
                        $fileTmpPath = $_FILES['photo']['tmp_name'];
                        $fileName = $_FILES['photo']['name'];
                        $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);
                        $fileBaseName = pathinfo($fileName, PATHINFO_FILENAME);
                    
                        // Ensure the upload directory exists
                        if (!is_dir($uploadDir)) {
                            mkdir($uploadDir, 0777, true); // Create directory with permissions
                        }
                    
                        // Generate a unique file name to avoid overwrites
                        $newFileName = uniqid() . '.' . $fileExtension;
                        $destPath = $uploadDir . $newFileName;
                    
                        // Move the uploaded file to the destination directory
                        if (move_uploaded_file($fileTmpPath, $destPath)) {
                            $photoName = $newFileName; // Save the new file name for database insertion
                        } else {
                            echo "<script>alert('Error moving the uploaded file.');</script>";
                            $photoName = null; // Set to null if upload fails
                        }
                    } else {
                        $photoName = null; // No file uploaded
                    }

                    // Server-side validation
                    if (empty($ename)) {
                        $_serror = "*Please enter name";
                    }
                    else if (empty($accno)) {
                        $serror = "*Please enter Account No!";
                    }
                    else if  (empty($ifsc)) {
                        $serror = "*Please enter IFSC CODE!";
                    }else if (empty($eemail)) {
                        $_serror = "*Please enter email";
                    } elseif (empty($emobile)) {
                        $_serror = "*Please enter mobile number";
                    } elseif (empty($ejoiningdate)) {
                        $_serror = "*Please enter joining date";
                    } elseif (empty($esalary)) {
                        $_serror = "*Please enter salary";
                    } elseif (empty($eaadhar)) {
                        $_serror = "*Please enter Aadhar No";
                    }elseif (empty($epan)) {
                        $_serror = "*Please enter PAN No";
                    }
                    // 
                      // Handle optional photo upload
    

                    // 
                    elseif (empty($estatus)) {
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
                        $sql = "INSERT INTO `employees`( `ename`,`accno`,`ifsc`, `emobile`, `eemail`, `ejoiningdate`, `esalary`,`eaadhar`,`epan`,`photo`, `estatus`, `euniqueid`, `epassword`, `adminid`)
                                VALUES ('$ename','$accno','$ifsc', '$emobile', '$eemail', '$ejoiningdate', $esalary,'$eaadhar','$epan','$photoName', '$estatus', '$euniqueid', '$hashed_password', $adminid)";

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
                    <form method="post" enctype="multipart/form-data">
                        <h1>New Employee</h1>
                        <input type="text" name="ename" placeholder="Enter name" required>
                        <input type="text" name="accno" placeholder="Bank Account No">
                        <input type="text" name="ifsc" placeholder="IFSC CODE">
                        <input type="email" name="eemail" placeholder="Enter Email" required>
                        <input type="tel" name="emobile" placeholder="Enter Mobile No" required>
                        <input type="date" name="ejoiningdate" required>
                        <input type="number" name="esalary" placeholder="Salary" required>
                        <input type="text" name="eaadhar" placeholder="Aadhar No" maxlength="12" minlength="12"
                            pattern="\d{12}" required>
                        <input type="text" name="epan" placeholder="Pan No" maxlength="10"
                            pattern="[A-Z]{5}[0-9]{4}[A-Z]{1}" required>
                        <input type="file" name="photo" accept="image/*" id="image">
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

            <table style="border-collapse: collapse;">
                <tr style="background-color: green;">
                    <th>Name</th>
                    <th>Aadhar No</th>
                    <th>Pan No</th>
                    <th>Mobile Number</th>
                    <th>Email</th>
                    <th>Salary</th>
                    <th>Joining Date</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
                <?php  
                while ($row = mysqli_fetch_array($result)) {  
                    $editurl="edit-emp.php?ename=".htmlspecialchars($row["ename"])."&eaadhar=".htmlspecialchars($row["eaadhar"])."&epan=".htmlspecialchars($row["epan"])."&emobile=".htmlspecialchars($row["emobile"])."&eemail=".htmlspecialchars($row["eemail"])."&esalary=".htmlspecialchars($row["esalary"])."&ejoiningdate=".htmlspecialchars($row["ejoiningdate"])."&esalary=".htmlspecialchars($row["esalary"])."&estatus=".htmlspecialchars($row["estatus"])."&eid=".$row["eid"];
                ?>
                <tr>
                    <td>
                        <div style="display: flex; flex-direction:column; align-items:center;justify-content:center;">
                        <img src=<?php 
                        if($row["photo"]==""){
                            echo "uploads/no-image.jpg"; 
                        }else{
                        echo "uploads/".$row["photo"]; 
                        }
                        ?> 
                         style="width: 50px; height: 50px; border-radius: 2%; margin-bottom:10px">
                        <?php echo htmlspecialchars($row["ename"]); ?>
                        </div>
                    </td>
                    <td><?php echo htmlspecialchars($row["eaadhar"]); ?></td>
                    <td><?php echo htmlspecialchars($row["epan"]); ?></td>
                    <td><?php echo htmlspecialchars($row["emobile"]); ?></td>
                    <td><?php echo htmlspecialchars($row["eemail"]); ?></td>
                    <td><?php echo htmlspecialchars($row["esalary"]); ?></td>
                    <td><?php echo htmlspecialchars($row["ejoiningdate"]); ?></td>
                    <td><?php echo $row["estatus"]; ?></td>
                    <td>
                        <a href=<?php echo $editurl ?>> <i class="fa fa-pen"></i></a>

                        <!-- delete button -->
                        <!-- <h1>Item Details</h1>
                       <p>Item ID: <?php echo htmlspecialchars($row['eid']); ?></p> -->

                        <form action="" method="post" onsubmit="return confirmDelete();">
                            <input type="hidden" name="eid" value="<?php echo htmlspecialchars($row['eid']); ?>" />
                            <button type="submit" name="deletesubmit"
                                style="border:none; background:none; cursor:pointer;">
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

    const aadharInput = document.getElementById('aadhar');
    const aadharError = document.getElementById('aadharError');
    if (!/^\d{12}$/.test(aadharInput.value)) {
        aadharError.textContent = 'Please enter a valid 12-digit Aadhaar number.';
        valid = false;
    } else {
        aadharError.textContent = '';
    }

    // PAN validation
    const panInput = document.getElementById('pan');
    const panError = document.getElementById('panError');
    if (!/^[A-Z]{5}[0-9]{4}[A-Z]{1}$/.test(panInput.value)) {
        panError.textContent = 'Please enter a valid PAN number (e.g., AAAAA1234A).';
        valid = false;
    } else {
        panError.textContent = '';
    }

    if (!valid) {
        event.preventDefault();
    }
    </script>
</body>

</html>