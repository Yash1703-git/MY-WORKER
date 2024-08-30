<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration form</title>
    <link rel="stylesheet" href="admin-regi.css">
    <link rel="icon"  href="../assets/logo.jpg">
</head>
<body>
    <?php
    include_once("../../db/conection.php");
    $serror="";
    if (isset($_POST["submit"])) {
        // Retrieve and sanitize form inputs
        $ucompany = $_POST["ucompany"];
        $ucompany_type = $_POST["ucompany_type"];
        $uname = $_POST["uname"];
        $uemail = $_POST["uemail"];
        $umobile_no = $_POST["umobile_no"];
        $upassword = $_POST["upassword"];
        $cpassword = $_POST["cpassword"];

        // Server-side validation
        if (empty($ucompany)) {
            $serror = "*Please enter company name!";
        }
        else if  (empty($ucompany_type)) {
            $serror = "*Please enter company type!";
        }
        else if (empty($uname)) {
            $serror = "*Please enter admin name!";
        }
        else if  (empty($uemail)) {
            $serror = "*Please enter email!";
        } else if  (!filter_var($uemail, FILTER_VALIDATE_EMAIL)) {
            $serror = "*Invalid email format!";
        }
        else if  (empty($umobile_no)) {
            $serror = "*Please enter mobile number!";
        } else if  (!preg_match("/^[0-9]{10}$/", $umobile_no)) {
            $serror = "*Invalid mobile number format!";
        }
        else if (empty($upassword)) {
            $upassword_error = "*Please enter password!";
        }
        else if (empty($cpassword)) {
            $serror = "*Please confirm your password!";
        } else if ($upassword !== $cpassword) {
            $serror = "*Passwords do not match!";
        } else {
            // Hash the password for security
            $hashed_password = md5($cpassword); 

            // Insert data into the database
            $sql = "INSERT INTO users (ucompany, ucompany_type, urole, uname, uemail, umobile_no, upassword) 
                    VALUES ('$ucompany', '$ucompany_type','admin' ,'$uname', '$uemail', $umobile_no, '$hashed_password')";

            if ($conn->query($sql) === TRUE) {
                echo "<script type='text/javascript'>alert('Account registration successfully');
                window.location.href='../login.php';</script>";
               

            } else {
                echo "<script type='text/javascript'>alert('Error: " . $sql . "<br>" . $conn->error . "');</script>";
            }
        }
    }

    $conn->close();
    ?>
    <form method="post">
        <h1>Admin Registration</h1>
        <div class="sign-up">
            <h3>Sign Up here!</h3>
            <span style="color:red"><?php echo $serror ?></span>
            <input type="text" name="ucompany" placeholder="Company Name" >
            <input type="text" name="ucompany_type" placeholder="Company Type" >
            <input type="text" name="uname" placeholder="Admin Name" >
            <input type="email" name="uemail" placeholder="Email Id" >
            <input type="text" name="umobile_no" placeholder="Mobile No"  >
            <input type="password" name="upassword" placeholder="Password" >
            <input type="password" name="cpassword" placeholder="Confirm Password" >
            <input type="submit" value="Submit" name="submit" class="regi-btn-2" />
        </div>
    </form>
</body>
</html>
