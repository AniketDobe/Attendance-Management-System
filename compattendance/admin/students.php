<?php
        session_start();
        include "navbar.php";


    $conn = mysqli_connect("localhost", "root", "", "comp_attendance");
    if(mysqli_connect_errno()){
        die("cannot connect to database".mysqli_connect_errno());
    }

?>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <br><br><br>
    <div class="container bg-dark text-light p-2 rounded my-4" >
        <div class="d-flex align-items-center justify-content-between px-3">
            <h2>Student</h2>
            <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
            <i class="bi bi-plus"></i>Add Student
            </button>
        </div>
    </div>

<?php 
    if(isset($_GET['alert'])){
        
        if($_GET['alert'] == 'add_failed'){
            echo<<<alert
                <div class="container alert alert-danger alert-dismissible text-center" role="alert">
                    <strong>Cannot Add Student! Server Down!</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            alert;
        }
        if($_GET['alert'] == 'remove_failed'){
            echo<<<alert
                <div class="container alert alert-danger alert-dismissible text-center" role="alert">
                    <strong>Cannot Remove Student! Server Down!</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            alert;
        }
        if($_GET['alert'] == 'update_failed'){
            echo<<<alert
                <div class="container alert alert-danger alert-dismissible text-center" role="alert">
                    <strong>Cannot Update Student! Server Down!</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            alert;
        }
    }
    else if(isset($_GET['success'])){
        if($_GET['success'] == 'updated'){
            echo<<<alert
                <div class="container alert alert-success alert-dismissible text-center" role="alert">
                    <strong>Student Updated!</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            alert;
        }
        if($_GET['success'] == 'added'){
            echo<<<alert
                <div class="container alert alert-success alert-dismissible text-center" role="alert">
                    <strong>Student Added!</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            alert;
        }
        if($_GET['success'] == 'removed'){
            echo<<<alert
                <div class="container alert alert-success alert-dismissible text-center" role="alert">
                    <strong>Student Removed!</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            alert;
        }
    }
?>

<div class="container mt-4 p-0">
    <table class="table table-hover text-center">
    <thead>
            <tr>
            <th scope="col">Roll No.</th>
            <th scope="col">Name</th>
            <th scope="col">Semester</th>
            <th scope="col">Division</th>
            <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $query= "SELECT `id`, `name`, `semester`, `division` FROM `students` ";
                $result=mysqli_query($conn, $query);
                $i=1;

                while($fetch= mysqli_fetch_assoc($result)){
                    echo<<<students
                    <tr class="align-middle">
                        <th scope="row">$fetch[id]</th>
                        <td>$fetch[name]</td>
                        <td>$fetch[semester]</td>
                        <td>$fetch[division]</td>
                        
                        <td>
                            <a href="?edit=$fetch[id]" class="btn btn-outline-warning me-2"><i class="bi bi-pencil-square"></i></a>
                            <button id="#editstudents" onclick="confirm_rem($fetch[id])" class="btn btn-outline-danger"><i class="bi bi-trash"></i></button>
                        </td>
                    </tr>
                    students;
                }
            ?>
    </tbody>
    </table>
</div>
<!-- Add Module -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
      <form action="scurd.php" method="POST">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Add Student</h5>
            </div>
            <div class="modal-body">
                <div class="input-group mb-3">
                    <span class="input-group-text">Roll No.</span>
                    <input type="number" class="form-control" name="id" required>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text">Name</span>
                    <input type="text" class="form-control" name="name" required>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text">Email</span>
                    <input type="email" class="form-control" name="email" required>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text">Mobile No.</span>
                    <input type="text" class="form-control" name="mobileno" required>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text">PRN No.</span>
                    <input type="text" class="form-control" name="prn" required>
                </div>
                <div class="input-group mb-3">
                <label class="input-group-text" for="inputGroupSelect01">Semester</label>
                <select class="form-select" name="semester">
                    <!-- <option selected value="first">First Semester</option>
                    <option value="second">Second Semester</option> -->
                    <option value="third">Third Semester</option>
                    <option value="fourth">Fourth Semester</option>
                    <!-- <option value="fifth">Fifth Semester</option>
                    <option value="sixth">Sixth Semester</option>
                    <option value="seventh">Seventh Semester</option>
                    <option value="eighth">Eighth Semester</option> -->
                </select>
                </div>
                <div class="input-group mb-3">
                <label class="input-group-text" for="inputGroupSelect01">Division</label>
                <select class="form-select" name="division" >
                    <option selected value="A">A</option>
                    <!-- <option value="B">B</option> -->
                </select>
                </div>
            </div>
            <div class="modal-footer">
              <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
              <button type="submit" class="btn btn-success" name="addstudents">Add</button>
            </div>
          </div>
      </form>
  </div>
