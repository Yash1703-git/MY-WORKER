<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>edit-employee</title>
    <link rel="stylesheet" href="edit-emp.css">
    <link rel="stylesheet" href="./home.css">
</head>
<body>
   

    <?php
                include_once("./../../db/conection.php"); // Database connection
                $_serror = ""; // Initialize error message

                // Handle form submission for adding an employee
                if (isset($_POST["editsubmit"])) {
                    // Retrieve and sanitize form inputs
                    $ename = $_POST["ename"];
                    $eemail = $_POST["eemail"];
                    $emobile = $_POST["emobile"];
                    $ejoiningdate = $_POST["ejoiningdate"];
                    $esalary = $_POST["esalary"];
                    $estatus = $_POST["estatus"];
                    
                    // Server-side validation
                    if (empty($ename)) {
                        $_serror = "*Please enter name";
                    } elseif (empty($eemail)) {
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
                       
                           $eid=$_GET['eid'];
                        // Insert query
                        $sql = "UPDATE `employees` SET `ename`='$ename',`emobile`='$emobile',`eemail`='$eemail',`ejoiningdate`='$ejoiningdate',`esalary`=$esalary,`estatus`='$estatus' WHERE eid=$eid";
               

                        if ($conn->query($sql) === TRUE) {
                            echo "<script type='text/javascript'>alert('Employee updated successfully');
                            window.location.href='../Admin-home-pannel/all-emp.php';</script>";
                        } else {
                            echo "<script type='text/javascript'>alert('Error: " . $sql . "<br>" . $conn->error . "');</script>";
                        }
                    }
                }
                ?>
<div class="container-2">
    <form method="post">
                        <h1>Update Employee</h1>
                        <input type="text" name="ename" value="<?php echo $_GET['ename']?>" placeholder="Enter name" required>
                        <input type="email" name="eemail" value=<?php echo $_GET['eemail']?> placeholder="Enter Email" required>
                        <input type="tel" name="emobile" value=<?php echo $_GET['emobile']?> placeholder="Enter Mobile No" required>
                        <input type="date" name="ejoiningdate" value=<?php echo $_GET['ejoiningdate']?> required>
                        <input type="number" name="esalary" value=<?php echo $_GET['esalary']?> placeholder="Salary" required>
                         <select name="estatus" >
                            <option value=<?php echo $_GET['estatus']?>><?php echo $_GET['estatus']?></option>

                            <?php
                            if($_GET['estatus']=="Live"){
                            ?>
                            <option value="Gone">Gone</option>
                            <?php }else{ ?>
                            <option value="Live">Live</option>
                            <?php } ?>
                        </select>

                        <button type="submit" name="editsubmit">Save Me</button>
                    </form>
                    </div>
</body>
</html>