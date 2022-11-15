<?php 
	session_start();

?>

<!DOCTYPE html>
<html>
<head>
<title>Comp Attendance</title>

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
</head>
<body>
      <div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh">
      	<form class="border shadow p-3 rounded" action="validation.php" method="POST" style="width: 450px;">
      	      <h1 class="text-center p-3">LOGIN</h1>
		  <div class="mb-3">
		    <label for="username" class="form-label" >Username</label>
		    <input type="username" class="form-control" name="username" id="username"autocomplete="off" required="">
		  </div>
		  <div class="mb-3">
		    <label for="password" class="form-label" >Password</label>
		    <input type="password" name="password" class="form-control" id="password" required="">
		  </div>
		  <div class="mb-1">
		    <label class="form-label">Select User Type:</label>
		  </div>
		  <select class="form-select mb-3" name="role" id="role" aria-label="Default select example">
			  <option selected value="faculty">Faculty</option>
			  <option value="admin">Admin</option>
		  </select>

		  <center><button type="submit" value="login" name="submit" class="btn btn-secondary">LOGIN</button></center>
		</form>
      </div>

</body>
</html>
