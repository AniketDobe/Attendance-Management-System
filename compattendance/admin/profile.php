<?php
  session_start();
?>
<body>
    <?php
        include "navbar.php";
        $conn = mysqli_connect("localhost", "root", "", "comp_attendance");
        if(mysqli_connect_errno()){
            die("cannot connect to database".mysqli_connect_errno());
        }
        
    ?>


<div class="container justify-content-center" style="margin-top: 6rem">
    <div class="row">
        <div class="col-sm-3" >
            <div class="card" style="border: none;">
                <div class="card-body">
                    <img src="../faculty/assets/43632download.jpg"  width="120" height="120" alt="loading..." >
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="card" style="border: none;">
                <div class="card-body">
                <?php
                  $query="SELECT `name`, `email`, `mobile`, `qualification`, `joiningdate`, `password`, `image`, `username`FROM `users` WHERE role='admin'";
                  $result=mysqli_query($conn, $query);
                  while($fetch= mysqli_fetch_assoc($result)){
                      echo<<<faculty
                          <h4 class="card-title">$fetch[name]</h4>
                          <p class="card-text m-1">$fetch[qualification]</p>
                          <p class="card-text m-1">Admin</p>
                          <p class="card-text m-1">Joined: $fetch[joiningdate]</p>
                          faculty;
                        }
                        ?>
                </div>
            </div>
        </div>
        <div class="col-sm-2">
            <div class="card" style="border: none;">
                <div class="card-body">
                    
                </div>
            </div>
        </div>
    </div>   
</div>

<div class="container">
<div class="row">
        <div class="col-sm-3" ></div>
        <div class="col-sm-6">
            <div class="card" style="border: none;">
                <div class="card-body">
                    <h5 class="card-title">About</h5>
                    <table class="table table-borderless">
                    <tbody>
                      <?php
                      $query="SELECT `name`, `email`, `mobile`, `qualification`, `joiningdate`, `password`, `image`, `username`FROM `users` WHERE role='admin'";
                      $result=mysqli_query($conn, $query);
                        while($fetch = mysqli_fetch_assoc($result)){
                          echo<<<faculty
                            <tr>
                              <th>Username</th>
                              <td>$fetch[username]</td>
                            </tr>
                            <tr>
                                <th  style="border: none;">Name</th>
                                <td  style="border: none;">$fetch[name]</td>
                            </tr>
                                <th style="border: none;">Email</th>
                                <td style="border: none;">$fetch[email]</td>
                            </tr>
                                <th style="border: none;">Phone</th>
                                <td style="border: none;">$fetch[mobile]</td>
                            </tr>
                                <th style="border: none;">Qualification</th>
                                <td style="border: none;">$fetch[qualification]</td>
                            </tr>



                            
                          faculty;
                        }
                      ?>
                    </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div> 
</div>

</body> 