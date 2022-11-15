<?php
    session_start();
    include "navbar.php"
?>
<?php
$conn = mysqli_connect("localhost", "root", "", "comp_attendance");
if(mysqli_connect_errno()){
    die("cannot connect to database".mysqli_connect_errno());
}
?>

<div class="container" style="margin-top:2rem;">
    <div class="row">
        <div class="col-md-12 mt-5">
            <div class="card">
                <div class="card-header">
                    <h4>Defaulters
                    <button type="button" class="btn btn-outline-secondary float-right" data-toggle="modal" data-target="#exampleModal" onclick="display()" data-whatever="@mdo">Print</button>
                        <script>
                            function display() {
                                window.print();
                            }
                        </script>
                    </h4>
                </div>
                <div class="card-body">  
                    <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <select class="form-control col-md-7" name="sort">
                                            <!-- <option value="A" >First Year</option> -->
                                            <option value="B" >Second Year</option>
                                            <!-- <option value="B">Third Year</option> -->
                                            <!-- <option value="B">Fourth Year</option> -->
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <!-- <div class="form-group">
                                        <select class="form-control col-md-7" name="sort"> -->
                                        <form action="?" method="POST">
                                            <input type="submit" class="btn btn-outline-secondary col-md-7" value="submit" name="view">
                                        </form>
                                            <!-- <option value="A" > A</option> -->
                                            <!-- <option value="B" > B</option> -->
                                        <!-- </select>
                                    </div> -->
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <?php echo "Date: ",date("d/m/y") ?>
                                        <!-- <label>Click to Filter</label> <br>
                                      <button type="submit" class="btn btn-secondary">Filter</button> -->
                                    </div>
                                </div>
                    </div>
                </div>
            </div>
        </div>
    </div>   
</div>                


<?php
    if(isset($_POST['view'])){
?>
<div class="container" style="margin-top:1rem;">
    <table class="table table-bordered" >
        <thead>
            <tr>
                <th scope="col" rowspan="3" style="vertical-align : middle;">Sr. No.</th>
                <th scope="col" rowspan="3" style="vertical-align : middle;">Roll No.</th>
                <th scope="col" rowspan="3" style="vertical-align : middle;">Name</th>
                <th scope="col" colspan="5"><center>Subject</center></th>
                <th scope="col" rowspan="2" colspan="1" style="vertical-align : middle;">Total</th>
                <th scope="col" rowspan="3" style="vertical-align : middle;">Attended (%)</th>
                <th scope="col" rowspan="3" style="vertical-align : middle;">Attended/Defaulter</th>
            </tr>
            <tr>
                <th scope="col">DSA</th>
                <th scope="col">PPL</th>
                <th scope="col">MP</th>
                <th scope="col">M3</th>
                <th scope="col">SE</th>
            </tr>
            <tr>
            <!-- <tr> -->
            <?php
                    // if(isset($_GET['view'])){
                    
                    // $dsaquery= "SELECT `id`, `name`, `dsa`, `dsatotal` FROM `students`";
                    $query= "SELECT `id`, `name`, `dsa`, `dsatotal`, `ppl`, `ppltotal`, `mp`, `mptotal`, `m3`, `m3total`, `se`, `setotal` FROM `students` ";
                    $result=mysqli_query($conn, $query);
                    $fetch= mysqli_fetch_assoc($result);
                    // $i=1;
                    // $fetch_src = FETCH_SRC;

                        // while($fetch= mysqli_fetch_assoc($result)){
                            $maintotal = $fetch['dsatotal'] + $fetch['ppltotal'] + $fetch['mptotal'] + $fetch['m3total'] + $fetch['setotal'];
                            
                            echo<<<defaulter
                                <th scope="col"><center>$fetch[dsatotal]</center></th>
                                <th scope="col"><center>$fetch[ppltotal]</center></th>
                                <th scope="col"><center>$fetch[mptotal]</center></th>
                                <th scope="col"><center>$fetch[m3total]</center></th>
                                <th scope="col"><center>$fetch[setotal]</center></th>
                                <th scope="col"><center>$maintotal</center></th>
                                defaulter;
                                ?>
               
            </tr>
        </thead>
        <tbody>
            
                <?php
                $query= "SELECT `id`, `name`, `dsa`, `dsatotal`, `ppl`, `ppltotal`, `mp`, `mptotal`, `m3`, `m3total`, `se`, `setotal` FROM `students` ";
                $result=mysqli_query($conn, $query);
                $i = 0;
                    while($fetch = mysqli_fetch_assoc($result)){
                        $i++;
                        $subtotal = $fetch['dsa'] + $fetch['ppl'] + $fetch['mp'] + $fetch['m3'] + $fetch['se'];
                        $percentage = ($subtotal/$maintotal) * 100;
                        $percentage = number_format($percentage, 2, '.', '');
                        $status = (75 <= $percentage) ? "Regular" : "Defaulter";
                        echo<<<defaulterlist
                        <tr>
                            <td scope="col"><center>$i</center></td>
                            <td scope="col"><center>$fetch[id]</center></td>
                            <td scope="col"><center>$fetch[name]</center></td>
                            <td scope="col"><center>$fetch[dsa]</center></td>
                            <td scope="col"><center>$fetch[ppl]</center></td>
                            <td scope="col"><center>$fetch[mp]</center></td>
                            <td scope="col"><center>$fetch[m3]</center></td>
                            <td scope="col"><center>$fetch[se]</center></td>
                            <td scope="col"><center>$subtotal</center></td>
                            <td scope="col"><center>$percentage</center></td>
                            <td scope="col"><center>$status</center></td>
                        </tr>
                        defaulterlist;
                    }
                ?>
        </tbody>
    </table>
</div>
<?php
    }
?>
