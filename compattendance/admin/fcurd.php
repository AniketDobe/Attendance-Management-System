<?php
    session_start();

// require("conn.php");
    $conn = mysqli_connect("localhost", "root", "", "comp_attendance");
    if(mysqli_connect_errno()){
        die("cannot connect to database".mysqli_connect_errno());
    }

    define("UPLOAD_SRC", $_SERVER['DOCUMENT_ROOT']."/compattendance/faculty/assets/");
  
    define("FETCH_SRC", "http://127.0.0.1/compattendance/faculty/assets/");


    function image_upload($image){
        $tmp_loc = $image['tmp_name'];
        $new_name = random_int(11111, 99999).$image['name'];

        $new_loc = UPLOAD_SRC.$new_name;

        if(!move_uploaded_file($tmp_loc, $new_loc)){
            header("location: faculty.php?alert=img_upload");
            exit;
        }
        else{
            return $new_name;
        }
    }

    function image_remove($img){
        if(!unlink(UPLOAD_SRC.$img)){
            header("location: faculty.php?alert=img_rem_fail");
            exit;
        }
    }

    if(isset($_POST['addfaculty'])){
        // $fourthsemsubjects = $_POST['fourthsemsubjects'];
        // $subject = implode(",",$fourthsemsubjects);
        
        foreach($_POST as $key => $value){
            $_POST[$key] = mysqli_real_escape_string($conn, $value);
        }
        
        $imgpath = image_upload($_FILES['image']);
        
        // $query = "INSERT INTO `users`(`id`, `name`, `email`, `mobile`, `qualification`, `joiningdate`, `password`, `image`, `role`, `username`) VALUES ('$_POST[id]','$_POST[name]','$_POST[email]','$_POST[mobile]','$_POST[qualification]','$_POST[joiningdate]','$_POST[password]','$imgpath','faculty','$_POST[username]')";
        $query = "INSERT INTO `users`(`id`, `name`, `email`, `mobile`, `qualification`, `joiningdate`, `password`, `image`, `role`, `username`, `fourthsemsubjects`) VALUES ('$_POST[id]','$_POST[name]','$_POST[email]','$_POST[mobile]','$_POST[qualification]','$_POST[joiningdate]','$_POST[password]','$imgpath','faculty','$_POST[username]', '$_POST[fourthsemsubjects]')";
        // $query = "INSERT INTO `users`(`id`, `name`, `email`, `mobile`, `qualification`, `joiningdate`, `password`, `image`, `role`, `username`, `fourthsemsubjects`) VALUES ('$_POST[id]','$_POST[name]','$_POST[email]','$_POST[mobile]','$_POST[qualification]','$_POST[joiningdate]','$_POST[password]','$imgpath','faculty','$_POST[username]','$subject')";
        if(mysqli_query($conn, $query)){
            header("location: faculty.php?success=added");
        }
        else{
            header("location: faculty.php?alert=add_failed");
        }
    }


    if(isset($_GET['rem']) && $_GET['rem'] > 0){
        $query = "SELECT *FROM `users` WHERE `id`='$_GET[rem]'";
        $result=mysqli_query($conn, $query);
        $fetch= mysqli_fetch_assoc($result);

        image_remove($fetch['image']);

        $query = "DELETE FROM `users` WHERE `id`='$_GET[rem]'";
        if(mysqli_query($conn, $query)){
            header("location: faculty.php?success=removed");
        }
        else{
            header("location: faculty.php?alert=remove_failed");
        }
    }

    if(isset($_POST['editfaculty'])){
        foreach($_POST as $key => $value){
            $_POST[$key] = mysqli_real_escape_string($conn, $value);
        }
        
        if(file_exists($_FILES['image']['tmp_name']) || is_uploaded_file($_POST['image']['tmp_name'])){
            $query = "SELECT *FROM `users` WHERE `id`='$_POST[editpid]'";
            $result=mysqli_query($conn, $query);
            $fetch= mysqli_fetch_assoc($result);

            image_remove($fetch['image']);

            $imgpath = image_upload($_FILES['image']);

            $update = "UPDATE `users` SET `id`='$_POST[id]',`name`='$_POST[name]',`email`='$_POST[email]',`mobile`='$_POST[mobile]',`qualification`='$_POST[qualification]',`joiningdate`='$_POST[joiningdate]',`password`='$_POST[password]',`image`='$imgpath',`username`='$_POST[username]',`fourthsemsubjects`='$_POST[fourthsemsubjects]' WHERE `id`='$_POST[editpid]'";
            
            
        }
        else{
            $update = "UPDATE `users` SET `id`='$_POST[id]',`name`='$_POST[name]',`email`='$_POST[email]',`mobile`='$_POST[mobile]',`qualification`='$_POST[qualification]',`joiningdate`='$_POST[joiningdate]',`password`='$_POST[password]',`username`='$_POST[username]',`fourthsemsubjects`='$_POST[fourthsemsubjects]' WHERE `id`='$_POST[editpid]'";
        }
        if(mysqli_query($conn, $update)){
            header("location: faculty.php?success=updated");
        }
        else{
            header("location: faculty.php?alert=update_failed");
        }
    }
?>