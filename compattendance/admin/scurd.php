<?php
    session_start();

    $conn = mysqli_connect("localhost", "root", "", "comp_attendance");
    if(mysqli_connect_errno()){
        die("cannot connect to database".mysqli_connect_errno());
    }


    if(isset($_POST['addstudents'])){
        foreach($_POST as $key => $value){
            $_POST[$key] = mysqli_real_escape_string($conn, $value);
        }
        $query = "INSERT INTO `students`(`id`, `name`, `email`, `mobileno`, `semester`, `prn`, `division`) VALUES ('$_POST[id]','$_POST[name]','$_POST[email]','$_POST[mobileno]','$_POST[semester]','$_POST[prn]','$_POST[division]')";

        if(mysqli_query($conn, $query)){
            header("location: students.php?success=added");
        }
        else{
            header("location: students.php?alert=add_failed");
        }
    }


    if(isset($_GET['rem']) && $_GET['rem'] > 0){
        $query = "SELECT *FROM `students` WHERE `id`='$_GET[rem]'";
        $result=mysqli_query($conn, $query);
        $fetch= mysqli_fetch_assoc($result);

        $query = "DELETE FROM `students` WHERE `id`='$_GET[rem]'";
        if(mysqli_query($conn, $query)){
            header("location: students.php?success=removed");
        }
        else{
            header("location: students.php?alert=remove_failed");
        }
    }

    if(isset($_POST['editstudents'])){
        foreach($_POST as $key => $value){
            $_POST[$key] = mysqli_real_escape_string($conn, $value);
        }
        
        $query = "SELECT *FROM `students` WHERE `id`='$_POST[editpid]'";
            $result=mysqli_query($conn, $query);
            $fetch= mysqli_fetch_assoc($result);

            $update = "UPDATE `students` SET `id`='$_POST[id]',`name`='$_POST[name]',`email`='$_POST[email]',`mobileno`='$_POST[mobileno]',`semester`='$_POST[semester]',`prn`='$_POST[prn]',`division`='$_POST[division]' WHERE `id`='$_POST[editpid]'";

            if(mysqli_query($conn, $update)){
            header("location: students.php?success=updated");
        }
        else{
            header("location: students.php?alert=update_failed");
        }
    }
?>