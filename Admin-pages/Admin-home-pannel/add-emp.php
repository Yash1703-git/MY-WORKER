<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add-Employee</title>
    <link rel="stylesheet" href="Ad-home-pnnel.css">
    <link rel="stylesheet" href="add-emp.css">
    <link rel="icon"  href="../../assets/logo.jpg">
</head>
<body>
    <?php
     session_start();
     include_once("./../../db/conection.php");
     $_serror="";
     if(isset($_POST["submit"])){
         // Retrieve and sanitize form inputs
         $ename = $_POST["ename"];
         $eemail = $_POST["eemail"];
         $emobile = $_POST["emobile"];
         $ejoiningdate = $_POST["ejoiningdate"];
         $esalary = $_POST["esalary"];
         $estatus = $_POST["estatus"];
        
        //  serverside validation
        if (empty($ename)) {
            $serror = "*Please enter  name";
        }
        elseif(empty($eemail)){
            $_serror= "*please enter email";
        }
        elseif(empty($emobile)){
            $serror = "*please enter mobile no";
        }
        elseif(empty($ejoiningdate)){
            $serror = "*please enter Joining date";
        }
        elseif(empty($esalary)){
            $serror = "*please enter salary";
        }
        elseif(empty($estatus)){
            $serror = "*please enter status";
        }
        else{
            $hashed_password = md5($emobile); 
            $digits = range(0, 9);
            shuffle($digits);
            $randomDigits = array_slice($digits, 0, 5);
            $randomString = implode('', $randomDigits);
            $companyname=$_SESSION["company"];
            $euniqueid= $companyname.$randomString;
            $adminid=$_SESSION['adminid'];
        //   insert query
        // jj

        $sql="  INSERT INTO `employees`( `ename`, `emobile`, `eemail`, `ejoiningdate`, `esalary`, `estatus`, `euniqueid`, `epassword`, `adminid`)
             VALUES ('$ename','$emobile','$eemail','$ejoiningdate',$esalary,'$estatus','$euniqueid','$hashed_password',$adminid)";

             if ($conn->query($sql) === TRUE) {
                echo "<script type='text/javascript'>alert('Account registration successfully');
                window.location.href='../../Login/login.php';</script>";
               

            } else {
                echo "<script type='text/javascript'>alert('Error: " . $sql . "<br>" . $conn->error . "');</script>";
            }
        }
     }
    ?>
          <div class="container-2" style="background-color: #5F9FFF;">
            <form method="post">
                <h1>New Employee</h1>
            <input type="text" name="ename" placeholder="Enter name">
            <input type="text" name="eemail" placeholder="Enter Email">
            <input type="text" name="emobile" placeholder="Enter Moblie No">
            <input type="date" name="ejoiningdate" placeholder="Joing Date">
            <input type="text" name="esalary" placeholder="Salaery">
            <input type="text" name="estatus" placeholder="Live/leave">
            <button type="submit" value="submit" name="submit">Save Me</button>
            </form>
          </div>
</body>
</html>