</div>


<!-- edit module  -->
<div class="modal fade" id="editstudents" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
  <form action="scurd.php" method="POST">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Add Student</h5>
            </div>
            <div class="modal-body">
                <div class="input-group mb-3">
                    <span class="input-group-text">Roll No.</span>
                    <input type="number" class="form-control" name="id" id="editid" required>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text">Name</span>
                    <input type="text" class="form-control" name="name" id="editname" required>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text">Email</span>
                    <input type="email" class="form-control" name="email" id="editemail" required>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text">Mobile No.</span>
                    <input type="text" class="form-control" name="mobileno" id="editmobileno" required>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text">PRN No.</span>
                    <input type="text" class="form-control" name="prn" id="editprn" required>
                </div>
                <div class="input-group mb-3">
                <label class="input-group-text" for="inputGroupSelect01">Semester</label>
                <select class="form-select" name="semester" id="editsemester">
                    <!-- <option selected value="first">First Semester</option> -->
                    <!-- <option value="second">Second Semester</option> -->
                    <!-- <option value="third">Third Semester</option> -->
                    <option value="fourth">Fourth Semester</option>
                    <!-- <option value="fifth">Fifth Semester</option> -->
                    <!-- <option value="sixth">Sixth Semester</option> -->
                    <!-- <option value="seventh">Seventh Semester</option> -->
                    <!-- <option value="eighth">Eighth Semester</option> -->
                </select>
                </div>
                <div class="input-group mb-3">
                <label class="input-group-text" for="inputGroupSelect01">Division</label>
                <select class="form-select" name="division" id="editdivision">
                    <option selected value="A">A</option>
                    <!-- <option value="B">B</option> -->
                </select>
                </div>
                <input type="hidden" name="editpid" id="editpid">
            </div>
            <div class="modal-footer">
              <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
              <button type="submit" class="btn btn-success" name="editstudents">Edit</button>
            </div>
          </div>
      </form>
  </div>
</div>

<?php
    if(isset($_GET['edit']) && $_GET['edit'] > 0){
        $query = "SELECT *FROM `students` WHERE `id` = '$_GET[edit]'";
        $result = mysqli_query($conn, $query);
        $fetch = mysqli_fetch_assoc($result);
        echo "
            <script>
                var editstudents = new bootstrap.Modal(document.getElementById('editstudents'), {
                    keyboard:false
                });
                document.querySelector('#editid').value=`$fetch[id]`;
                document.querySelector('#editname').value=`$fetch[name]`;
                document.querySelector('#editemail').value=`$fetch[email]`;
                document.querySelector('#editmobileno').value=`$fetch[mobileno]`;
                document.querySelector('#editprn').value=`$fetch[prn]`;
                document.querySelector('#editsemester').value=`$fetch[semester]`;
                document.querySelector('#editdivision').value=`$fetch[division]`;
                
                document.querySelector('#editpid').value=`$_GET[edit]`;
                editstudents.show();
                </script>
                ";
    }
?>


<script>
    function confirm_rem(id){
        if(confirm("Are you sure, you want to delete this item?")){
            window.location.href="scurd.php?rem="+id;
        }
    }
</script>
