<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="salary-form.css">
   
    <style>
        .container{
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            height: 100%;
        }
    </style>

</head>
<body>
    <div class="container">
<?php session_start(); ?>
<?php
    
    include_once("../../../db/conection.php");
    $adminid = $_SESSION['adminid'];
    $inquery = "SELECT * FROM salaries WHERE sadminid = $adminid";
    $inresult = mysqli_query($conn, $inquery);
    ?>
    
    <table style="border-collapse: collapse;">
        <tr style="background-color: #80B17B;">
             
            <th>Name</th>  
            <th>ACC. NO</th>  
            <th>Date</th>
            <th>salary</th>          
            <th>NO Leaves</th>
            <th>Amount Paid</th>
        </tr>
        <?php  
        while ($row = mysqli_fetch_array($inresult)) {  
            $sempid = $row['sempid'];
            $infoquery = "SELECT * FROM employees WHERE euniqueid = '$sempid'";
            $inforesult = mysqli_query($conn, $infoquery);  
            $inforow = mysqli_fetch_array($inforesult, MYSQLI_ASSOC);
            
        ?>  
        <tr>  
            
            <td><?php echo htmlspecialchars($row["sename"]); ?></td>
            <td><?php echo htmlspecialchars($row["saccno"]); ?></td>
            <td><?php echo htmlspecialchars($row["sdate"]); ?></td>
            <td><?php echo htmlspecialchars($inforow["esalary"]); ?></td>
            <td><?php echo htmlspecialchars($row["snoleaves"]); ?></td>
            <td><?php echo htmlspecialchars($row["samountpaid"]); ?></td>
        </tr>
        <?php } ?>
    </table>
    </div>
</body>
</html>