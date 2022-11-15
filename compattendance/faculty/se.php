<?php
        session_start();
        include "navbar.php";

        ?>
<!-- new code  -->
<?php
$conn = mysqli_connect("localhost", "root", "", "comp_attendance");
if(mysqli_connect_errno()){
    die("cannot connect to database".mysqli_connect_errno());
}
?>

<div class="container" style="margin-top: 2rem">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card mt-5">
                    <div class="card-header">
                        <h4>Second Year
                            <button type="button" class="btn btn-outline-secondary float-right" data-toggle="modal" data-target="#exampleModal" onclick="display()" data-whatever="@mdo">Print</button>
                            <script>
                                function display() {
                                    window.print();
                                }
                            </script>
                        </h4>
                    </div>
                    <div class="card-body">
                    <?php
                        $username1=$_SESSION['username'];
                        $query="SELECT `id`, `name`, `email`, `mobile`, `qualification`, `joiningdate`, `password`, `image`, 'faculty', `username` FROM `users` WHERE username='$username1'";
                        $result=mysqli_query($conn, $query);
                        while($fetch= mysqli_fetch_assoc($result)){
                        $date = date("d/m/y");
                        echo<<<faculty
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Co-ordinator: $fetch[name]</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    Date: $date
                        faculty;
                        }

                    ?>
                        
                    </div>
                </div>
            </div>
            <form action="?" method="POST">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Select Division</label>
                            <select class="form-control col-md-7" name="sort">
                                <option value="A" name="division">A</option>
                                <!-- <option value="B" name="division">B</option> -->
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Select Subject</label>
                            <select class="form-control col-md-7" name="subject">
                                <?php
                                    $query= "SELECT `fourthsemsubjects` FROM `users` WHERE username='$username1' ";
                                    $result=mysqli_query($conn, $query);
                                    
                                    while(($fetch = mysqli_fetch_assoc($result))){
                                        echo<<<subjects
                                        <option value="$fetch[fourthsemsubjects]" name="$fetch[fourthsemsubjects]">$fetch[fourthsemsubjects]</option>
                                        subjects;
                                    }
                                ?>
                                
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Click to Filter</label> <br>
                          <button type="submit" name="filter" class="btn btn-secondary">Filter</button>
                        </div>
                    </div>
                </div>
            </form>
            </div>
        </div>

                <div class="card mt-4">
                    <div class="card-body">
                        <table class="table table-borderd">
                            <thead>
                                <tr>
                                    <th>Roll No.</th>
                                    <th>Name</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                            
            <tr>
                <?php
                    if(isset($_POST['filter'])){
                    
                    $dsaquery= "SELECT `id`, `name`, `dsa`, `dsatotal` FROM `students`";
                    $result=mysqli_query($conn, $dsaquery);

                        while($fetch= mysqli_fetch_assoc($result)){
                            echo<<<students
                            <tr class="align-middle">
                                <th scope="row">$fetch[id]</th>
                                <td>$fetch[name]</td>
                                <form action="attendance.php" method="POST">

                                <td><input type="checkbox" value="$fetch[id]" name="status[]"></td>
                                
                            </tr>
                            students;
                        }
                    }
                ?>
                
                
            </tr>
        </tbody>
                        </table>
                        <?php
                        if(isset($_POST['filter'])){
                        echo "<center><input type='submit'class='btn btn-secondary' name='submitattendance' value='submit'></center>";
                        echo "</form>";
                        }
                        ?>
                    </div>
                </div>

            </div>
        </div>
    </div>


      