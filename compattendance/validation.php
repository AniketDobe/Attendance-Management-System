<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	
<?php
    session_start();
	$conn = mysqli_connect("localhost", "root", "", "comp_attendance");
    
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

	$username = $_REQUEST['username'];
	$password = $_REQUEST['password'];
	$role = $_REQUEST['role'];

		$sql = "SELECT * FROM users where username = '".$username."' AND password = '".$password."' AND role = '".$role."'";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
			$_SESSION["username"] = $username;
			$_SESSION["role"] = $role;
				if($role=="admin")
				{
					header('Location:admin/profile.php');
					echo "<script>alert('Login successfull');document.location='admin/profile.php'</script>";
				}
				else{
					header('Location:faculty/profile.php');
					echo "<script>alert('Login successfull');document.location='faculty/profile.php'</script>";
				}
		} 
		else{
			 echo "<script>alert('Login failed');document.location='login.php'</script>";
		}
?>