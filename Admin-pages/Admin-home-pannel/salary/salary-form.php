<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>salaryc-form</title>
    <link rel="stylesheet" href="salary-form.css">
    <link rel="stylesheet" href="./../../../assets/css/all.css">
</head>
<body>
    <div class="container">
    <?php 
  session_start(); // Start the session
?>

<!-- data save send-->

           

<?php
// Connection for displaying all employees
include_once("./../../../db/conection.php");
$adminid = $_SESSION['adminid'];

// Use mysqli_real_escape_string to prevent SQL injection
$adminid = mysqli_real_escape_string($conn, $adminid);
$empquery = "SELECT * FROM employees WHERE adminid = $adminid";
$result = mysqli_query($conn, $empquery);
?>

<table style="border-collapse: collapse; width:70%">
    <tr style="background-color: green;">
        <th>Emp Id</th>
        <th>Name</th>
        <th>Email</th>
        <th>Acc No</th>
        <th>IFSC Code</th>
        <th>Salary</th>
        <th>Option</th>
    </tr>
    <?php  
    while ($row = mysqli_fetch_array($result)) {
        // Prepare JavaScript object string for employee data
        $employeeData = json_encode([
            'uniqueid' => $row["euniqueid"],
            'name' => $row["ename"],
            'email' => $row["eemail"],
            'accno' => $row["accno"],
            'ifsc' => $row["ifsc"],
            'salary' => $row["esalary"],
        ]);
    ?>
    <tr>
        <td>#<?php echo htmlspecialchars($row["euniqueid"]); ?></td>
        <td><?php echo htmlspecialchars($row["ename"]); ?></td>
        <td><?php echo htmlspecialchars($row["eemail"]); ?></td>
        <td><?php echo htmlspecialchars($row["accno"]); ?></td>
        <td><?php echo htmlspecialchars($row["ifsc"]); ?></td>
        <td><?php echo htmlspecialchars($row["esalary"]); ?></td>
        <td>
            <?php 
            // Sanitize the employee ID
            $uid = mysqli_real_escape_string($conn, $row["euniqueid"]);
            $todaymonth = date("m");
            $todayyear = date("Y");
            
            $query = "SELECT * FROM salaries WHERE sempid = '$uid' AND smonth = '$todaymonth' AND syear = '$todayyear'";

            $salaryResult = mysqli_query($conn, $query); 
            $count = mysqli_num_rows($salaryResult);  
            
            if ($count >= 1) { ?>
                <button disabled>Already Paid</button>
            <?php } else { ?>
                <button type="button" class="btn-1" onclick='openModal(<?php echo $employeeData; ?>)'>Pay</button>
            <?php } ?>
        </td>
    </tr>
    <?php  
    }  
    ?>  
</table>
    </div>

    <!-- modal -->
<!-- post -->
<?php
include_once("./../../../db/conection.php"); // Database connection
$_serror = ""; // Initialize error message

// Handle form submission for adding an employee
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['pay'])) {
    // Prepare the data to store
    $sempid = $_POST["euniqueid"];
    $sename = $_POST["ename"];
    $samountpaid = $_POST["esalary"];
    $saccno = $_POST["accno"];
    $sifsc = $_POST["ifsc"];
    $snoleaves = $_POST['snoleaves'];
    $adminid = $_SESSION['adminid']; // Ensure you have the admin ID from the session
    $currentDate = date("d/m/Y");
    $cmonth=date("m");
    $cyear=date("Y");
    // Prepare and bind
    $sql = "INSERT INTO `salaries`(`sempid`, `sename`, `saccno`, `sifsc`, `samountpaid`, `snoleaves`, `sdate`, `smonth`, `syear`, `sadminid`) 
                    VALUES ('$sempid', '$sename', '$saccno', '$sifsc', '$samountpaid', '$snoleaves','$currentDate','$cmonth','$cyear', '$adminid')";

            if ($conn->query($sql) === TRUE) {
                echo "<script type='text/javascript'>alert('Payment recorded successfully');
                window.location.href='./salary-form.php';</script>";
               

            } else {
                echo "<script type='text/javascript'>alert('Error: " . $sql . "<br>" . $conn->error . "');</script>";
            }
    

    // Close the statement
    $stmt->close();
}
?>
    <?php
            include_once("./../../../db/conection.php");
             $empquery = "SELECT * FROM employees WHERE adminid = $adminid";
             $result = mysqli_query($conn, $empquery);  
             $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
            ?>

<div id="mymodal" class="modal">
    <div class="modal-content">
        <span onclick="closemodal()" id="close"><i class="fa fa-window-close" aria-hidden="true"></i></span>
        <form method="post">
            <h1 id="modal-name"></h1>
            <div class="information">
            <input type="hidden" name="euniqueid" id="modal-uniqueid-input">
                <input type="hidden" name="ename" id="modal-name-input">
                <input type="hidden" name="accno" id="modal-accno-input">
                <input type="hidden" name="ifsc" id="modal-ifsc-input">
                
                <table class="info">
                    <tr>
                        <td>Unique ID:</td>
                        <td><span id="modal-uniqueid-display"></span></td>
                    </tr>
                    <tr>
                        <td>Salary:</td>
                        <td><input name="esalary" id="modal-salary-input" class="modal-salary-input" type="text" required></td>
                    </tr>
                    <tr>
                        <td>ACC NO:</td>
                        <td><span id="modal-accno-display"></span></td>
                    </tr>
                    <tr>
                        <td>IFSC CODE:</td>
                        <td><span id="modal-ifsc-display"></span></td>
                    </tr>
                    <tr>
                        <td>No of Leaves:</td>
                        <td><input type="text" name="snoleaves" value="0" required></td>
                    </tr>
                </table>
                <button type="submit" name="pay" class="btn-1">SEND</button>
            </div>
        </form>
    </div>
</div>


                <!-- JavaScript for modal functionality -->
    <script type="text/javascript">
     function openModal(employee) {
    // Populate the modal with the employee data
    document.getElementById("modal-name").textContent = employee.name;
    document.getElementById("modal-uniqueid-display").textContent = employee.uniqueid;
    document.getElementById("modal-accno-display").textContent = employee.accno;
    document.getElementById("modal-ifsc-display").textContent = employee.ifsc;

    // Populate hidden inputs
    document.getElementById("modal-uniqueid-input").value = employee.uniqueid;
    document.getElementById("modal-name-input").value = employee.name;

    // Set the salary input value
    document.getElementById("modal-salary-input").value = employee.salary; // Ensure this is correctly referenced

    document.getElementById("modal-accno-input").value = employee.accno;
    document.getElementById("modal-ifsc-input").value = employee.ifsc;

    // Show the modal
    document.getElementById("mymodal").style.display = "block";
}
function closemodal(){

    document.getElementById("mymodal").style.display = "none";
}
    


    </script>
</body>
</html>