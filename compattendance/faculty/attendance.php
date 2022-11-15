<?php

session_start();
$conn = mysqli_connect("localhost", "root", "", "comp_attendance");
if(mysqli_connect_errno()){
    die("cannot connect to database".mysqli_connect_errno());
}
if(isset($_POST['submitattendance'])){

    if($_POST['status'][$i] == ''){
            header("location: se.php");
    }

    $username1 = $_SESSION['username'];
    $query1 ="SELECT `fourthsemsubjects` FROM `users` WHERE username='$username1'";
    $result = mysqli_query($conn, $query1);
    while($fetch = mysqli_fetch_assoc($result)){
        $subname = strtolower($fetch['fourthsemsubjects']);
        $subtotal = strtolower($subname."total");
        
    }
    
    $query= "SELECT `id`, `name`, `dsa`, `dsatotal`, `ppl`, `ppltotal`, `mp`, `mptotal`, `m3`, `m3total`, `se`, `setotal` FROM `students`";
    $result = mysqli_query($conn, $query);
    $fetch= mysqli_fetch_assoc($result);
    $uptotal = $fetch[$subtotal] + 1;
    
    $numberofcheckbox = count($_POST['status']);
    $i = 0;
    while($i < $numberofcheckbox){

            $keytoupdate = $_POST['status'][$i];

            $query= "SELECT `id`, `name`, `$subname` FROM `students`";
            
            $result = mysqli_query($conn, $query);
            $fetch= mysqli_fetch_assoc($result);
            $upsub = ($fetch[$subname]) + 1;
            
            $query ="UPDATE `students` SET `$subname`='$upsub',`$subtotal`='$uptotal' WHERE `id`='$keytoupdate'";
            mysqli_query($conn, $query);

    $i++;
    }
    header("location: se.php");
}

?>