<?php
        session_start();
        include "navbar.php";


    $conn = mysqli_connect("localhost", "root", "", "comp_attendance");
    if(mysqli_connect_errno()){
        die("cannot connect to database".mysqli_connect_errno());
    }
    
    define("UPLOAD_SRC", $_SERVER['DOCUMENT_ROOT']."/compattendance/faculty/assets/");
  
    define("FETCH_SRC", "http://127.0.0.1/compattendance/faculty/assets/");
?>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <br><br><br>
    <div class="container bg-dark text-light p-2 rounded my-4" >
        <div class="d-flex align-items-center justify-content-between px-3">
            <h2>Faculty</h2>
            <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
            <i class="bi bi-plus"></i>Add Faculty
            </button>
        </div>
    </div>

<?php 
    if(isset($_GET['alert'])){
        if($_GET['alert'] == 'img_upload'){
            echo<<<alert
                <div class="container alert alert-danger alert-dismissible text-center" role="alert">
                    <strong>Image Upload Failed! Server Down!</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            alert;
        }
        if($_GET['alert'] == 'img_rem_fail'){
            echo<<<alert
                <div class="container alert alert-danger alert-dismissible text-center" role="alert">
                    <strong>Image Removal Failed! Server Down!</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            alert;
        }
        if($_GET['alert'] == 'add_failed'){
            echo<<<alert
                <div class="container alert alert-danger alert-dismissible text-center" role="alert">
                    <strong>Cannot Add Faculty! Server Down!</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            alert;
        }
        if($_GET['alert'] == 'remove_failed'){
            echo<<<alert
                <div class="container alert alert-danger alert-dismissible text-center" role="alert">
                    <strong>Cannot Remove Faculty! Server Down!</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            alert;
        }
        if($_GET['alert'] == 'update_failed'){
            echo<<<alert
                <div class="container alert alert-danger alert-dismissible text-center" role="alert">
                    <strong>Cannot Update Faculty! Server Down!</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            alert;
        }
    }
    else if(isset($_GET['success'])){
        if($_GET['success'] == 'updated'){
            echo<<<alert
                <div class="container alert alert-success alert-dismissible text-center" role="alert">
                    <strong>Faculty Updated!</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            alert;
        }
        if($_GET['success'] == 'added'){
            echo<<<alert
                <div class="container alert alert-success alert-dismissible text-center" role="alert">
                    <strong>Faculty Added!</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            alert;
        }
        if($_GET['success'] == 'removed'){
            echo<<<alert
                <div class="container alert alert-success alert-dismissible text-center" role="alert">
                    <strong>Faculty Removed!</strong>
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
            <th scope="col">Id</th>
            <th scope="col">Name</th>
            <th scope="col">Joining Date</th>
            <th scope="col">Mobile No.</th>
            <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $query="SELECT `id`, `name`, `mobile`, `joiningdate` FROM `users` WHERE role='faculty'";
                $result=mysqli_query($conn, $query);
                $i=1;
                $fetch_src = FETCH_SRC;

                while($fetch= mysqli_fetch_assoc($result)){
                    echo<<<faculty
                    <tr class="align-middle">
                        <td>$fetch[id]</td>
                        <td>$fetch[name]</td>
                        <td>$fetch[joiningdate]</td>
                        <td>$fetch[mobile]</td>
                        <td>
                            <a href="?edit=$fetch[id]" class="btn btn-outline-warning me-2"><i class="bi bi-pencil-square"></i></a>
                            <button id="#editfaculty" onclick="confirm_rem($fetch[id])" class="btn btn-outline-danger"><i class="bi bi-trash"></i></button>
                        </td>
                    </tr>
                    faculty;
                }
            ?>
    </tbody>
    </table>
</div>
<!-- Add Module -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
      <form action="fcurd.php" method="POST" enctype="multipart/form-data">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Add Faculty</h5>
            </div>
            <div class="modal-body">
                <div class="input-group mb-3">
                    <span class="input-group-text">Id</span>
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
                    <span class="input-group-text">Mobile NO.</span>
                    <input type="text" class="form-control" name="mobile" required>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text">Joining Date</span>
                    <input type="date" class="form-control" name="joiningdate" required>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text">Qualification </span>
                    <input type="text" class="form-control" name="qualification" required>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text">Username </span>
                    <input type="text" class="form-control" name="username" required>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text">Password </span>
                    <input type="password" class="form-control" name="password" required>
                </div>
                <div class="input-group mb-3">
                    <label class="input-group-text">Image</label>
                    <input type="file" class="form-control" name="image" accept=".png, .jpeg, .jpg, .svg" required>
                </div>
                <label for="recipient-name" class="col-form-label">Select Subjects</label>
                <input type="radio" value="PPL" name="fourthsemsubjects"> PPL &nbsp;&nbsp;
                <input type="radio" value="DSA" name="fourthsemsubjects"> DSA &nbsp;&nbsp;
                <input type="radio" value="MP" name="fourthsemsubjects"> MP &nbsp;&nbsp;
                <input type="radio" value="M3" name="fourthsemsubjects"> M3 &nbsp;&nbsp;
                <input type="radio" value="SE" name="fourthsemsubjects"> SE &nbsp;&nbsp;
            </div>
            <div class="modal-footer">
              <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
              <button type="submit" class="btn btn-success" name="addfaculty">Add</button>
            </div>
          </div>
      </form>
  </div>
</div>


<!-- edit module  -->
<div class="modal fade" id="editfaculty" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
      <form action="fcurd.php" method="POST" enctype="multipart/form-data">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Edit Faculty</h5>
            </div>

            <div class="modal-body">
                <div class="input-group mb-3">
                    <span class="input-group-text">Id</span>
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
                    <span class="input-group-text">Mobile NO.</span>
                    <input type="text" class="form-control" name="mobile" id="editmobile" required>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text">Joining Date</span>
                    <input type="date" class="form-control" name="joiningdate" id="editjoiningdate" required>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text">Qualification </span>
                    <input type="text" class="form-control" name="qualification" id="editqualification" required>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text">Username </span>
                    <input type="text" class="form-control" name="username" id="editusername" required>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text">Password </span>
                    <input type="password" class="form-control" name="password" id="editpassword" required>
                </div>
                <img src="" id="editimg" width="100px" alt="Loading..." class="mb-3"><br>
                <div class="input-group mb-3">
                    <label class="input-group-text">Image</label>
                    <input type="file" class="form-control" name="image" accept=".png, .jpeg, .jpg, .svg">
                </div>
                <input type="hidden" name="editpid" id="editpid">
                <label for="recipient-name" class="col-form-label">Select Subjects</label>
                <input type="hidden" value="PPL" id="editfourthsemsubjects" name="fourthsemsubjects" >  &nbsp;&nbsp;
                <input type="radio" value="PPL" id="editfourthsemsubjects" name="fourthsemsubjects" > PPL &nbsp;&nbsp;
                <input type="radio" value="DSA" id="editfourthsemsubjects" name="fourthsemsubjects"> DSA &nbsp;&nbsp;
                <input type="radio" value="MP" id="editfourthsemsubjects" name="fourthsemsubjects"> MP &nbsp;&nbsp;
                <input type="radio" value="M3" id="editfourthsemsubjects" name="fourthsemsubjects"> M3 &nbsp;&nbsp;
                <input type="radio" value="SE" id="editfourthsemsubjects" name="fourthsemsubjects"> SE &nbsp;&nbsp;
            </div>
            <div class="modal-footer">
              <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
              <button type="submit" class="btn btn-success" name="editfaculty">Edit</button>
            </div>
          </div>
      </form>
  </div>
</div>

<?php
    if(isset($_GET['edit']) && $_GET['edit'] > 0){
        $query = "SELECT *FROM `users` WHERE `id` = '$_GET[edit]'";
        $result = mysqli_query($conn, $query);
        $fetch = mysqli_fetch_assoc($result);
        echo "
            <script>
                var editfaculty = new bootstrap.Modal(document.getElementById('editfaculty'), {
                    keyboard:false
                });
                document.querySelector('#editid').value=`$fetch[id]`;
                document.querySelector('#editname').value=`$fetch[name]`;
                document.querySelector('#editemail').value=`$fetch[email]`;
                document.querySelector('#editmobile').value=`$fetch[mobile]`;
                document.querySelector('#editjoiningdate').value=`$fetch[joiningdate]`;
                document.querySelector('#editqualification').value=`$fetch[qualification]`;
                document.querySelector('#editusername').value=`$fetch[username]`;
                document.querySelector('#editpassword').value=`$fetch[password]`;
                document.querySelector('#editimg').src=`$fetch_src$fetch[image]`;
                document.querySelector('#editfourthsemsubjects').value=`$fetch[fourthsemsubjects]`;
                document.querySelector('#editpid').value=`$_GET[edit]`;
                editfaculty.show();
            </script>
        ";

    }
?>


<script>
    function confirm_rem(id){
        if(confirm("Are you sure, you want to delete this item?")){
            window.location.href="fcurd.php?rem="+id;
        }
    }
</script>